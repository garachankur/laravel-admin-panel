<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use Auth;
use ProjectHelper;

class AdminUserController extends Controller
{
    public function __construct(AdminUser $model)
    {
        $this->moduleName = "Admin User";
        $this->moduleRoute = url('admin/admin-users');
        $this->moduleView = "admin.main.admin-users";
        $this->model = $model;
        $this->breadcrumb = [['title' => $this->moduleName, 'url' => $this->moduleRoute]];

        View::share('module_name', $this->moduleName);
        View::share('module_route', $this->moduleRoute);
        View::share('moduleView', $this->moduleView);
    }

    public function index()
    {
        $this->breadcrumb[] = ['title' => $this->moduleName . " List", 'url' => ''];
        view()->share('breadcrumb', $this->breadcrumb);
        $actionButtons = [['title' => "Add $this->moduleName", "url" => "$this->moduleRoute/create", "class" => "btn-success", "id" => "btn-add-$this->moduleName"]];
        view()->share('actionButtons', $actionButtons);
        view()->share('isIndexPage', true);

        return view("$this->moduleView.index");
    }

    public function getDatatable()
    {
        $result = $this->model->all();
        return Datatables::of($result)->addIndexColumn()->make(true);
    }

    public function create()
    {
        $this->breadcrumb[] = ['title' => "Add " . $this->moduleName, 'url' => ''];
        view()->share('breadcrumb', $this->breadcrumb);

        return view("admin.main.general.create");
    }

    public function store(Request $request)
    {
        $input = $request->except(['_token']);

        try {
            $isSaved = $this->model->create([
                'name' =>  $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);

            if ($isSaved) {
                return redirect($this->moduleRoute)->with("success", $this->moduleName . " Added Successfully");
            }
            return redirect($this->moduleRoute)->with("error", "Sorry, Something went wrong please try again");
        } catch (\Exception $e) {
            return redirect($this->moduleRoute)->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $this->breadcrumb[] = ['title' => $this->moduleName . " Detail", 'url' => ''];
        $this->actionButtons[] = ['title' => "Back", 'url' => $this->moduleRoute];
        view()->share('breadcrumb', $this->breadcrumb);
        view()->share('isIndexPage', true);
        view()->share('actionButtons', $this->actionButtons);

        $result = $this->model->select([
            'id',
            'name',
            'email',
            'created_at'
        ])->find($id);

        if ($result) {
            return view($this->moduleView . ".show", compact("result"));
        } else {
            return redirect($this->moduleRoute)->with("error", "Sorry, $this->moduleName not found");
        }
        return redirect($this->moduleRoute);
    }

    public function edit($id)
    {
        $result = $this->model->find($id);
        if ($result) {
            $this->breadcrumb[] = ['title' => "Edit " . $this->moduleName, 'url' => ''];
            view()->share('breadcrumb', $this->breadcrumb);

            return view("admin.main.general.edit", compact("result"));
        }
        return redirect($this->moduleRoute)->with("error", "Sorry, $this->moduleName not found");
    }

    public function update(Request $request, $id)
    {
        $input = $request->except(['_token']);
        try {
            $result = $this->model->where('is_super_admin', '0')->find($id);

            if ($result) {
                if ($input['password']) {
                    $isSaved = $result->update([
                        'name' => $input['name'],
                        'email' => $input['email'],
                        'password' => Hash::make($input['password']),
                    ]);
                } else {
                    $isSaved = $result->update([
                        'name' => $input['name'],
                        'email' => $input['email'],
                    ]);
                }
                if ($isSaved) {
                    return redirect($this->moduleRoute)->with("success", $this->moduleName . " Updated Successfully");
                }
            }

            return redirect($this->moduleRoute)->with("error", "Sorry, Something went wrong please try again");
        } catch (\Exception $e) {
            return redirect($this->moduleRoute)->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $result = array();
        try {
            $res = $this->model->where('is_super_admin', '0')->find($id);
            if ($res) {
                $res->delete();

                $result['message'] = "$this->moduleName Deleted Successfully.";
                $result['code'] = 200;
            } else {
                $result['code'] = 400;
                $result['message'] = "Something went wrong";
            }
        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
            $result['code'] = 400;
        }

        return response()->json($result, $result['code']);
    }

    public function editProfile()
    {
        $this->moduleView = "admin.main.admin-profile";
        View::share('moduleView', $this->moduleView);
        View::share('module_route', url('admin/admin-route/updateprofile'));
        view()->share('editProfileType', 'profile');
        $id = Auth::guard('admin')->user()->id;

        $result = $this->model->select(["*", 'image as image_thumb_fullpath'])->where('id', $id)->first();

        if ($result) {
            $this->breadcrumb[] = ['title' => "Edit " . $this->moduleName, 'url' => ''];
            view()->share('breadcrumb', []);

            return view("admin.main.general.edit", compact("result"));
        }
        return redirect($this->moduleRoute)->with("error", "Sorry, $this->moduleName not found");
    }

    public function changePassword()
    {
        $this->moduleView = "admin.main.admin-profile";
        View::share('moduleView', $this->moduleView);
        View::share('module_route', url('admin/admin-route/updateprofile'));
        view()->share('editProfileType', 'password');
        $id = Auth::guard('admin')->user()->id;

        $result = $this->model->find($id);

        if ($result) {
            $this->breadcrumb[] = ['title' => "Edit " . $this->moduleName, 'url' => ''];
            view()->share('breadcrumb', []);

            return view("admin.main.general.edit", compact("result"));
        }
        return redirect($this->moduleRoute)->with("error", "Sorry, $this->moduleName not found");
    }

    public function updateProfile(Request $request, $id)
    {
        $input = $request->except(['_method', '_token']);

        $user = $this->model->find($id);

        if ($request->hasFile('image')) {
            $path = ProjectHelper::uploadImageWithThumb($request->file('image'), config('laraveladminpanel.admin_image_path'), config('laraveladminpanel.thumb_image_path'), $id, 'update', $user['image']);

            $input['image'] = $path;
        }

        if (isset($input['password'])) {
            if (Hash::check($input['current_password'], $user['password'])) {
                $input['password'] = Hash::make($input['password']);
                unset($input['current_password']);
                unset($input['password_confirmation']);
            } else
                return redirect()->back()->with("error", "Current password not match");
        }

        $isSaved = $user->update($input);

        if (isset($input['email']))
            $msg = "Admin profile update successfully";
        else
            $msg = "Password update successfully";

        return redirect()->back()->with("success", $msg);
    }
}

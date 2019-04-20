<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Models\User;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{

    public function __construct(User $user)
    {
        $this->moduleName = "Users";
        $this->moduleRoute = url('admin/users');
        $this->moduleView = "admin.main.users";
        $this->model = $user;

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
        $result = $this->model::select(["*"])->get();
        return Datatables::of($result)->addIndexColumn()->make(true);
    }

    public function create()
    {
        $this->breadcrumb[] = ['title' => "Add " . $this->moduleName, 'url' => ''];
        $this->actionButtons[] = ['title' => "Back", 'url' => $this->moduleRoute];

        view()->share('breadcrumb', $this->breadcrumb);
        view()->share('actionButtons', $this->actionButtons);

        return view("admin.main.general.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
        ]);

        $input = $request->all();

        $userCreate = $this->model->create($input);

        if ($userCreate) {
            return redirect($this->moduleRoute)->with("success", $this->moduleName . " Added Successfully");
        }
        return redirect($this->moduleRoute)->with("error", "Sorry, Something went wrong please try again");
    }

    public function show($id)
    {
        $this->breadcrumb[] = ['title' => $this->moduleName . " Detail", 'url' => ''];
        $this->actionButtons[] = ['title' => "Back", 'url' => $this->moduleRoute];
        view()->share('breadcrumb', $this->breadcrumb);
        view()->share('isIndexPage', true);
        view()->share('actionButtons', $this->actionButtons);

        $result = $this->model->select(['*'])->where('id', $id)->first();
        if ($result) {
            return view($this->moduleView . ".show", compact("result"));
        } else {
            return redirect($this->moduleRoute)->with("error", "Sorry, $this->moduleName not found");
        }
        return redirect($this->moduleRoute);
    }

    public function edit($id)
    {
        $result = $this->model->select(['*'])->where('id', $id)->first();

        if ($result) {
            $this->breadcrumb[] = ['title' => "Edit " . $this->moduleName, 'url' => ''];
            $this->actionButtons[] = ['title' => "Back", 'url' => $this->moduleRoute];

            view()->share('breadcrumb', $this->breadcrumb);
            view()->share('actionButtons', $this->actionButtons);

            return view("admin.main.general.edit", compact("result"));
        }
        return redirect($this->moduleRoute)->with("error", "Sorry, $this->moduleName not found");
    }

    public function update(Request $request, $id)
    {
        $input = $request->except(['_token']);
        try {
            $result = $this->model->select(['*'])->where('id', $id)->first();

            if ($result) {

                $isSaved = $result->update($input);

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
            $res = $this->model->delete()->where('id', $id);
            if ($res) {
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
}

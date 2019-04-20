<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PasswordReset;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function showLoginForm()
    {
        if(Auth::guard('admin')->user()){
            return redirect('admin/dashboard');
        }
        return view('admin.auth.login');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        return redirect('/admin/login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function forgotView($token)
    {
        return view('admin.auth.email',compact('token'));
    }

    public function forgotPassword(Request $request)
    {
        $input=$request->except(['_token']);
        $adminUser=AdminUser::where('email',$input['email'])->first();
        if(@count($adminUser)==0)
        {
            return back()->with('emailerror','Admin user not found');
        }
        $token=str_random(20);
        $input['token']=$token;

        $passwordReset=PasswordReset::where('email',$input['email'])->count();
        if($passwordReset>0)
            PasswordReset::where('email',$input['email'])->update(['token'=>$input['token']]);
        else
            PasswordReset::create($input);

        return back()->with('successForgot','Reset link sent your email');
    }

    public function forgotPasswordSet(Request $request)
    {
        $input=$request->all();

        $emailFind=PasswordReset::select('email','token')->where('email',$input['email'])->where('token',$input['token'])->first();
        if(@count($emailFind)==0)
        {
            return back()->with('emailerror','Email or token not found');
        }

        $adminUser=AdminUser::where('email',$input['email'])->first();
        if(@count($adminUser)==0)
        {
            return back()->with('emailerror','Admin user not found');
        }

        $adminUser->password=Hash::make($input['password']);
        $adminUser->save();
        PasswordReset::where('email',$input['email'])->update(['token'=>'']);
        return redirect('/admin/login')->with('passwordchange','Your password change successfully');
    }
}

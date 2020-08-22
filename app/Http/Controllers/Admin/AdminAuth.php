<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Mail\AdminResetPassword;
use DB;
use Carbon\Carbon;
use Mail;


use Illuminate\Http\Request;

class AdminAuth extends Controller
{
    public function login(){
    	return view('admin.login');
    }

    public function doLogin(){
    	$rememberme = request('rememberme') == 1 ?true:false;
    	if(admin()->attempt(['email'=>request('email'), 'password'=>request('password')], $rememberme)){
    		return redirect('admin');
    	}else{
    		session()->flash('error', __('admin.wrong_creditionals'));
    		return redirect('admin/login');
    	}
    }

    public function logout(){
    	auth()->guard('admin')->logout();
    	return redirect('admin/login');
    }

    public function forgotPassword(){
    	return view('admin.forgot_password');
    }

    public function forgotPasswordPost(){
        $admin = Admin::where('email', request('email'))->first();
        if(!empty($admin)){
            $token = app('auth.password.broker')->createToken($admin);
            $data = DB::table('password_resets')->insert([
                    'email' => $admin->email,
                    'token' => $token,
                    'created_at' => Carbon::now()
            ]);
            Mail::to($admin->email)->send(new AdminResetPassword(['data' => $admin, 'token' => $token]));

            session()->flash('success', __('admin.linkSent'));
            return back();
        }
        return back();
    }
    
    public function resetPassword($token){
        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();
        if(!empty($check_token)){
            return view('admin.reset_password', ['data' => $check_token]);
        }else{
            return redirect(adminURL('forgot/password'));
        }
    }

    public function resetPasswordPost($token){
        $valid = $this->validate(request(), [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();
        if(!empty($check_token)){
            $admin = Admin::where('email', $check_token->email)->update(['email' => $check_token->email, 'password'=> bcrypt(request('password'))

            ]);
            DB::table('password_resets')->where('email', request('email'))->delete();
            admin()->attempt(['email' => request('email'), 'password' => request('password')], true);
            return redirect(adminURL());
        }else{
            return redirect(adminURL('forgot/password'));
        }
    }
}

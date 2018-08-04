<?php

namespace App\Http\Controllers\Pub;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{

	public function getLogin(){
		return view('public.login');
	}

	public function postLogin(Request $request){
		$user = [
			'email' => $request->email,
			'password' => $request->password
		];
		if( Auth::attempt($user) ){
			return redirect('user/profile');
		}else{
			return back()->with('error','Không thể đăng nhập');
		}
	}

	public function getLogout(){
		if( Auth::check() ){
			Auth::logout();
		}	
		return redirect('login');
	}
}

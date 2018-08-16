<?php

namespace App\Http\Controllers\Pub;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\HomeStay;
use App\Http\Requests\CreateUserRequest;
use Auth;
use File;
use Hash;

class UserController extends Controller
{
	//Signup
	public function getSignup(){
		return view('public.signup');
	}

	public function postSignup(CreateUserRequest $request){
		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		if ($user->save()) {
			return 'xong';
		}
		else
		{
			return 'ko';
		}
	}

	//
	public function getProfile(){
		return view('public.guest.profile');
	}

	public function seeDetailModal(Request $request)
    {
        return view('public.guest.see-detail-modal');
    }

	public function getBook(){
		return view('public.guest.book');
	}

	public function getNotification(){
		return view('public.guest.notification');
	}

	public function postUpdateProfile(CreateUserRequest $request){
		$user = User::find(Auth::id());
		$user->name = $request->name;
		$user->phone = $request->phone;
		$user->sex = $request->sex;
		$user->description = $request->description;
		$user->save();
		return back();
	}

	public function postAjaxAvatar(CreateUserRequest $request){
		$user = User::find( Auth::id() );
		if( $request->image != null){
			if( File::exists('local/storage/app/image/user-3/'.$user->avatar) ){
				File::delete('local/storage/app/image/user-3/'.$user->avatar);
			}
			if( File::exists('local/storage/app/image/user-3/resized-'.$user->avatar) ){
				File::delete('local/storage/app/image/user-3/resized-'.$user->avatar);
			}
			$user->avatar = saveSingleImage($request->image, 200, 'image/user-3');
		}
		$user->save();
		return $user;
	}

	public function postUpdatePassword(CreateUserRequest $request){
		$user = Auth::user();
		if (!(Hash::check($request->old_password, $user->password))) {
			return redirect()->back()->with("error","Mật khẩu cũ không chính xác");
		}

		if(strcmp($request->old_password, $request->new_password) == 0){
			return redirect()->back()->with("error","Mật khẩu mới không được trùng với mật khẩu cũ");
		}

		if(!strcmp($request->confirm_password, $request->new_password) == 0){
			return redirect()->back()->with('error','Mật khẩu mới không khớp nhau');
		}

		$user->password = bcrypt($request->new_password);
		$user->save();
		return back()->with('success','Mật khẩu thay đổi thành công!');
	}
}
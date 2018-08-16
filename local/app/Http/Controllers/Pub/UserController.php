<?php

namespace App\Http\Controllers\Pub;

use App\Models\BedRoom;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\HomeStay;
use App\Http\Requests\CreateUserRequest;
use Auth;
use File;
use Hash;
use Illuminate\Support\Facades\DB;

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
	    $list_book = DB::table('books')->paginate(15);

	    foreach ($list_book as $book){
	        $book->homestay = DB::table('homestay')->where('homestay_id',$book->homestay_id)->first();
            $book->book_from = date('d/m/Y',strtotime(str_replace('/','-',$book->book_from)));
            $book->book_to = date('d/m/Y',strtotime(str_replace('/','-',$book->book_to)));
        }

	    $data = [
	        'list_book' => $list_book
        ];

		return view('public.guest.profile',$data);
	}

	public function seeDetailModal(Request $request)
    {

        $id = $request->get('id');

        $book = DB::table('books')->where('book_id',$id)->first();

        if($book){
            $book->book_from = date('d/m/Y H:m',strtotime(str_replace('/','-',$book->book_from)));
            $book->book_to = date('d/m/Y H:m',strtotime(str_replace('/','-',$book->book_to)));
            $homestay = DB::table('homestay')->where('homestay_id',$book->homestay_id)->first();
            if ($homestay){
                $homestay->user = DB::table('users')->where('id',$homestay->homestay_user_id)->first();
            }
            $bedroom = DB::table('bedrooms')->where('bedroom_id',$book->book_bedroom_id)->first();
        }

        $data = [
            'homestay' => $homestay,
            'bedroom' => $bedroom,
            'book' => $book
        ];
        return view('public.guest.see-detail-modal',$data);
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
		$user = User::find(Auth::id());
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
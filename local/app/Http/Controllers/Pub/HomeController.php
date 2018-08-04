<?php

namespace App\Http\Controllers\Pub;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Excel;
use DB;
use App\Models\Location;
use App\Models\HomeStay;
use App\Models\Comment;
use App\Models\Blog;

class HomeController extends Controller
{
    public function getIndex(){
        $data['hot_homestay'] = HomeStay::where('homestay_active',1)->orderBy('homestay_id','desc')->take(9)->get();
        $data['blogs'] = [];
        $data['comments'] = Comment::with('user')->with('homestay')->take(9)->get();
    	return view('public.index',$data);
    }

    public function getSearch(){
    	return view('public.search-result');
    }

    public function getDetail($id){
        $data['homestay'] = HomeStay::findOrFail($id);
        $data['nearby_homestay'] = HomeStay::where('homestay_active',1)->orderBy('homestay_id','desc')->take(9)->get();
        $data['comments'] = $data['homestay']->comment();
        return view('public.detail',$data);
    }

    public function getRegister(){
        return view('public.register');
    }

    public function getBlog(){
        return view('public.blog');
    }

    public function getBlogDetail(){
        return view('public.blog-detail');
    }

    public function getHostSignUp(){
        return view('public.host-signup');
    }

    public function getSignUp(){
        return view('public.signup');
    }

    public function getUpload(){
        return view('upload');
    }



    public function getLocationApi(){
        $data = Location::orderBy('id','desc')->get();
        return response()->json($data);
    }
}

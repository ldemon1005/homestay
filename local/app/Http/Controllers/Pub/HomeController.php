<?php

namespace App\Http\Controllers\Pub;

use App\Events\NotiEvent;
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
    public function getIndex()
    {
        return view('public.maintain');
    }

    public function getHome()
    {
//        dd(time());
//        dd(env('BLOG_URL').'/api/blogs');
        $data['hot_homestay'] = HomeStay::where('homestay_active',1)->orderBy('homestay_id','desc')->take(9)->get();
        $data['blogs'] = DB::table('articel')->orderBy('id','desc')->take(9)->get();
        $data['comments'] = Comment::with('user')->with('homestay')->take(9)->get();
        return view('public.index',$data);
    }

    public function getBlogs()
    {
        $blogs = json_decode(file_get_contents(env('BLOG_URL').'/api/blogs'), true);
        return view('public.get-blog',compact('blogs'));
    }

    public function getSearch()
    {
    	return view('public.search-result');
    }

    public function getDetail($id)
    {
        $data['homestay'] = HomeStay::findOrFail($id);
        $data['nearby_homestay'] = HomeStay::where('homestay_active',1)->orderBy('homestay_id','desc')->take(9)->get();
        $data['comments'] = $data['homestay']->comment();
        return view('public.detail',$data);
    }

    public function getRegister()
    {
        return view('public.register');
    }

    public function getHostSignUp()
    {
        return view('public.host-signup');
    }

    public function getSignUp()
    {
        return view('public.signup');
    }

    public function getUpload()
    {
        return view('upload');
    }

    //đẩy data từ file excel lên database. Xài 1 lần
    public function postUpload(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        $data = Excel::load($path, function($reader) {

        })->get();

        if(!empty($data) && $data->count()){
            $code[] = [];
            foreach ($data as $key => $value) {
                if( !(in_array( $value->commune_code, $code) ) ){
                    $id = DB::table('district')->where('district_code',$value->district_code)->first()->district_id;
                    $code[] = $value->district_code;
                    $insert[] = [
                        'ward_name' => $value->commune,
                        'ward_slug' => str_slug($value->commune),
                        'ward_code' => $value->commune_code,
                        'ward_district_id' => $id
                    ];
                }
            }
            if(!empty($insert)){

                $insertData = DB::table('ward')->insert($insert);

            }
        }    
    }

    public function getLocationApi()
    {
        $data = Location::orderBy('id','desc')->get();
        return response()->json($data);
    }
}

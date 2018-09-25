<?php

namespace App\Http\Controllers\Admin;

use App\Models\Host;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HostController extends Controller
{
    function index(Request $request){
        $req = $request->all();

        $query = DB::table('users');

        if(isset($req['search'])){
            $query = $query->where('email','like',"%".$req['search'].'%')
                ->orWhere('name','like',"%".$req['search'].'%')
                ->orWhere('phone',$req['search']);
        }

        $list_host = $query->orderByDesc('id')->paginate(15);

        $data = [
            'list_host' => $list_host
        ];

        return view('admin.host.list',$data);
    }

    function update_status($id){
        $host = Host::find($id);
        $host->status == 2 ? $host->status = 1 : $host->status = 2;
        $host->save();

        return json_encode([
            'host' => $host->toJson()
        ]);
    }

    function delete_host($id){
        if(DB::table('users')->delete($id)){
            return redirect()->route('list_host')->with('success','Xóa thành công');
        }else {
            return redirect()->route('list_host')->with('error','Xóa không thành công');
        }
    }
}

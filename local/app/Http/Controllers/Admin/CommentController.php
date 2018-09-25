<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    function index(Request $request){
        $req = $request->all();

        $query = DB::table('comment');

        if(isset($req['search'])){
            $query = $query->where('email','like',"%".$req['search'].'%')
                ->orWhere('name','like',"%".$req['search'].'%')
                ->orWhere('phone',$req['search']);
        }

        $list_comment = $query->orderByDesc('id')->paginate(15);

        $data = [
            'list_comment' => $list_comment
        ];

        return view('admin.comment.list',$data);
    }

    function update_status($id){
        $comment = Comment::find($id);
        $comment->status == 2 ? $comment->status = 1 : $comment->status = 2;
        $comment->save();

        return json_encode([
            'comment' => $comment->toJson()
        ]);
    }

    function delete_comment($id){
        if(DB::table('comment')->delete($id)){
            return redirect()->route('list_comment')->with('success','Xóa thành công');
        }else {
            return redirect()->route('list_comment')->with('error','Xóa không thành công');
        }
    }
}

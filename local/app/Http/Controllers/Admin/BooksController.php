<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    function index(Request $request){
        $req = $request->get('search');

        $list_book = DB::table('books');

        if($req){
            $list_book = $list_book->where('code',$req);
        }

        $list_book = $list_book->orderByDesc('book_id')->paginate(15);

        foreach ($list_book as $book) {
            $book->homestay = DB::table('homestay')->where('homestay_id', $book->homestay_id)->first();
            $book->del_time = $this->get_time_h_m_s($book->time_del);
            $book->book_from = date('d/m/Y', strtotime(str_replace('/', '-', $book->book_from)));
            $book->book_to = date('d/m/Y', strtotime(str_replace('/', '-', $book->book_to)));
        }

        $data = [
            'list_book' => $list_book
        ];

        return view('admin.books.list',$data);
    }
}

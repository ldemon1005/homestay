<?php

namespace App\Http\Controllers\Pub;

use App\Models\BedRoom;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    function add_order (Request $request){
        $data_order = $request->get('book');

        $key = 'ordering:'.$this->getUserIpAddr();

        $order = Cache::get($key);

        $order[$data_order['id_room']] = $data_order;

        $key = 'ordering:'.'127.0.0.1';

        Cache::store('redis')->put($key,$order,Book::TIME_ORDER);

        return back();
    }

    function payment_order(){
        $key = 'ordering:'.'127.0.0.1';

        $order = Cache::store('redis')->get($key);

        dd($order);
        if ($order){
            return back()->with('error','Bạn chưa có đơn hàng hoặc đã hết phiên thanh toán cho đơn hàng');
        }
    }
}

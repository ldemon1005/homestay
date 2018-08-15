<?php

namespace App\Http\Controllers\Payment;

use App\Models\Book;
use App\Models\HomeStay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    protected $email;
    public function info_payment(){
        $data = $this->get_homestay();

        return view('public.payment.info',$data);
    }
    public function action_info_payment(Request $request){
        $user = Auth::user();
        $key = 'ordering:'.$user->id;

        $order = Cache::store('redis')->get($key);

        $order['code'] = 'CTOGO'.$user->id.substr(time(),5,8);

        $order['info'] = $request->all();

        Cache::store('redis')->put($key, $order, Book::TIME_ORDER);

        return redirect()->route('payment_method');
    }

    function payment_method(){
        $data = $this->get_homestay();

        return view('public.payment.payment',$data);
    }

    function action_payment_method(Request $request){
        $user = Auth::user();
        $key = 'ordering:'.$user->id;

        $order = Cache::store('redis')->get($key);

        $this->email = $order['info']['email'];

        $order['payment_method'] = $request->all();

        Cache::store('redis')->put($key, $order, Book::TIME_ORDER);

        $book = [
            'book_status' => 0,
            'book_from' => date('Y/m/d',strtotime(str_replace('/','-',$order['start'])."00:00")),
            'book_to' => date('Y/m/d',strtotime(str_replace('/','-',$order['start'])."00:00")),
            'book_slot' => $order['slot'],
            'book_bedroom_id' => $order['id_room'],
            'book_user_id' => $user->id,
            'homestay_id' => $order['homestay_id'],
            'time_del' => time() + 3600*2
        ];

        Book::create($book);

        $data = [
            'name' => 'ldemon',
            'content' => 'chào bạn'
        ];
        Mail::send('mail_book',$data, function($message){
            $message->to($this->email, 'chào con gà')->subject('chào con gà');
        });

        $data = $this->get_homestay();
        return view('public.payment.ck-confirm',$data);
    }

    function get_homestay(){
        $user = Auth::user();
        $key = 'ordering:'.$user->id;

        $order = Cache::store('redis')->get($key);

        $start = strtotime(str_replace('/','-',$order['start'])."00:00");
        $end = strtotime(str_replace('/','-',$order['end'])."23:59");

        $number_night = intval(($end - $start)/86400);

        $homestay = HomeStay::findOrFail($order['homestay_id']);

        $total_money = $number_night * $order['price'];

        $data = [
            'homestay' => $homestay,
            'total_money' => $total_money,
            'number_night' => $number_night,
            'order' => $order
        ];

        return $data;
    }
}

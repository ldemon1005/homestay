<?php

namespace App\Http\Controllers\Payment;

use App\Jobs\SendMail;
use App\Models\Book;
use App\Models\HomeStay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    protected $email;
    public function info_payment(){
        $data = $this->get_homestay();

        if($data == null) {
            return redirect('user/profile#manage');
        }

        return view('public.payment.info',$data);
    }
    public function action_info_payment(Request $request){
        $user = Auth::user();
        $key = 'ordering:'.$user->id;

        $order = Cache::store('redis')->get($key);

        if(!$order){
            return redirect('user/profile#manage');
        }

        $order['code'] = 'CTOGO-'.$user->id.substr(time(),5,8);

        $order['info'] = $request->all();

        Cache::store('redis')->put($key, $order, Book::TIME_ORDER);

        return redirect()->route('payment_method');
    }

    function payment_method(){

        $data = $this->get_homestay();

        if($data == null) {
            return redirect('user/profile#manage');
        }

        return view('public.payment.payment',$data);
    }

    function action_payment_method(Request $request){
        $user = Auth::user();
        $key = 'ordering:'.$user->id;

        $order = Cache::store('redis')->get($key);

        if(!$order){
            return redirect('user/profile#manage');
        }

        $this->email = $order['info']['email'];

        $order['payment_method'] = $request->all();

        $data = $this->get_homestay();

        if($data == null) {
            return redirect('user/profile#manage');
        }

        $book = [
            'book_from' => date('Y/m/d',strtotime(str_replace('/','-',$order['start'])."00:00")),
            'book_to' => date('Y/m/d',strtotime(str_replace('/','-',$order['start'])."00:00")),
            'book_slot' => $order['slot'],
            'book_bedroom_id' => $order['id_room'],
            'book_user_id' => $user->id,
            'homestay_id' => $order['homestay_id'],
            'time_del' => time() + 3600*2,
            'code' => $order['code'],
            'price' => $data['total_money']*0.8
        ];

        $book_1 = Book::create($book);

        $job = (new SendMail($order))->delay(Carbon::now()->addMinutes(1));
        $this->dispatch($job);

        Cache::store('redis')->forget($key);

        return redirect()->route('ck_confirm',$book_1->book_id);
    }

    function ck_confirm($id){
        $book = DB::table('books')->where('book_id',$id)->first();

        $start = strtotime(str_replace('/','-',$book->book_from)."00:00");
        $end = strtotime(str_replace('/','-',$book->book_to)."23:59");

        $number_night = intval(($end - $start)/86400);

        $book->book_from = date('d/m/Y',strtotime(str_replace('/','-',$book->book_from)));
        $book->book_to = date('d/m/Y',strtotime(str_replace('/','-',$book->book_to)));

        $homestay = DB::table('homestay')->where('homestay_id',$book->homestay_id)->first();

        $bedroom = DB::table('bedrooms')->where('bedroom_id',$book->book_bedroom_id)->first();



        $data = [
            'book' => $book,
            'homestay' => $homestay,
            'bedroom' => $bedroom,
            'number_night' => $number_night
        ];

        $data['time_del'] = $this->get_time_h_m_s($book->time_del);

        return view('public.payment.ck-confirm',$data);
    }


    function get_homestay(){
        $user = Auth::user();
        $key = 'ordering:'.$user->id;

        $order = Cache::store('redis')->get($key);

        if(!$order){
            $data = null;
            return $data;
        }

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

    function update_status($id,$status){
        $book = DB::table('books')->where('book_id',$id)->update(['book_status'=>$status]);

        if($book && $status == 2){
            return redirect()->route('complete')->with('warning','Hết thời gian thanh toán');
        }
    }

    function complete(Request $request){
        $status = $request->get('status');

        if($status == 3){
            return view('public.payment.complete')->with('success','Đơn hàng đã được thanh toán thành công');
        }else if ($status == 4){
            return view('public.payment.complete')->with('danger','Đơn hàng đã bị hủy');
        }
        return view('public.payment.complete');
    }

    function check_status_book($id){
        $book = DB::table('books')->where('book_id',$id)->first();
        return json_encode([
            'status' => $book->book_status
        ]);
    }
}

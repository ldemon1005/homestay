<?php

namespace App\Http\Controllers\Payment;

use App\Jobs\CancelBook;
use App\Jobs\SendMail;


use App\Library\NganLuongHelper;
use App\Models\Book;
use App\Models\HomeStay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
class PaymentController extends Controller
{
    protected $email;
    public function info_payment(){
        $data = $this->get_homestay();

        if($data == null) {
            return redirect('user/profile#manage');
        }
        $data['step'] = 1;
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
        $data['step'] = 2;
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

        $order['method_payment'] = $request->all();

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
            'price' => $data['total_money']*0.8,
            'payment_method' => $order['method_payment']['method_payment'],
            'bank_code' => $order['method_payment']['bankcode'],
            'info_payment_ol' => ''
        ];

        $book_1 = Book::create($book);

        if($order['method_payment']['method_payment'] == Book::TRUC_TUYEN){
            $nl = new NganLuongHelper();
            $data = [
                'id' => $book_1->book_id,
                'book_code' => $book_1->code,
                'option_payment' => $order['method_payment']['option_payment'],
                'bankcode' => $order['method_payment']['bankcode'],
                'price' => $book_1->price,
                'cus_name' => $order['info']['fullname'],
                'cus_email' => $order['info']['email'],
                'cus_phone' => $order['info']['phone'],
                'cus_address' => $order['info']['country'] ? $order['info']['country'] : ''
            ];
            $url = $nl->createPaymentNganLuong($data);
            if(!isset($url['status'])){
                $book_1->info_payment_ol = json_encode($url);
                $book_1->save();
            }
        }

        $job = (new SendMail($order))->delay(Carbon::now()->addMinutes(1));
        $this->dispatch($job);

        $cancel_book = (new CancelBook($book_1))->delay(Carbon::now()->addMinutes(1));
        $this->dispatch($cancel_book);

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

        $url_payment = '';
        if($book->payment_method == Book::TRUC_TUYEN && $book->info_payment_ol != ""){
            $info_payment_ol = json_decode($book->info_payment_ol,true);
            $url_payment = $info_payment_ol['url_nganluong'];
        }

        $data = [
            'book' => $book,
            'homestay' => $homestay,
            'bedroom' => $bedroom,
            'number_night' => $number_night,
            'step' => 2,
            'url_payment' => $url_payment
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
        if($book && $status == 3){
            return redirect()->route('complete')->with('success','Thanh toán thành công');
        }
        if($book && $status == 4){
            return redirect()->route('complete')->with('danger','Hủy thanh toán thành công');
        }
    }

    function complete(Request $request){
        $status = $request->get('status');
        $data['step'] = 3;
        if($status == 3){
            return view('public.payment.complete',$data)->with('success','Đơn hàng đã được thanh toán thành công');
        }else if ($status == 4){
            return view('public.payment.complete',$data)->with('danger','Đơn hàng đã bị hủy');
        }
        return view('public.payment.complete',$data);
    }

    function check_status_book($id){
        $book = DB::table('books')->where('book_id',$id)->first();
        return json_encode([
            'status' => $book->book_status
        ]);
    }
}

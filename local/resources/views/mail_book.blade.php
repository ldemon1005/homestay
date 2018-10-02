<h3 style="margin: 0 0 40px 0">Chào {{$cus_info['fullname']}},</h3>
<h3>Ctogo gửi bạn thông tin thanh toán của bạn như sau:</h3>
<h4>- Mã đơn của bạn: <span style="color: #1e7e34">{{$order->code}}</span></h4>
<h4>- Tổng số tiền: <span>{{$order->price}}</span></h4>
<h4>- Thời gian còn lại để thanh toán: <span>2 giờ</span></h4>

@if(count($info_payment_ol))
    <h4>Để thanh toán, bạn vui lòng nhấn vào <a href="{{$info_payment_ol['url_nganluong']}}">link</a> dưới đây. Nếu không phải bạn thực hiện việc đặt phòng, vui lòng bỏ qua email này.</h4>
    <h4>Link thanh toán: <span>{{$info_payment_ol['url_nganluong']}}</span></h4>
@else
    <h4>Nếu không phải bạn thực hiện việc đặt phòng, vui lòng bỏ qua email này.</h4>
@endif

<h4 style="font-style: italic;margin: 20px 0">Upload ảnh ủy nhiệm chi <a href="https://ctogo.vn/user/profile#manage">Link</a></h4>
<h4 style="font-style: italic;margin: 20px 0">Cảm ơn {{$cus_info['fullname']}} đã sử dụng dịch vụ của Ctogo!</h4>
<a href="https://ctogo.vn/home"><h2><b>CTOGO.VN</b></h2></a>
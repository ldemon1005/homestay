@extends('public.user-master')

@section('css')
<link rel="stylesheet" type="text/css" href="payment/css/payment.css">
<link rel="stylesheet" type="text/css" href="payment/css/book-info.css">

@stop

@section('javascript')
	<script>
        $("#info_payment").validate({
            ignore: [],
            rules: {
                'fullname': {
                    required: true
                },
                'email': {
                    required: true,
                    email : true
                },
                'phone': {
                    required: true,
                    phone : true
                }
            },
            messages: {
                'fullname': {
                    required: "Vui lòng nhập họ và tên"
                },
                'email': {
                    required: "Vui lòng nhập email",
					email : "Email không đúng định dạng"
                },
                'phone': {
                    required: "Vui lòng nhập số điện thoại",
					phone : "Số điện thoại không đúng định dạng"
                }
            }
        });
	</script>
@stop

@section('main')
@include('public.payment.navigation')

<section class="hs-section mb-50">
	<div class="container">
		<div class="row mb-4">
			<div class="col-12">
				<h6 class="bold">Thông tin liên hệ/Thông tin khách</h6>		
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-8 col-lg-8">
				<div class="book-box">
					<form id="info_payment" action="{{route('action_info_payment')}}" method="get">
						<div class="row">
							<div class="col-12 col-md-6 col-lg-6">
								<div class="form-item-2">
									<label>Tên người liên hệ: <span class="text-danger">*</span></label>
									<input type="text" name="fullname" value="{{\Illuminate\Support\Facades\Auth::user()->name}}" placeholder="Họ và tên">
								</div>
							</div>
							<div class="col-12 col-md-6 col-lg-6">
								<div class="form-item-2">
									<label>Email:<span class="text-danger">*</span></label>
									<input type="text" name="email" value="{{\Illuminate\Support\Facades\Auth::user()->email}}" placeholder="email@example.com">
								</div>
							</div>
							<div class="col-12 col-md-6 col-lg-6">
								<div class="form-item-2">
									<label>Số di động:<span class="text-danger">*</span></label>
									<input type="text" name="phone" value="{{\Illuminate\Support\Facades\Auth::user()->phone}}" placeholder="+84123456789">
								</div>
							</div>
							<div class="col-12 col-md-6 col-lg-6">
								<div class="form-item-2">
									<label>Quốc gia:</label>
									<input type="text" name="country" value="">
								</div>
							</div>
						</div>

						<div class="form-item-2 right-bottom">
							<button style="cursor: pointer" type="submit">Tiếp tục</button>
						</div>
					</form>
				</div>
			</div>

			<div class="col-12 col-md-4 col-lg-4">
				<div class="book-box">
					<div class="book-box-header">
						Thông tin homestay
					</div>
					<div class="book-box-body">
						<div class="book-homestay">
							<div class="book-image" style="background-image: url(https://scontent.fhan5-1.fna.fbcdn.net/v/t1.0-0/p526x296/36342061_10214793221356628_5207655401247473664_n.jpg?_nc_cat=0&oh=2f9378d7f2308b2d7cb641c594304ef5&oe=5B9FD331);"></div>
							<div class="book-homestay-info">
								<div class="book-homestay-name">{{$homestay->homestay_name}}</div>
								<div class="book-homestay-address"><i class="fas fa-map-marker-alt"></i> {{$homestay->homestay_location}}</div>
							</div>
						</div>
						<div class="book-info">
							<div class="book-info-row">
								<span class="book-info-left">Số đêm nghỉ</span>
								<span class="book-info-right">{{$number_night}} đêm</span>
							</div>

							<div class="book-info-row">
								<span class="book-info-left">Ngày đến</span>
								<span class="book-info-right">{{$order['start']}}</span>
							</div>

							<div class="book-info-row">
								<span class="book-info-left">Ngày đi</span>
								<span class="book-info-right">{{$order['end']}}</span>
							</div>

							<div class="book-info-row">
								<span class="book-info-left">Số người</span>
								<span class="book-info-right">{{$order['slot']}}</span>
							</div>
							<hr>
							<div class="book-info-row">
								<span class="book-info-left">{{number_format($order['price'])}}đ x 1 đêm</span>
							</div>
							<hr>
							<div class="book-info-row-last">
								<span class="book-info-left">TỔNG</span>
								<span class="book-info-right">{{number_format($total_money)}}</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop
@extends('public.user-master')

@section('css')
<link rel="stylesheet" type="text/css" href="payment/css/confirm.css">
<link rel="stylesheet" type="text/css" href="payment/css/book-info.css">
@stop

@section('javascript')
<script type="text/javascript" src="payment/js/confirm.js"></script>
@stop

@section('main')
<section class="hs-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h6 class="bold">Thanh toán chuyển khoản</h6>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-8 col-lg-8">
				<div class=" pb-200 confirm-box">
					<div>
						<i class="fas fa-exclamation-circle" style="color: #EFD176;"></i> Hướng dẫn thanh toán đã được Ctogo gửi vào mail của bạn
					</div>
					<div class="confirm-box-main">
						<div class="confirm-box-child">
							<div class="confirm-box-header">
								<span class="main-color">01.</span> Bạn vui lòng tiến hành thanh toán trước
							</div>

							<div class="confirm-box-body">
								<p class="bold">Hôm nay 14:20 PM</p>
								<p class="fs-14">Thời gian còn lại 2 tiếng 15 phút</p>
							</div>
						</div>

						<div class="confirm-box-child">
							<div class="confirm-box-header">
								<span class="main-color">02.</span> Khách hàng vui lòng chuyển khoản đến STK sau:
							</div>

							<div class="confirm-box-body">
								<img src="{{ asset('local/storage/app/public/payment/image/BIDV.png') }}"> <span class="bold">NGÂN HÀNG TMCP ĐẦU TƯ VÀ PHÁT TRIỂN VIỆT NAM</span>
								<hr>
								<p class="fs-14">Số tài khoản: 12345667</p>
								<p class="fs-14">Chủ tài khoản: Đoàn Công Chung</p>
								<p class="fs-14">Nội dung thanh toán: Thanh toán đặt chỗ #111111</p>
								<hr>
								<p class="fs-14">Số tiền cần thanh toán: <span class="bold">200.000đ</span></p>
								<p class="italic fs-12"><i class="fas fa-exclamation-circle" style="color: #EFD176;"></i> Lưu ý: Bạn cần thanh toán chính xác số tiền đặt phòng của mình</p>
							</div>
						</div>

						<div class="confirm-box-child">
							<div class="confirm-box-header">
								<span class="main-color">03.</span> Sau khi thanh toán thành công chúng tôi sẽ gửi mail xác nhận thanh toán cho bạn
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12 col-md-4 col-lg-4">
				@include('public.payment.book-info')
			</div>
		</div>
	</div>
</section>
@stop

@extends('public.user-master')

@section('css')
<link rel="stylesheet" type="text/css" href="payment/css/payment.css">
@stop

@section('javascript')

@stop

@section('main')
<section class="hs-section mb-50">
	<div class="container">
		<div class="row">
			<div class="complete-container">
				<div class="complete-center">
					<img src="{{ asset('local/storage/app/public/payment/image/checked.png') }}">
					<p>Cảm ơn bạn đã đặt homestay này tại Ctogo. Bộ phận chăm sóc khách hàng sẽ gọi điện lại xác nhận cho bạn khi thanh toán thành công</p>
				</div>
			</div>
		</div>
	</div>
</section>
@stop
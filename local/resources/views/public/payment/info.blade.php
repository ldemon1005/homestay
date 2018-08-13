@extends('public.user-master')

@section('css')
<link rel="stylesheet" type="text/css" href="payment/css/payment.css">
@stop

@section('javascript')

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
					<div class="row">
						<div class="col-12 col-md-6 col-lg-6">
							<div class="form-item-2">
								<label>Tên người liên hệ:</label>
								<input type="text" name="" value="" placeholder="Họ và tên">
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-6">
							<div class="form-item-2">
								<label>Email:</label>
								<input type="text" name="" value="" placeholder="email@example.com">
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-6">
							<div class="form-item-2">
								<label>Số di động:</label>
								<input type="text" name="" value="" placeholder="+84123456789">
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-6">
							<div class="form-item-2">
								<label>Quốc gia:</label>
								<input type="text" name="" value="">
							</div>
						</div>
					</div>

					<div class="form-item-2 right-bottom">
						<button>Tiếp tục</button>
					</div>
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
								<div class="book-homestay-name">Garden homestay</div>
								<div class="book-homestay-address"><i class="fas fa-map-marker-alt"></i> Nguyễn khuyến, P5, TP.Đà Lạt</div>
							</div>
						</div>
						<div class="book-info">
							<div class="book-info-row">
								<span class="book-info-left">Số đêm nghỉ</span>
								<span class="book-info-right">1 đêm</span>
							</div>

							<div class="book-info-row">
								<span class="book-info-left">Ngày đến</span>
								<span class="book-info-right">31/05/2018</span>
							</div>

							<div class="book-info-row">
								<span class="book-info-left">Ngày đi</span>
								<span class="book-info-right">01/06/2018</span>
							</div>

							<div class="book-info-row">
								<span class="book-info-left">Số người</span>
								<span class="book-info-right">2</span>
							</div>
							<hr>
							<div class="book-info-row">
								<span class="book-info-left">200.000đ x 1 đêm</span>
								<span class="book-info-right">200.000đ</span>
							</div>
							<hr>
							<div class="book-info-row-last">
								<span class="book-info-left">TỔNG</span>
								<span class="book-info-right">200.000đ</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop
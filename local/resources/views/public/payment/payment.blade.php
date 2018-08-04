@extends('public.user-master')

@section('css')
<link rel="stylesheet" type="text/css" href="payment/css/payment.css">
@stop

@section('javascript')

@stop

@section('main')
<section class="hs-section mb-50">
	<div class="container">
		<div class="row mb-4">
			<div class="col-12">
				<h6>Thông tin liên hệ/Thông tin khách</h6>	
				<p><span><i class="fas fa-exclamation"></i> Lưu ý:</span> Khi bạn thanh toán bằng Thẻ tín dụng, Thanh toán trực tuyến, Chuyển khoản hoặc thanh toán tại cửa hàng thì bạn sẽ nhận được ưu đãi 20% từ Ctogo.</p>	
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-8 col-lg-8">
				<div>
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Thẻ tín dụng</a>
							<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Thanh toán trực tuyến</a>
							<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Chuyển khoản</a>
							<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-a" role="tab" aria-controls="nav-a" aria-selected="false">Tại cửa hàng</a>
							<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-b" role="tab" aria-controls="nav-b" aria-selected="false">Tại homestay</a>
						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

						</div>
						<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
							
						</div>
						<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
							@include('public.payment.ck')
						</div>
						<div class="tab-pane fade" id="nav-a" role="tabpanel" aria-labelledby="nav-a-tab">

						</div>
						<div class="tab-pane fade" id="nav-b" role="tabpanel" aria-labelledby="nav-b-tab">...</div>
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
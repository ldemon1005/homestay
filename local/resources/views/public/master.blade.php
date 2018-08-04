@extends('public.grand-master')

@section('header-bottom')
<section id="header-bottom">
	<div class="container">
		<div class="row header-bottom">
			<ul class="menu">
				<li><a id="destinations">ĐIỂM ĐẾN</a>
					<div class="dropdown-destination">
						<ul>
							<a href="{{ asset('search?location=Hà+Nội&start=&end=&slot=1') }}">Hà Nội</a>
							<a href="{{ asset('search?location=Hồ+Chí+Minh%2C+Việt+Nam&start=&end=&slot=1') }}">Tp. Hồ Chí Minh</a>
							<a href="{{ asset('search?location=Nha+Trang&start=&end=&slot=1') }}">Nha Trang</a>
							<a href="{{ asset('search?location=Đà+Nẵng&start=&end=&slot=1') }}">Đà Nẵng</a>
							<a href="{{ asset('search?location=Sapa&start=&end=&slot=1') }}">Sapa</a>
							<a href="{{ asset('search?location=Huế&start=&end=&slot=1') }}">Huế</a>
							<a href="{{ asset('search?location=Hội+An&start=&end=&slot=1') }}">Hội An</a>
							<a href="{{ asset('search?location=Phú+Quốc&start=&end=&slot=1') }}">Phú Quốc</a>
							<a href="{{ asset('search?location=Cát+Bà&start=&end=&slot=1') }}">Cát Bà</a>
							<a href="{{ asset('search?location=Quảng+Bình&start=&end=&slot=1') }}">Quảng Bình</a>
							<a href="{{ asset('search?location=Hải+Phòng&start=&end=&slot=1') }}">Hải Phòng</a>
							<a href="{{ asset('search?location=Thanh+Hóa&start=&end=&slot=1') }}">Thanh Hóa</a>
						</ul>
					</div>
				</li>
				{{-- <li><a href="">HOMESTAY</a></li> --}}
				<li><a href="/blog">BLOG</a></li>
				<li><a href="/host-homestay">TRỞ THÀNH MỘT HOST</a></li>
			</ul>
		</div>
	</div>
</section>
@stop
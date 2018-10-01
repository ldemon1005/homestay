<div id="footer">
	<section id="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-6 col-md-4 col-lg-4">
				<h6 class="footer-h6">thông tin</h6>
					<ul class="footer-info">
						<li>Hotline: {{isset($website_info->hotline) ? $website_info->hotline : ''}}</li>
						<li><a href="{{asset('support')}}">Trợ giúp</a></li>
						<li><a href="http://cgroupvn.com/tin-tuyen-dung" target="_blank">Tuyển dụng</a></li>
						<li><a href="{{asset('contact-us')}}">Liên hệ với chúng tôi</a></li>
					</ul>
				</div>
				<div class="col-6 col-md-4 col-lg-4">
					<h6 class="footer-h6">khác</h6>
					<ul class="footer-other">
						<li><a href="{{ env('BLOG_URL') }}">Blog</a></li>
						<li><a href="{{asset('terms-and-conditions')}}">Điều khoản và điều kiện</a></li>
						<li><a href="{{asset('copyright')}}">Chính sách bản quyền</a></li>
					</ul>
				</div>
				<div class="col-12 col-md-4 col-lg-4">
					<h6 class="footer-h6">kết nối với chúng tôi</h6>
					<ul class="footer-social">
						<li><a href="{{isset($website_info->link_facebook) ? $website_info->link_facebook : ''}}"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="{{isset($website_info->link_youtobe) ? $website_info->link_youtobe : ''}}"><i class="fab fa-youtube"></i></a></li>
						<li><a href="{{isset($website_info->link_instagram) ? $website_info->link_instagram : ''}}"><i class="fab fa-instagram"></i></a></li>
						<li><a href="{{isset($website_info->link_twitter) ? $website_info->link_twitter : ''}}"><i class="fab fa-twitter"></i></a></li>
						<li><a href="{{isset($website_info->link_google) ? $website_info->link_google : ''}}"><i class="fab fa-google-plus-g"></i></a></li>
					</ul>

					<ul class="download">
						<li><a href="{{isset($website_info->link_appstore) ? $website_info->link_appstore : ''}}"><img src=" header-footer/image/app.png "></a></li>
						<li><a href="{{isset($website_info->link_googleplay) ? $website_info->link_googleplay : ''}}"><img src=" header-footer/image/play.png "></a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section id="footer-bottom">
		<div class="container">
			<div class="row footer-bottom">
				<p>Copyright by cgroupvn.com</p>
			</div>
		</div>
	</section>

	<div class="to-top"></div>
</div>
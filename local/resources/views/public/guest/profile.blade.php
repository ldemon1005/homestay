@extends('public.user-master')

@section('css')

<link rel="stylesheet" type="text/css" href="guest/css/yourhomestay.css">
<link rel="stylesheet" type="text/css" href="guest/css/profile.css">
@stop

@section('javascript')
<script type="text/javascript" src="guest/js/profile.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
			$('.ava').click(function(){
				$('#ava-input').click();
			});

			$('#ava-input').change(function(e){
	            $('#ava-form').submit();
	        });

	        $('#ava-form').on('submit',function(e){
	        	e.preventDefault();
	        	$.ajax({
					url: "{{ asset('user/ajaxAvatar') }}", 
					type: "POST",
					data: new FormData(this),
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false        // To send DOMDocument or non processed data file it is set to false
				}).done(function(e){
					$('.ava').attr('style','background-image:url( {{ asset('local/storage/app/image/user-3/') }}/'+ e.avatar +' )');
					$('.avatar').attr('style','background-image:url( {{ asset('local/storage/app/image/user-3/') }}/'+ e.avatar +' )');
				});
	        });

		// keep tab on reload
		$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
			localStorage.setItem('activeTab', $(e.target).attr('href'));
		});
		var activeTab = localStorage.getItem('activeTab');
		if(activeTab){
			$('#myTab a[href="' + activeTab + '"]').tab('show');
		}

		
	});
</script>
@stop

@section('main')
<section class="hs-section">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-4 col-lg-4">
				<div id="sidebar">
					<div class="ava" style="background-image: url({{ asset('local/storage/app/image/user-3/'.Auth::user()->avatar) }});">
						<img src="{{ asset('local/storage/app/image/ava-subtitute.png') }}">
					</div>

					<form style="display: none;" id="ava-form" enctype="multipart/form-data" method="post" action="{{ asset('profile/ava') }}">
						{{csrf_field()}}
						<input id="ava-input" style="display: none;" type="file" name="image">
						}
					</form>

					<div class="info">
						<p class="white fs-24 semibold center mb-1">{{ Auth::user()->name ?? '' }}</p>
						<p class="white fs-14 center">{{ Auth::user()->email ?? '' }}</p>
					</div>

					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"><i class="fas fa-user"></i> Tài khoản của bạn</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"><i class="fas fa-key"></i> Thay đổi mật khẩu</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"><i class="fas fa-cog"></i> Quản lý đặt phòng</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="contact-tab" data-toggle="tab" href="#list" role="tab" aria-controls="list"><i class="fas fa-bell"></i> Thông báo</a>
						</li>
					</ul>
					<a href="{{ asset('user/logout') }}" class="signout">Đăng xuất <i class="fas fa-sign-out-alt"></i></a>
				</div>
			</div>

			<div class="col-12 col-md-6 col-lg-6 offset-lg-1">
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<h2 class="bold fs-24 black">Tài khoản của bạn</h2>

						<form id="form-account" method="post" action="{{ asset('user/updateProfile') }}">
							<div class="form-item-2">
								<label>Họ và tên <span title="Thông tin bắt buộc">*</span></label>
								<input type="text" name="name" placeholder="Họ và tên" value="{{ Auth::user()->name ?? ''}}">
							</div>

							<div class="form-item-2">
								<label>Số điện thoại</label>
								<input type="text" name="phone" placeholder="Số điện thoại" value="{{ Auth::user()->phone ?? "" }}">
							</div>

							<div class="form-item-2">
								<label>Giới tính</label>
								<select name="sex">
									<option @if ( isset(Auth::user()->sex) && Auth::user()->sex == 1 ) selected="" @endif value="1">Nam</option>
									<option @if ( isset(Auth::user()->sex) && Auth::user()->sex == 2 ) selected="" @endif value="2">Nữ</option>
								</select>
							</div>

							<div class="form-item-2">
								<label>Mô tả:</label>
								<textarea name="description" placeholder="Mô tả về bạn">{{Auth::user()->description ?? ''}}</textarea>
								<div class="tip-text">Tối đa 100 ký tự</div>
							</div>

							<div class="form-item-2 form-item-2-btn">
								<button class="save-btn" type="submit">Lưu</button>
							</div>

							{{ csrf_field() }}
						</form>
					</div>

					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<h2 class="bold fs-24 black">Đổi mật khẩu</h2>
						@if (session('error'))
						<div class="alert alert-danger">
							{{ session('error') }}
						</div>
						@endif
						@if (session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
						@endif
						<form id="form-changepassword" method="post" action="{{ asset('user/updatePassword') }}">
							<div class="form-item-2">
								<label>Mật khẩu cũ:</label>
								<input type="password" name="old_password" placeholder="Mật khẩu cũ" value="">
							</div>

							<div class="form-item-2">
								<label>Mật khẩu mới:</label>
								<input type="password" name="new_password" placeholder="Mật khẩu mới" value="">
							</div>

							<div class="form-item-2">
								<label>Nhập lại mật khẩu mới:</label>
								<input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu" value="">
							</div>

							<div class="form-item-2">
								<button class="save-btn" type="submit">Lưu</button>
							</div>

							{{ csrf_field() }}
						</form>
					</div>

					<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
						<h2 class="bold fs-24 black">Quản lý đặt phòng</h2>

					</div>

					<div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
						<h2 class="bold fs-24 black">Thông báo</h2>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</section>
@stop
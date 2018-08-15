@extends('public.grand-master')

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
					contentType: false,
					cache: false,
					processData:false
				}).done(function(e){
					$('.ava').attr('style','background-image:url( {{ asset('local/storage/app/image/user-3/') }}/'+ e.avatar +' )');
					$('.avatar').attr('style','background-image:url( {{ asset('local/storage/app/image/user-3/') }}/'+ e.avatar +' )');
				});
	        });

		// // keep tab on reload
		// $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		// 	localStorage.setItem('activeTab', $(e.target).attr('href'));
		// });
		// var activeTab = localStorage.getItem('activeTab');
		// if(activeTab){
		// 	$('#myTab a[href="' + activeTab + '"]').tab('show');
		// }

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
					</form>

					<div class="info">
						<p class="white fs-24 semibold center mb-1">{{ Auth::user()->name ?? '' }}</p>
						<p class="white fs-14 center">{{ Auth::user()->email ?? '' }}</p>
					</div>

					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account"><i class="fas fa-user"></i> Tài khoản của bạn</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password"><i class="fas fa-key"></i> Thay đổi mật khẩu</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="manage-tab" data-toggle="tab" href="#manage" role="tab" aria-controls="manage"><i class="fas fa-cog"></i> Quản lý đặt phòng</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="noti-tab" data-toggle="tab" href="#noti" role="tab" aria-controls="noti"><i class="fas fa-bell"></i> Thông báo <span class="has-noti">12</span></a>
						</li>
					</ul>

					<a href="{{ asset('user/logout') }}" class="signout">Đăng xuất <i class="fas fa-sign-out-alt"></i></a>
				</div>
			</div>

			<div class="col-12 col-md-8 col-lg-8">
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active ml-5" id="account" role="tabpanel" aria-labelledby="account-tab">
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

					<div class="tab-pane fade ml-5" id="password" role="tabpanel" aria-labelledby="password-tab">
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

					<div class="tab-pane fade" id="manage" role="tabpanel" aria-labelledby="manage-tab">
						<h2 class="bold fs-24 black">Quản lý đặt phòng</h2>

						<div id="book-table">
							<table>
								<thead>
									<tr>
										<td>Mã đặt phòng</td>
										<td>Homestay</td>
										<td>Thời gian</td>
										<td>Chi phí</td>
										<td>Tình trạng</td>
										<td>Chi tiết</td>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td>X46WVB</td>
										<td>Old Quarter View House - 3 Bedroom - Easternstay</td>
										<td>25-07-2018 -- 28-07-2018</td>
										<td>252 USD</td>
										<td><span class="text-warning">Incompleted</span></td>
										<td><a onclick="return seeDetailModal(1);">Xem</a></td>
									</tr>

									<tr>
										<td>REQQIC</td>
										<td>ATHENA BOUTIQUE VILLA</td>
										<td>23-07-2018 -- 26-07-2018</td>
										<td>515 USD</td>
										<td><span class="text-danger">Cancelled</span></td>
										<td><a onclick="return seeDetailModal(2);">Xem</a></td>
									</tr>

									<tr>
										<td>REQQIC</td>
										<td>ATHENA BOUTIQUE VILLA</td>
										<td>23-07-2018 -- 26-07-2018</td>
										<td>515 USD</td>
										<td><span class="text-success">Success</span></td>
										<td><a onclick="return seeDetailModal(3);">Xem</a></td>
									</tr>

									<tr>
										<td>REQQIC</td>
										<td>ATHENA BOUTIQUE VILLA</td>
										<td>23-07-2018 -- 26-07-2018</td>
										<td>515 USD</td>
										<td><span class="text-primary">Done</span></td>
										<td><a onclick="return seeDetailModal(3);">Xem</a></td>
									</tr>
								</tbody>

							</table>
						</div>
					</div>

					<div class="tab-pane fade ml-5" id="noti" role="tabpanel" aria-labelledby="noti-tab">
						<h2 class="bold fs-24 black">Thông báo</h2>

						<div id="noti-cont">
							<div class="noti-list">
								<a class="unread">
									<p><b>Trần Hương Giang</b> đã đặt phòng <b>Luxury</b> của bạn</p>
									<p class="fs-12 grey-a"><i class="fas fa-clock"></i> 1 phút trước</p>
								</a>

								<a>
									<p><b>Trần Hương Giang</b> đã đặt phòng <b>Luxury</b> của bạn</p>
									<p class="fs-12 grey-a"><i class="fas fa-clock"></i> 1 phút trước</p>
								</a>

								<a>
									<p><b>Bạn</b> đã đặt phòng <b>Luxury</b> của <b>Garden Homestay</b></p>
									<p class="fs-12 grey-a"><i class="fas fa-clock"></i> 1 phút trước</p>
								</a>

								<a>
									<p><b>Bạn</b> đã đặt phòng <b>Luxury</b> của <b>Garden Homestay</b></p>
									<p class="fs-12 grey-a"><i class="fas fa-clock"></i> Hôm qua lúc 10:37</p>
								</a>

								<a>
									<p><b>Bạn</b> đã đặt phòng <b>Luxury</b> của <b>Garden Homestay</b></p>
									<p class="fs-12 grey-a"><i class="fas fa-clock"></i> 13 Tháng 8 lúc 10:37</p>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				{{--ajax see detail modal here--}}
			</div>
		</div>
	</div>
</div>
@stop
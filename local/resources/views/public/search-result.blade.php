@extends('public.master')

@section('css')
<link rel="stylesheet" type="text/css" href="base/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" type="text/css" href="search-result/css/nouislider.min.css">
<link rel="stylesheet" type="text/css" href="search-result/css/search-result.css">
@stop

@section('javascript')
<script type="text/javascript" src="base/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="search-result/js/nouislider.min.js"></script>
<script type="text/javascript" src="search-result/js/wNumb.js"></script>
<script type="text/javascript" src="search-result/js/search-result.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9yWMAqS_gR49H1kcehbFpYq8V936OnBc&libraries=places&callback=initAutocomplete"
async defer></script>
<script>
	function search(){
		var form_data = $('#facility_form').serialize() + '&' + $('#main-form').serialize();
		$.ajax({
			type: "POST",
			url: '{{ asset('search-ajax') }}',
			data: form_data,
			// dataType: "json",
		}).done( function(result){
			console.log(result);
			$('#homestay-list').html(result);
		});
	}
	
	function initAutocomplete() {
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
    }
</script>
@stop

@section('main')
<section class="section-1">
	<div class="container">
		<div class="row">
			<div class="form-container">
				<h6 class="center white mt-4 fs-24">Homestay tại Hà Nội</h6>
				<div class="search-form">
					<form id="main-form" method="get" action=" {{ asset('search') }} ">
						<div class="first-row">
							<div class="my-form">
								<label>Điểm đến</label>
								<div class="destination"><input id="pac-input" type="text" name="location" placeholder="Bạn muốn đến đâu" value="{{ Request::get('location') ?? '' }}"></div>
							</div>

							<div class="my-form input-daterange">
								<div class="date-input">
									<label>Ngày đi</label>
									<div class="calendar"><input autocomplete="off" type="text" name="start" placeholder="Ngày đi" value="{{ Request::get('start') ?? '' }}"></div>
								</div>
								<div class="date-input">
									<label>Ngày về</label>
									<div class="calendar"><input autocomplete="off" type="text" name="end" placeholder="Ngày về" value="{{ Request::get('end') ?? '' }}"></div>
								</div>
							</div>

							<div class="my-form">
								<label>Số người</label>
								<select name="slot">
									@for($i = 1; $i<=20; $i++)
									<option @if( Request::get('slot') == $i ) selected="" @endif value="{{ $i }}">{{ $i }}</option>
									@endfor
								</select>
							</div>

							<div class="my-form">
								<label class="transparent">Tìm</label>
								<button type="submit">TÌM</button>
							</div>
						</div>

						<div class="second-row">
							<div class="check-form">
								<input class="checkbox" type="checkbox" name=""> Tôi đi công tác
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section-2 hs-section">
	<div class="container">
		<div class="row">
			<form id="facility_form" class="col-12 col-md-4 col-lg-4" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="my-form">
					<label>Giá</label>
					<div id="price"></div>
					<input onchange="search()" id="price-from" name="price_from">
					<input onchange="search()" id="price-to" name="price_to">
				</div>
				<div class="my-form">
					<label>Số phòng ngủ</label>
					<select onchange="search()" name="number_of_bedroom">
						@for($i=1;$i<=10;$i++)
						<option value="{{$i}}">{{$i}}</option>
						@endfor
					</select>
				</div>

				<hr>

				<div class="my-form">
					<label>Phân loại</label>
					<div><input onchange="search()" type="checkbox" name="homestay_type[]" value="1"> Dormitary</div>
					<div><input onchange="search()" type="checkbox" name="homestay_type[]" value="2"> Homestay</div>
					<div><input onchange="search()" type="checkbox" name="homestay_type[]" value="3"> Nhà riêng</div>
				</div>

				<hr>

				<div class="my-form">
					<label>Tiện ích giải trí</label>
					@foreach($facilities as $facility)
					<div><input onchange="search()" type="checkbox" name="facility[]" value="{{ $facility->facility_id }}"> {{ $facility->facility_name }}</div>
					@endforeach
				</div>

				<hr>

				<div class="my-form">
					<label>Tiện ích phòng</label>
					@foreach($bedroom_facilities as $bedroom_facility)
					<div><input onchange="search()" type="checkbox" name="bedroom_facility[]" value=" {{ $bedroom_facility->bedroom_facility_id }} "> {{ $bedroom_facility->bedroom_facility_name }}</div>
					@endforeach
				</div>
			</form>

			<div id="homestay-list" class="col-12 col-md-8 col-lg-8">
				<p class="grey-9 fs-10 right">Hiển thị {{ count($homestays) }} trên {{($homestays->currentpage()-1) * $homestays->perpage() + $homestays->count()}} homestay</p>
				@foreach($homestays as $homestay)
				<div class="homestay-item">
					<a href="{{ asset('detail/'.$homestay->homestay_id) }}" class="item-image" style="background-image: url(/host-homestay/local/storage/app/image/{{$homestay->homestay_image}});"></a>
					<div class="item-content">
						<a href="{{ asset('detail/'.$homestay->homestay_id) }}" class="italic grey-9 fs-16 mb-1">{{$homestay->homestay_name}}</a>
						<p class="grey-9 fs-10 mb-1">{{$homestay->homestay_location}}</p>
						<p class="grey-9 fs-10 mb-2">
							<i class="fas fa-bed"></i> {{ count($homestay->bedroom) }}
							<i class="fas fa-user ml-4"></i> {{ getMax($homestay->bedroom, 'bedroom_slot') }}
						</p>
						<p class="fs-14">{{ cut_string($homestay->homestay_about, 70) }}</p>
						<div class="slide-price">giá từ: {{ getMin($homestay->bedroom,'bedroom_price') }} Đ</div>
						<div class="slide-review">
							<span class="slide-score">{{ getAverage($homestay->comment,'comment_rate') }}</span>
							<a class="slide-grade">
								<span>Xuất sắc</span>
								<span class="hs-small-text">{{ count($homestay->comment) }} đánh giá</span>
							</a>
						</div>
					</div>
				</div>
				@endforeach

				{{ $homestays->links() }}
			</div>
		</div>
	</div>
</section>
@stop
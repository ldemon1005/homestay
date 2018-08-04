@extends('public.master')

@section('css')

@stop

@section('javascript')
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&language=en"></script>
<script>
	var input = document.getElementById('myInput');
	var autocomplete = new google.maps.places.Autocomplete(input);
</script>
@stop

@section('main')
<form method="post">

	<div>
		tên homestay
		<input type="text" name="homestay_name">
	</div>
	<div>
		loại homestay
		<select name="homestay_type">
			<option value="1">home stay</option>
			<option value="2">dorm</option>
		</select>
	</div>
	<div>
		about 
		<textarea name="about"></textarea>
	</div>
	<div>
		facility
		<input type="checkbox" name="homestay_facility[]" value="1"> Garden
		<input type="checkbox" name="homestay_facility[]" value="2"> Light
		<input type="checkbox" name="homestay_facility[]" value="3"> Window
		<input type="checkbox" name="homestay_facility[]" value="4"> Internet
		<input type="checkbox" name="homestay_facility[]" value="5"> Laptop
		<input type="checkbox" name="homestay_facility[]" value="6"> Door
		<input type="checkbox" name="homestay_facility[]" value="7"> Air
	</div>
	<div class="autocomplete">
		location
		<input type="text" id="myInput" name="homestay_location">
	</div>
	<div>
		rule
		<textarea name="homestay_rule"></textarea>
	</div>
	<div>
		kitchen
		<input type="radio" name="homestay_kitchen" value="1"> Có
		<input type="radio" name="homestay_kitchen" value="0"> Ko
	</div>
	<div>
		meal
		<input type="radio" name="homestay_kitchen" value="1"> Có
		<input type="radio" name="homestay_kitchen" value="0"> Ko
	</div>
	<button type="submit">send</button>
	{{csrf_field()}}
</form>
@stop
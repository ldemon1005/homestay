<div class="book-box">
	<div class="book-box-header">
		Thông tin homestay
	</div>
	<div class="book-box-body">
		<div class="book-homestay">
			<div class="book-image" style="background-image: url(https://scontent.fhan5-1.fna.fbcdn.net/v/t1.0-0/p526x296/36342061_10214793221356628_5207655401247473664_n.jpg?_nc_cat=0&oh=2f9378d7f2308b2d7cb641c594304ef5&oe=5B9FD331);"></div>
			<div class="book-homestay-info">
				<div class="book-homestay-code">Mã đặt chỗ: {{$order['code']}}</div>
				<div class="book-homestay-name">{{$homestay->homestay_name}}</div>
				<div class="book-homestay-address"><i class="fas fa-map-marker-alt"></i> {{$homestay->homestay_location}}</div>
			</div>
		</div>
		<div class="book-info">
			<div class="book-info-row">
				<span class="book-info-left">Số đêm nghỉ</span>
				<span class="book-info-right">{{$number_night}} đêm</span>
			</div>

			<div class="book-info-row">
				<span class="book-info-left">Ngày đến</span>
				<span class="book-info-right">{{$order['start']}}</span>
			</div>

			<div class="book-info-row">
				<span class="book-info-left">Ngày đi</span>
				<span class="book-info-right">{{$order['end']}}</span>
			</div>

			<div class="book-info-row">
				<span class="book-info-left">Số người</span>
				<span class="book-info-right">{{$order['slot']}}</span>
			</div>
			<hr>
			<div class="book-info-row">
				<span class="book-info-left">{{number_format($order['price'])}}đ x 1 đêm</span>
			</div>
			<hr>
			<div class="book-info-row">
				<span class="book-info-discount">Giảm (-20%)</span>
			</div>
			<div class="book-info-row-last">
				<span class="book-info-left">TỔNG</span>
				<span class="book-info-right">{{number_format($total_money * 0.8)}}</span>
			</div>
		</div>
	</div>
</div>
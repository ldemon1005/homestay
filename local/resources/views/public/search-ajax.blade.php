<p class="grey-9 fs-10 right">Hiển thị {{ count($homestays) }}
    trên {{($homestays->currentpage()-1) * $homestays->perpage() + $homestays->count()}} homestay</p>
@foreach($homestays as $homestay)
    <div class="homestay-item">
        <a href="{{ asset('detail/'.$homestay->homestay_id) }}" class="item-image"
           style="background-image: url( {{ is_url_exist(env('HOST_URL').'/local/storage/app/image/'.$homestay->homestay_image) ? env('HOST_URL').'/local/storage/app/image/'.$homestay->homestay_image : $homestay->homestay_image }} ) ;"></a>
        <div class="item-content">
            <a href="{{ asset('detail/'.$homestay->homestay_id) }}"
        class="italic grey-9 fs-16 mb-1">{{$homestay->homestay_name}}</a>
        <p class="grey-9 fs-10 mb-1">{{$homestay->homestay_location}}</p>
        <p class="grey-9 fs-10 mb-2">
            <i class="fas fa-door-open"></i> {{ count($homestay->bedroom) }}
            <i class="fas fa-user ml-4"></i> {{ getMax($homestay->bedroom, 'bedroom_slot') }}
        </p>
        <p class="fs-12 black">{!! cut_string($homestay->homestay_about, 150) !!}</p>
        <div class="slide-price">giá từ: {{ number_format( getMin($homestay->bedroom,'bedroom_price'),0,',','.' ) }} Đ</div>
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
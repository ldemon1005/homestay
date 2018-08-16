{{--for-ajax--}}
@foreach($blogs as $blog)
    <div class="slide-item">
        <a href="{{env('BLOG_URL')}}/bai-viet/{{ $blog['slug'] }}/{{ $blog['id'] }}" class="slide-image" style="background-image: url({{env('BLOG_URL')}}/storage/app/image/{{$blog['image']}});"></a>
        <p class="hs-small-text mt-2"><i class="fas fa-calendar-alt"></i> {{$blog['created_at']}} </p>
        <a href="{{env('BLOG_URL')}}/bai-viet/{{ $blog['slug'] }}/{{ $blog['id'] }}" class="normalize semi-bold">{{$blog['title']}}</a>
        <a href="{{env('BLOG_URL')}}/bai-viet/{{$blog['slug']}}/{{$blog['id']}}" class="hs-btn hs-btn-110-38 corner-left-bot">XEM</a>
    </div>
@endforeach
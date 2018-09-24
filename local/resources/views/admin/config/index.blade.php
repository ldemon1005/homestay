<form method="post" enctype="multipart/form-data" action=" {{ asset('admin/config/banner') }} ">
    Banner:
    <input type="file" name="value" value="{{ $banner->value }}" accept="image/*">
    <button>Send</button>
    {{csrf_field()}}
</form>
<br>
@foreach( unserialize($banner->value) as $banner)
    {{$banner}}
    <br>
@endforeach
<form method="post">
    Info:
    <input name="value" value="{{ $info->value }}">
    <button>Send</button>
    {{csrf_field()}}
</form>

<br>

<form method="post">
    Term:
    <input name="value" value="{{ $term->value }}">
    <button>Send</button>
    {{csrf_field()}}
</form>

<br>

<form method="post">
    Policy:
    <input name="value" value="{{ $policy->value }}">
    <button>Send</button>
    {{csrf_field()}}
</form>
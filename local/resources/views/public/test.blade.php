<form method="post" action="{{ asset('signup') }}">
	Name: <input type="text" name="name">
	<br>
	Email: <input type="email" name="email">
	<br>
	Password: <input type="password" name="password">
	<br>
	Password confirm: <input type="password" name="password_confirm">
	<br>
	Phone: <input type="phone" name="phone">
	<br>
	Nation: <input type="nation" name="nation">
	<br>
	Level: <input type="level" name="level">
	{{csrf_field()}}
	<br>
	<button type="submit">Send</button>
</form>


@foreach($errors->all() as $err) {{$err}} @endforeach

@if( Session::has('error') )
{{Session::get('error')}}
@endif

<form method="post" action="{{ asset('login') }}">
	Email: <input type="email" name="email">
	<br>
	Password: <input type="password" name="password">
	<br>
	<button type="submit">Send</button>
	{{ csrf_field() }}
</form>
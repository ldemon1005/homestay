<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="icon" href="">

	<base href="{{ asset('local/storage/app/public') }}/">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-signin-client_id" content="758738020038-ke08tcku4c5rugooldj91ajm5esss6a6.apps.googleusercontent.com">

	<!-- css -->
	<link rel="stylesheet" type="text/css" href="base/css/reset.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="base/css/base.css">
	<link rel="stylesheet" type="text/css" href="header-footer/css/header-footer.css">
	
	@yield('css')
	<!-- end css -->
</head>

<body>
	<div id="wrapper">
		{{-- HEADER --}}
		@include('public.header-footer.header')
		{{-- END HEADER --}}

		{{-- MAIN --}}
		<div id="main">
			@yield('main')
		</div>
		{{-- END MAIN --}}

		{{-- FOOTER --}}
		@include('public.header-footer.footer')
		{{-- END FOOTER --}}
	</div>
	<!-- script -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"
			integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
			integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
			crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
			integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
			crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>

	<script type="text/javascript" src="header-footer/js/header-footer.js"></script>
@yield('javascript')
<!-- end script -->
</body>
</html>
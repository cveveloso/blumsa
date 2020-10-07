<!DOCTYPE html>
<html>
<head>
	<title>Blumsa - @yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="{{ url('public/static/vendors/bootstrap/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ url('public/static/vendors/fontawesome/css/all.min.css') }}" />
	<link rel="stylesheet" href="{{ url('public/static/css/style.css') }}" />

	<script type="text/javascript" src="{{ url('public/static/vendors/jquery/jquery-3.3.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('public/static/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
</head>
<body>
	@section('content')
	@show

	@if(Session::has('message'))
	<div class="container mt-4">
		<div class="alert alert-{{ Session::get('typemessage') }}" role="alert" style="display: none;">
			{{ Session::get('message') }}
			@if ($errors->any())
			<ul>
				@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
			@endif
			<script>
				$('.alert').slideDown();
				setTimeout(function(){ $('.alert').slideUp(); }, 10000);
			</script>
		</div>
	</div>
	@endif
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Blumsa - @yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="{{ url('public/static/vendors/bootstrap/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ url('public/static/vendors/fontawesome/css/all.min.css') }}" />
	<link rel="stylesheet" href="{{ url('public/static/css/login.css') }}" />

	<script type="text/javascript" src="{{ url('public/static/vendors/jquery/jquery-3.3.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('public/static/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
</head>
<body>
	@section('content')
	@show

	@if(Session::has('message'))

	<div class="modal fade" id="messageModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title">Mensaje</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">

				<div class="container mt-4">
					<div class="alert alert-{{ Session::get('typemessage') }}" role="alert">
						{{ Session::get('message') }}
						@if ($errors->any())
						<ul>
							@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
						@endif
					</div>
				</div>

			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		  </div>
		</div>
	  </div>
	  <script>
		$("#messageModal").modal();		  
	  </script>
	@endif
</body>
</html>
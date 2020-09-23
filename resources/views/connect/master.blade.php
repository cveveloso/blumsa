<!DOCTYPE html>
<html>
	<head>
		<title>@yield("title")</title>
	    <!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">		

		<link rel="stylesheet" type="text/css" href="{{url('css/app.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('css/customlogin.css')}}">
		<script type="text/javascript" src={{url('js/app.js')}}></script>

		<link rel="stylesheet" type="text/css" href="{{url('common/fontawesome4/css/font-awesome.min.css')}}">

	</head>
	<body style="background-color: #ffffff">
			@section("content")
			@show
	</body>
</html>
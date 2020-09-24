@extends('Account.Master')

@section('title', 'Ingreso')

@section('content')
<div class="card w-50 p-2">
	{!! Form::open(['url' => '/account/register']) !!}
	<label for="firstname">Nombre: </label>
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>			
		</div>
		{!! Form::text('firstname', null, ['class' =>'form-control']) !!}
	</div>

	<label for="lastname">Apellido: </label>
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>			
		</div>
		{!! Form::text('lastname', null, ['class' =>'form-control']) !!}
	</div>

	<label for="email">Email: </label>
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="fa fa-at" aria-hidden="true"></i></div>			
		</div>
		{!! Form::email('email', null, ['class' =>'form-control']) !!}
	</div>

	<label for="password">Password: </label>
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="fas fa-lock" aria-hidden="true"></i></div>			
		</div>
		{!! Form::password('password', ['class' =>'form-control']) !!}
	</div>

	<label for="cpassword">Confirmar password: </label>
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<div class="input-group-text"><i class="fas fa-lock" aria-hidden="true"></i></div>			
		</div>
		{!! Form::password('cpassword', ['class' =>'form-control']) !!}
	</div>

	{!! Form::submit('Registrarme', ['class' => 'btn btn-primary w-100 mt-4']) !!}
	{!! Form::close() !!}

	<div class="row mt-4">
		<div class="col-lg-6 text-center">
			<a href="{{ url('/account/authenticate') }}">Ya estoy registrado</a>
		</div>
		<div class="col-lg-6 text-center">
			<a href="{{ url('/account/forgotpassword') }}">Olvido su password</a>
		</div>
	</div>
</div>
@stop
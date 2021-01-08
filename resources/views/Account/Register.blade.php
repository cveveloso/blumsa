@extends('Account.Master')

@section('title', 'Ingreso')

@section('content')
				{!! Form::open(['url' => '/account/register', 'class' => 'form-signin']) !!}	
				<div class="text-center mb-4">
					<img class="mb-4" src="https://www.blumsa.com/App_Common/Image/logoBlum.jpg">										
				</div>							
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>			
					</div>
					{!! Form::text('firstname', null, ['class' =>'form-control','placeholder' => 'Nombre']) !!}
				</div>

				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>			
					</div>
					{!! Form::text('lastname', null, ['class' =>'form-control','placeholder' => 'Apellido']) !!}
				</div>

				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fa fa-at" aria-hidden="true"></i></div>			
					</div>
					{!! Form::email('email', null, ['class' =>'form-control','placeholder' => 'Email']) !!}
				</div>

				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-lock" aria-hidden="true"></i></div>			
					</div>
					{!! Form::password('password', ['class' =>'form-control' ,'placeholder' => 'Password']) !!}
				</div>

				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-lock" aria-hidden="true"></i></div>			
					</div>
					{!! Form::password('cpassword', ['class' =>'form-control','placeholder' => 'Confirmar Password']) !!}
				</div>
				{!! Form::submit('Registrarme', ['class' => 'btn btn-lg btn-primary btn-block']) !!}

				<div class="text-center mt-4">
					<a style="color:#495057;" href="{{ url('/account/authenticate') }}">Ya estoy registrado</a> - 
					<a style="color:#495057;" href="{{ url('/account/forgotpassword') }}">Olvido su password</a>					
				</div>	

				{!! Form::close() !!}
@stop
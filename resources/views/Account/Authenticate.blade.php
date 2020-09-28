@extends('Account.Master')

@section('title', 'Ingreso')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12"> 
				{!! Form::open(["url" => "/account/authenticate", "class" => "form-signin text-center"]) !!}	
				<img class="mb-4" src="{{url('image/logoBlum.jpg')}}" alt="">					
				<h1 class="h3 mb-3 font-weight-normal">Iniciar session</h1>	
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fa fa-at" aria-hidden="true"></i></div>			
					</div>
					{!! Form::email('email', null, ['class' =>'form-control']) !!}
				</div>
				<div class="input-group input-group-pass">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-lock" aria-hidden="true"></i></div>			
					</div>
					{!! Form::password('password', ['class' =>'form-control']) !!}
					<small id="passwordHelpBlock" class="form-text text-muted text-left">
						Su contraseña debe tener entre 8 y 20 caracteres, contener letras y números, y no debe contener espacios ni caracteres especiales.
					</small>					
				</div>
				{!! Form::submit('Ingresar', ['class' => 'btn btn-primary customBtnLogin w-100 mt-4']) !!}
				{!! Form::close() !!}

				<div class="row form-signin text-center">
					<div class="col-lg-6 text-center">
						<a href="{{ url('/account/register') }}">Registro de usuarios</a>
					</div>
					<div class="col-lg-6 text-center">
						<a href="{{ url('/account/forgotpassword') }}">Olvido su password</a>
					</div>
				</div>
		</div>
	</div>
</div>
@stop
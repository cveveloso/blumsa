@extends("connect.master")

@section("title","login")

@section("content")
		<div class="container">
			<div class="row">
				<div class="col-md-12"> 
					<!-- <form class="form-signin"> -->

						{!! Form::open(["url" => "/login", "class" => "form-signin text-center"]) !!}	
						<img class="mb-4" src="{{url('image/logoBlum.jpg')}}" alt="">			
						<h1 class="h3 mb-3 font-weight-normal">Iniciar session</h1>		
						<div class="input-group">	
					        <div class="input-group-prepend">
					          <div class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
					        </div>																	
							{!! Form::email('email', null,["class" => "form-control","id" => "inputEmail", "placeholder" => "Email address", "required" => "required"]) !!}								
						</div>	
						<div class="input-group input-group-pass">	
					        <div class="input-group-prepend">
					          <div class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></div>
					        </div>	
					        {!! Form::password("password", ["class" => "form-control","id" => "inputPassword", "placeholder" => "Password", "required" => "required"]) !!}																	
							<small id="passwordHelpBlock" class="form-text text-muted text-left">
							  Su contraseña debe tener entre 8 y 20 caracteres, contener letras y números, y no debe contener espacios ni caracteres especiales.
							</small>					        
					    </div>					        						
						<div class="checkbox mb-3 text-left customCheckRecordarme">
							<label>
							  <input type="checkbox" value="remember-me"> Recordarme
							</label>
						</div>
						<button class="btn btn-lg btn-primary btn-block customBtnLogin" type="submit">Ingresar</button>
						{!! Form::close() !!}
			    </div>
			</div>
		</div>
@stop
@extends('Admin.Master')

@section('title', Lang::get('admin.edituser'))
@section('headtitle', Lang::get('admin.edituser'))

@section('toolbar')
{!! Form::open(['url' => '/admin/user/update/'. $user->id]) !!}	

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit"><i class="far fa-save"></i></button>

<div class="modal" id="modalEdit" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <h5 class="modal-title">Confirmación</h5>
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	      </button>
	    </div>
	    <div class="modal-body">
	      <p>¿Seguro desea actualizar el usuario?</p>
	    </div>
	    <div class="modal-footer">
	      {!! Form::button('Aceptar', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
	      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	    </div>
	  </div>
	</div>
</div>

@stop

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  	<h5 class="card-title card-custom-title">Información</h5>
				<div class="form-group">
					<label class="control-label" for="sku">Email</label>
					{!! Form::text('email', old('email', $user->email), ['class' => 'form-control' . ($errors->has('email') ? ' border-danger' : ''), 'disabled' => 'true']) !!}
					<div class="invalid-feedback active">
						<i class="fa fa-exclamation-circle fa-fw"></i>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label" for="sku">Nombre</label>
					{!! Form::text('firstname', old('firstname', $user->firstname), ['class' => 'form-control' . ($errors->has('firstname') ? ' border-danger' : '')]) !!}
					<div class="invalid-feedback active">
						<i class="fa fa-exclamation-circle fa-fw"></i>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label" for="sku">Apellido</label>
					{!! Form::text('lastname', old('surname', $user->lastname), ['class' => 'form-control' . ($errors->has('lastname') ? ' border-danger' : '')]) !!}
					<div class="invalid-feedback active">
						<i class="fa fa-exclamation-circle fa-fw"></i>
					</div>
				</div>
			</div>
		</div>			
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  	<h5 class="card-title card-custom-title">Acceso</h5>
				<div class="form-group">
					<label class="control-label" for="sku">Fecha creación</label>
					{!! Form::text('created_at', old('created_at', $user->created_at), ['class' => 'form-control' . ($errors->has('created_at') ? ' border-danger' : ''), 'disabled' => 'true']) !!}
					<div class="invalid-feedback active">
						<i class="fa fa-exclamation-circle fa-fw"></i>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label" for="sku">Fecha modificación</label>
					{!! Form::text('updated_at', old('updated_at', $user->updated_at), ['class' => 'form-control' . ($errors->has('updated_at') ? ' border-danger' : ''), 'disabled' => 'true']) !!}
					<div class="invalid-feedback active">
						<i class="fa fa-exclamation-circle fa-fw"></i>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label" for="status">Habilitado: </label>
					<div class="form-control">
						{!! Form::checkbox('status', 'status', old('status', ($user->status == 1 ? true : false)), ['class' =>''])  !!}
					</div>
				</div>
			</div>
		</div>			
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  	<h5 class="card-title card-custom-title">Cliente</h5>
				<div class="form-group">
					<label class="control-label" for="sku">Cliente</label>
					{!! Form::select('customer', $comboCustomers, old('customer', $user->id_customer), ['class' =>'select2 form-control' . ($errors->has('customer') ? ' border-danger' : '')])  !!}
					<div class="invalid-feedback active">
						<i class="fa fa-exclamation-circle fa-fw"></i>
					</div>
				</div>
			</div>
		</div>			
	</div>
</div>

{!! Form::close() !!}

@stop



@extends('Admin.Master')

@section('title', Lang::get('admin.edituser'))
@section('headtitle', Lang::get('admin.edituser'))

@section('toolbar')
{!! Form::open(['url' => '/admin/customer/save']) !!}	

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
	      <p>¿Seguro desea guardar el cliente?</p>
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
					<label class="control-label" for="sku">Nro Cliente</label>
					{!! Form::text('company_code', old('company_code'), ['class' => 'form-control' . ($errors->has('company_code') ? ' border-danger' : '')]) !!}
					<div class="invalid-feedback active">
						<i class="fa fa-exclamation-circle fa-fw"></i>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label" for="sku">Empresa</label>
					{!! Form::text('company_name', old('company_name'), ['class' => 'form-control' . ($errors->has('company_name') ? ' border-danger' : '')]) !!}
					<div class="invalid-feedback active">
						<i class="fa fa-exclamation-circle fa-fw"></i>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label" for="sku">CUIT/CUIL</label>
					{!! Form::text('company_number', old('company_number'), ['class' => 'form-control' . ($errors->has('company_number') ? ' border-danger' : '')]) !!}
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
					<label class="control-label" for="status">Habilitado: </label>
					<div class="form-control">
						{!! Form::checkbox('status', 'status', old('status'), ['class' =>''])  !!}
					</div>
				</div>
			</div>
		</div>			
	</div>
</div>


{!! Form::close() !!}

@stop



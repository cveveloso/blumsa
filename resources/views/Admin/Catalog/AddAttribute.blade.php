@extends('Admin.Master')

@section('title', Lang::get('admin.newattribute'))
@section('headtitle', Lang::get('admin.newattribute'))

@section('toolbar')
{!! Form::open(['url' => '/admin/catalog/attribute/save']) !!}
{!! Form::button('<i class="far fa-save"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
{!! Form::button('<a href="' . url('/admin/catalog/attribute') . '"><i class="fa fa-undo"></i></a>', ['class' => 'btn btn-primary']) !!}
@stop


@section('content')

@php 
$firstTab = 'active';
$firstPanel = 'active show';
@endphp


<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			  <h5 class="card-title card-custom-title">Nombre y grupo</h5>
				<div class="form-group">	
					<div class="tab-content" id="adminTabContent">   		
						<div class="tab-pane fade show active" id="panel-data" role="tabpanel" aria-labelledby="tab-data">
							<ul class="nav nav-tabs" id="langTab" role="tablist">
								@foreach(array_keys(Config::get('languages')) as $key)
								<li class="nav-item">
								<a class="nav-link {{ $firstTab }}" id="tab-{{$key}}" data-toggle="tab" href="#panel-{{$key}}" role="tab" aria-controls="panel-{{$key}}" aria-selected="true">{{ Config::get('languages')[$key] }}</a>
								</li>
								@php 
								$firstTab = '';
								@endphp
								@endforeach
							</ul>
							<div class="tab-content" id="langTabContent">
								@foreach(array_keys(Config::get('languages')) as $key)
								<div class="tab-pane fade {{ $firstPanel }}" id="panel-{{$key}}" role="tabpanel" aria-labelledby="tab-{{$key}}">
									
								<label class="w-100 mt-2" for="name-{{$key}}">Nombre: </label>
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>
									</div>
									{!! Form::text('name-' . $key, old('name-' . $key, ''), ['class' =>'form-control' . ($errors->has('name-' . $key) ? ' border-danger' : '')]) !!}
								</div>
								@php 					
									if ($errors->has('name-' . $key)) { 
										echo '<span class="input-error text-danger w-100 mt-2">' . $errors->first('name-' . $key) . '</span>'; 
									}
									@endphp					
								</div>
								@php 
								$firstPanel = '';
								@endphp
								@endforeach
							</div>			
						</div>
					</div>
				</div>
				<div class="form-group">	
					<label class="w-100 mt-2" for="code">Grupo de atributo: </label>
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fa fa-users" aria-hidden="true"></i></div>			
						</div>
						{!! Form::select('group', $comboGroups, old('group', ''), ['class' =>'form-control' . ($errors->has('group') ? ' border-danger' : '')])  !!}
					</div>
					@php 					
						if ($errors->has('group')) { 
							echo '<span class="input-error text-danger w-100 mt-2">' . $errors->first('group') . '</span>'; 
						}
					@endphp					
				</div>									  
			</div>
		</div>			
	</div>
</div>
<div class="row mt-4">
	<div class="col-12">
		<div class="card">
			<div class="card-body">	
				<h5 class="card-title card-custom-title">Configuracion</h5>
				<div class="container-fluid pl-0 pr-0">										
					<div class="row">				
						<div class="col" style="max-width:250px;">
							<div class="form-group">
								<label class="mt-2" for="sort_order">Orden: </label>
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fa fa-bars" aria-hidden="true"></i></div>		
									</div>
									{!! Form::number('sort_order', old('sort_order', '0'), ['class' =>'form-control' . ($errors->has('sort_order') ? ' border-danger' : '')])  !!}
								</div>
								@php 					
								if ($errors->has('sort_order')) { 
									echo '<span class="input-error text-danger w-100 mt-2">' . $errors->first('sort_order') . '</span>'; 
								}
								@endphp						
							</div>
						</div>
						<div class="col" style="max-width:250px;">
							<div class="form-group">
								<label class="mt-2" for="sort_order">Tipo de dato: </label>	
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>			
									</div>
									{!! Form::select('data_type', array("number" => "Numerico","text" => "Texto libre"), old('data_type', ''), ['class' =>'form-control' . ($errors->has('data_type') ? ' border-danger' : '')])  !!}
								</div>
								@php 					
								if ($errors->has('data_type')) { 
									echo '<span class="input-error text-danger w-100 mt-2">' . $errors->first('data_type') . '</span>'; 
								}
								@endphp									
							</div>	
						</div>
						<div class="col" style="max-width:250px;">
							<div class="form-group">
								<label class="mt-2" for="sort_order">Unidad de medida: </label>	
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fa fa-plus" aria-hidden="true"></i></div>			
									</div>
									{!! Form::select('unit', array("kg" => "kilogramo","cm" => "Centimetros","vol" => "Centimetros cubicos"), old('unit', ''), ['class' =>'form-control' . ($errors->has('unit') ? ' border-danger' : '')])  !!}
								</div>
								@php 					
								if ($errors->has('unit')) { 
									echo '<span class="input-error text-danger w-100 mt-2">' . $errors->first('unit') . '</span>'; 
								}
								@endphp									
							</div>	
						</div>							
					</div>
				</div>							
			</div>			
		</div>
	</div>				
</div>
{!! Form::close() !!}

@stop
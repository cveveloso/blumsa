@extends('Admin.Master')

@section('title', Lang::get('admin.newproduct'))
@section('headtitle', Lang::get('admin.newproduct'))

@section('content')

@php 
$firstTab = 'active';
$firstPanel = 'active show';
@endphp

<div >
	{!! Form::open(['url' => '/admin/catalog/products/save']) !!}	
	<div class="row">
		<div class="col-12 text-right">
			{!! Form::submit('Guardar', ['class' => 'btn btn-primary mb-4 customBtnProductSave','style' => 'width:200px;']) !!}	
		</div>
	</div>	
	<div class="row">
		<div class="col-3">
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<a class="nav-link active customNav" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">General</a>
				<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Atributos</a>
			</div>
		</div>
		<div class="col-9 customMosaico">
			<div class="tab-content" id="v-pills-tabContent">
				<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
					<h3 class="tile-title">Generalidades</h3>
					<hr>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="control-label" for="sku">SKU</label>
							{!! Form::text('sku', null, ['class' => 'form-control' . ($errors->has('sku') ? ' border-danger' : '')]) !!}					
							<div class="invalid-feedback active">
								<i class="fa fa-exclamation-circle fa-fw"></i>
							</div>
						</div>	
						<div class="form-group col-md-6">
							<label class="control-label" for="category">Categoria</label>
							{!! Form::select('category', $comboCategories, null, ['class' =>'form-control'])  !!}
							<div class="invalid-feedback active">
								<i class="fa fa-exclamation-circle fa-fw"></i>
							</div>
						</div>							
					</div>	
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="control-label" for="modelo">Modelo</label>
							{!! Form::text('modelo', null, ['class' => 'form-control' . ($errors->has('modelo') ? ' border-danger' : '')]) !!}					
							<div class="invalid-feedback active">
								<i class="fa fa-exclamation-circle fa-fw"></i>
							</div>
						</div>							
					</div>										
				</div>
				<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
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
							  
						  <label class="w-100 mt-2" for="superficie-{{$key}}">Superficie: </label>
						  <div class="input-group mb-2">
							  <div class="input-group-prepend">
								  <div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>
							  </div>
							  {!! Form::number('superficie-' . $key, null, ['class' =>'form-control' . ($errors->has('superficie-' . $key) ? ' border-danger' : '')]) !!}
						  </div>
						  @php 					
							if ($errors->has('superficie-' . $key)) { 
								echo '<span class="input-error text-danger w-100 mt-2">' . $errors->first('superficie-' . $key) . '</span>'; 
							}
							@endphp
						<label class="w-100 mt-2" for="base-{{$key}}">Base: </label>
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>
							</div>
							{!! Form::number('base-' . $key, null, ['class' =>'form-control' . ($errors->has('base-' . $key) ? ' border-danger' : '')]) !!}
						</div>
						@php 					
							if ($errors->has('base-' . $key)) { 
								echo '<span class="input-error text-danger w-100 mt-2">' . $errors->first('base-' . $key) . '</span>'; 
							}
							@endphp
						<label class="w-100 mt-2" for="longitud-{{$key}}">Longitud: </label>
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>
							</div>
							{!! Form::number('longitud-' . $key, null, ['class' =>'form-control' . ($errors->has('longitud-' . $key) ? ' border-danger' : '')]) !!}
						</div>
						@php 					
							if ($errors->has('longitud-' . $key)) { 
								echo '<span class="input-error text-danger w-100 mt-2">' . $errors->first('longitud-' . $key) . '</span>'; 
							}
							@endphp							
						</div>
						<label class="w-100 mt-2" for="ancho-{{$key}}">Ancho: </label>
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>
							</div>
							{!! Form::number('ancho-' . $key, null, ['class' =>'form-control' . ($errors->has('ancho-' . $key) ? ' border-danger' : '')]) !!}
						</div>
						@php 					
							if ($errors->has('ancho-' . $key)) { 
								echo '<span class="input-error text-danger w-100 mt-2">' . $errors->first('ancho-' . $key) . '</span>'; 
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
	</div>
	{!! Form::close() !!}		
</div>
@stop



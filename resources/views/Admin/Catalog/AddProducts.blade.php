@extends('Admin.Master')

@section('title', Lang::get('admin.newproduct'))
@section('headtitle', Lang::get('admin.newproduct'))

@push('styles')
	<link rel="stylesheet" href="{{ url('public/static/vendors/summernote/summernote.min.css') }}" />  
	<link rel="stylesheet" href="{{ url('public/static/vendors/dropzone/dist/dropzone.css') }}" />  	
@endpush

@push('scripts')
	<script type="text/javascript" src="{{ url('public/static/vendors/summernote/summernote.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('public/static/vendors/dropzone/dist/dropzone.js') }}"></script>	    
@endpush

@section('toolbar')
{!! Form::open(['url' => '/admin/catalog/products/save']) !!}	
{!! Form::button('<i class="far fa-save"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
@stop

@section('content')
@php 
$firstTab = 'active';
$firstPanel = 'active show';
@endphp

<div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
				  <h5 class="card-title card-custom-title">Codigo del producto y categoria</h5>
					<div class="form-group">
						<label class="control-label" for="sku">Codigo</label>
						{!! Form::text('sku', null, ['class' => 'form-control' . ($errors->has('sku') ? ' border-danger' : '')]) !!}					
						<div class="invalid-feedback active">
							<i class="fa fa-exclamation-circle fa-fw"></i>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label" for="category">Categoria</label>
						{!! Form::select('category', $comboCategories, null, ['class' =>'form-control'])  !!}
						<div class="invalid-feedback active">
							<i class="fa fa-exclamation-circle fa-fw"></i>
						</div>
					</div>											  
				</div>
			</div>			
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
				  <h5 class="card-title card-custom-title">Nombre y descripción</h5>						  
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
							<div class="form-group">
								<label class="control-label" for="modelo">Nombre</label>
								{!! Form::text('name-' . $key, null, ['class' => 'form-control' . ($errors->has('name' . $key) ? ' border-danger' : '')]) !!}					
								<div class="invalid-feedback active">
									<i class="fa fa-exclamation-circle fa-fw"></i>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label" for="modelo">Descripcion</label>
								{!! Form::textarea('description-' . $key, null, ['class' =>'form-control w-100 summernote' . ($errors->has('description-' . $key) ? ' border-danger' : ''), 'rows' => 4]) !!}
								<div class="invalid-feedback active">
									<i class="fa fa-exclamation-circle fa-fw"></i>
								</div>
							</div>
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
	<div class="row mt-4">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
				  <h5 class="card-title card-custom-title">Precios</h5>
				  <div class="row">
						<div class="col-md-6">
							<label class="control-label" for="sku">Precio de venta</label>
							<div class="input-group mb-2">
								<div class="input-group-prepend">
								  <div class="input-group-text">$</div>
								</div>
								{!! Form::number('price', null, ['class' => 'form-control' . ($errors->has('price' . $key) ? ' border-danger' : ''),'placeholder' => 'Precio de venta','step'=> '0.01']) !!}									
								<div class="invalid-feedback active">
									<i class="fa fa-exclamation-circle fa-fw"></i>
								</div>								
							</div>
						</div>
						<div class="col-md-6">
							<label class="control-label" for="sku">% de descuento por pallet completo</label>							
							<div class="input-group mb-2">
								<div class="input-group-prepend">
								  <div class="input-group-text">%</div>
								</div>
								{!! Form::number('discount', 0, ['class' => 'form-control' . ($errors->has('discount' . $key) ? ' border-danger' : ''),'placeholder' => '% de descuento']) !!}																
								<div class="invalid-feedback active">
									<i class="fa fa-exclamation-circle fa-fw"></i>
								</div>									
							</div>
						</div>								
					</div>										  
				</div>
			</div>			
		</div>
	</div>	
	<div class="row mt-4">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
				  <h5 class="card-title card-custom-title">Atributos</h5>
				  <ul class="nav nav-tabs" id="langTabAttributeGroup" role="tablist">
					@php 
					$firstTab = 'active';
					$firstPanel = 'active show';
					@endphp					
					@foreach(array_keys(Config::get('languages')) as $key)
					<li class="nav-item">
					  <a class="nav-link {{ $firstTab }}" id="tabAttributeGroup-{{$key}}" data-toggle="tab" href="#panelGroupAttribute-{{$key}}" role="tab" aria-controls="panel-{{$key}}" aria-selected="true">{{ Config::get('languages')[$key] }}</a>
					</li>
					@php 
					$firstTab = '';
					@endphp
					@endforeach
				  </ul>		
				  <div class="tab-content" id="langTabAttributeGroupContent">				  	
					@foreach(array_keys(Config::get('languages')) as $key)
					<div class="tab-pane fade {{ $firstPanel }}" id="panelGroupAttribute-{{$key}}" role="tabpanel" aria-labelledby="tab-{{$key}}"> 

						@foreach($listGroupAttribute as $groupAttribute)
							@if($groupAttribute->language == $key)
								<div class="card mt-4">
									<div class="card-header">
									{{ $groupAttribute->name}}
									</div>
									<div class="card-body">
										<div class="container-fluid">										
											<div class="row">
												@foreach($listAttribute as $attribute)	
													@php 								
														if($groupAttribute->id_attribute_group == $attribute->id_attribute_group && $attribute->language == $groupAttribute->language)
														{
															echo "<div class='col' style='max-width:250px;'>";
															echo "<div class='form-group'>";
															echo "<label class='control-label' for='modelo'>". $attribute->name . " (". $attribute->unit .")</label>";
															echo "<input class='form-control' name_attribute='". $attribute->name ."' name='attr-" . $attribute->id_attribute . "-" . $key . "'  type='". $attribute->data_type ."' ". $attribute->step .">";
															echo "</div>";
															echo "</div>";													
														}
													@endphp		
												@endforeach	
											</div>
										</div>
									</div>
								</div>
							@endif
						@endforeach	

						@php 
						$firstPanel = '';
						@endphp	

					</div>						
					@endforeach	
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
				  <div class="row">
						<div class="col-md-6">
							<label class="control-label" for="sku">¿Visible en tienda?</label>
							<div class="input-group mb-2">
								<div class="form-check">
									{!! Form::checkbox('enabled', 'enabled', old('enabled', true), ['class' =>''])  !!}
									<label class="form-check-label" for="autoSizingCheck2">
									  Visible
									</label>
								  </div>								
							</div>
						</div>								
					</div>										  
				</div>
			</div>			
		</div>
	</div>		

	{!! Form::close() !!}	
</div>
@stop



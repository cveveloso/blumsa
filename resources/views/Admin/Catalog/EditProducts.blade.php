@extends('Admin.Master')

@section('title', Lang::get('admin.editproduct'))
@section('headtitle', Lang::get('admin.editproduct'))

@push('styles')
	<link rel="stylesheet" href="{{ url('public/static/vendors/summernote/summernote.min.css') }}" />  
	<link rel="stylesheet" href="{{ url('public/static/vendors/dropzone/dist/dropzone.css') }}" />  	
@endpush

@push('scripts')
	<script type="text/javascript" src="{{ url('public/static/vendors/summernote/summernote.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('public/static/vendors/dropzone/dist/dropzone.js') }}"></script>	    
@endpush

@section('toolbar')
{!! Form::open(['url' => '/admin/catalog/products/update/'. $product->id_product]) !!}	
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit"><i class="far fa-save"></i></button>

<div class="modal" id="modalEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmacion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Seguro desea actualizar el producto?</p>
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
						{!! Form::text('sku', old('code', $product->sku), ['class' => 'form-control' . ($errors->has('sku') ? ' border-danger' : '')]) !!}					
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
					@for($i = 0; $i < $productDescription->count(); $i++)		
                        <?php $lang = $productDescription[$i]->language; ?>
						<div class="tab-pane fade {{ $firstPanel }}" id="panel-{{$lang}}" role="tabpanel" aria-labelledby="tab-{{$lang}}">  
							<div class="form-group">
								<label class="control-label" for="modelo">Nombre</label>
								{!! Form::text('name-' . $lang, old('code', $productDescription[$i]->name), ['class' => 'form-control' . ($errors->has('name' . $lang) ? ' border-danger' : '')]) !!}					
								<div class="invalid-feedback active">
									<i class="fa fa-exclamation-circle fa-fw"></i>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label" for="modelo">Descripcion</label>
								{!! Form::textarea('description-' . $lang, old('code', $productDescription[$i]->description), ['class' =>'form-control w-100 summernote' . ($errors->has('description-' . $lang) ? ' border-danger' : ''), 'rows' => 4]) !!}
								<div class="invalid-feedback active">
									<i class="fa fa-exclamation-circle fa-fw"></i>
								</div>
							</div>
                        </div>                                                
						@php 
						$firstPanel = '';
						@endphp						
					@endfor
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
								{!! Form::number('price', old('price', $product->price), ['class' => 'form-control' . ($errors->has('price' . $key) ? ' border-danger' : ''),'placeholder' => 'Precio de venta','step'=> '0.01']) !!}									
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
								{!! Form::number('discount', old('discount', $product->discount), ['class' => 'form-control' . ($errors->has('discount' . $key) ? ' border-danger' : ''),'placeholder' => '% de descuento']) !!}																
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
													@foreach($attributeByProduct as $proAttr)
														@php 
															if($proAttr->id_product == $product->id_product && $proAttr->name_attribute == $attribute->name && $proAttr->lang == $attribute->language)
															{
																$valorAttr = $proAttr->value_attribute;
															}
														@endphp	
													@endforeach		
													@php 								
														if($groupAttribute->id_attribute_group == $attribute->id_attribute_group && $attribute->language == $groupAttribute->language)
														{
															echo "<div class='col' style='max-width:250px;'>";
															echo "<div class='form-group'>";
															echo "<label class='control-label' for='modelo'>". $attribute->name . " (". $attribute->unit .")</label>";
															echo "<input class='form-control' name_attribute='". $attribute->name ."' name='attr-" . $attribute->id_attribute . "-" . $key . "' value='" . $valorAttr  .  "' type='". $attribute->data_type ."' ". $attribute->step .">";
															echo "</div>";
															echo "</div>";													
														}
														$valorAttr = null;
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

	{!! Form::close() !!}		

	<div class="row mt-4">
		<div class="col-12">	
			<div class="card">
				<div class="card-body">
					<div class="tab-pane fade" id="panel-images" role="tabpanel" aria-labelledby="tab-images" style="opacity:1">
							<h5 class="card-title card-custom-title">Imagenes</h5>		
							<div class="form-group">
								<label class="control-label" for="modelo">Adjuntar o arrastrar y soltar</label>
									{!! Form::open(['url' => '/admin/catalog/products/images/upload', 'class' => 'dropzone', 'id' => 'dropzone']) !!}
										{{ Form::hidden('product', $product->id_product) }}
									{!! Form::close() !!}
							</div>
							<div class="form-group mt-2">
								<div class="col-12 text-right">
									<button class="btn btn-success" type="button" id="btn-upload">
										<i class="fa fa-fw fa-lg fa-upload"></i>Subir
									</button>
								</div>
							</div>
							@if ($product->Images)							
							<hr>
							<div class="form-group">
								@foreach($product->Images as $image)
								<div class="card" style="max-width: 250px;">
									<div class="card-body">
										<img src="{{ url('/storage/app/public') . "/". $image->path }}" class="img-fluid" alt="img">
										<a class="card-link float-right text-danger" href="{{ url('/admin/catalog/category/images/delete/') }}">
											<i class="fa fa-fw fa-lg fa-trash"></i>
										</a>
									</div>
								</div>
								@endforeach															
							</div>	
							@endif					
					</div>	
				</div>
			</div>
		</div>	
	</div>		
</div>
@stop



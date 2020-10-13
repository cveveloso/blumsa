@extends('Admin.Master')

@section('title', Lang::get('admin.editproduct'))
@section('headtitle', Lang::get('admin.editproduct'))

@push('styles')
    <link rel="stylesheet" href="{{ url('public/static/vendors/summernote/summernote.min.css') }}" />  
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ url('public/static/vendors/summernote/summernote.min.js') }}"></script>    
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
				  <h5 class="card-title card-custom-title">Sku y categoria</h5>
					<div class="form-group">
						<label class="control-label" for="sku">SKU</label>
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
				  <h5 class="card-title card-custom-title">Modelo, nombre y descripción</h5>	
				  <div class="form-group">
					<label class="control-label" for="modelo">Modelo</label>
					{!! Form::text('modelo', old('code', $product->model), ['class' => 'form-control' . ($errors->has('modelo') ? ' border-danger' : '')]) !!}					
					<div class="invalid-feedback active">
						<i class="fa fa-exclamation-circle fa-fw"></i>
					</div>
				  </div>					  
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
				  <h5 class="card-title card-custom-title">Atributos</h5>			  				  
				</div>
			</div>				
		</div>
	</div>		
	{!! Form::close() !!}		
</div>
@stop



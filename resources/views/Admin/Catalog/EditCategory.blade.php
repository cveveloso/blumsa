@extends('Admin.Master')

@section('title', Lang::get('admin.editcategory'))
@section('headtitle', Lang::get('admin.editcategory'))

@push('styles')
    <link rel="stylesheet" href="{{ url('public/static/vendors/summernote/summernote.min.css') }}" />  
    <link rel="stylesheet" href="{{ url('public/static/vendors/dropzone/dist/dropzone.css') }}" />  
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ url('public/static/vendors/summernote/summernote.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('public/static/vendors/dropzone/dist/dropzone.js') }}"></script>
@endpush

@section('toolbar')
{!! Form::open(['url' => '/admin/catalog/category/update/' . $category->id_category]) !!}
{!! Form::button('<i class="far fa-save"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
{!! Form::button('<a href="' . url('/admin/catalog/category') . '"><i class="fa fa-undo"></i></a>', ['class' => 'btn btn-primary']) !!}
@stop

@section('content')

@php 
$firstTab = 'active';
$firstPanel = 'active show';
@endphp

<div class="row">
	<div class="col-md-3 col-xs-12">
	    <div class="nav flex-column nav-pills" id="adminTab" role="tablist" aria-orientation="vertical">
	      <a class="nav-link active" id="tab-general" data-toggle="pill" href="#panel-general" role="tab" aria-controls="panel-general" aria-selected="true">General</a>
	      <a class="nav-link" id="tab-data" data-toggle="pill" href="#panel-data" role="tab" aria-controls="panel-data" aria-selected="false">Datos</a>
	      <a class="nav-link" id="tab-images" data-toggle="pill" href="#panel-images" role="tab" aria-controls="panel-images" aria-selected="false">Imagenes</a>
	    </div>
  	</div>
	<div class="col-md-9 col-xs-12">		
		<div class="tab-content" id="adminTabContent">
      		<div class="tab-pane fade show active" id="panel-general" role="tabpanel" aria-labelledby="tab-general">
      			<label class="w-100 mt-2" for="code">Código: </label>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>			
					</div>
					{!! Form::text('code', old('code', $category->code), ['class' => 'form-control' . ($errors->has('code') ? ' border-danger' : '')]) !!}					
				</div>
				@php 					
			  	if ($errors->has('code')) { 
			  		echo '<span class="input-error text-danger w-100 mt-2">' . $errors->first('code') . '</span>'; 
			  	}
			  	@endphp

				<label class="w-100 mt-2" for="code">Padre: </label>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>			
					</div>
					{!! Form::select('parent', $comboCategories, old('parent', $category->id_parent), ['class' =>'form-control'])  !!}
				</div>

				<label class="w-100 mt-2" for="sort_order">Orden: </label>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>		
					</div>
					{!! Form::number('sort_order', old('sort_order', $category->sort_order), ['class' =>'form-control' . ($errors->has('sort_order') ? ' border-danger' : '')])  !!}
				</div>
				@php 					
			  	if ($errors->has('sort_order')) { 
			  		echo '<span class="input-error text-danger w-100 mt-2">' . $errors->first('sort_order') . '</span>'; 
			  	}
			  	@endphp
				
				<label class="mt-2 float-left" for="status">Habilitado: </label>
				<div class="input-group w-50 float-left ml-2 pt-2 mt-1">
					{!! Form::checkbox('status', 'status', old('status', ($category->status == 1 ? true : false)), ['class' =>''])  !!}
				</div>   			
      		</div>
      		<div class="tab-pane fade" id="panel-data" role="tabpanel" aria-labelledby="tab-data">
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
				  @php 
				  $categoryDescription = $category->Descriptions($key);
				  @endphp
				  <div class="tab-pane fade {{ $firstPanel }}" id="panel-{{$key}}" role="tabpanel" aria-labelledby="tab-{{$key}}">
						
					<label class="w-100 mt-2" for="name-{{$key}}">Nombre: </label>
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>
						</div>
						{!! Form::text('name-' . $key, old('name-' . $key ,$categoryDescription->name), ['class' =>'form-control' . ($errors->has('name-' . $key) ? ' border-danger' : '')]) !!}
					</div>
					@php 					
				  	if ($errors->has('name-' . $key)) { 
				  		echo '<span class="input-error text-danger w-100 mt-2">' . $errors->first('name-' . $key) . '</span>'; 
				  	}
				  	@endphp

					<label class="w-100" for="description-{{$key}}">Descripción: </label>
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>			
						</div>
						{!! Form::textarea('description-' . $key, old('description-' . $key ,$categoryDescription->description), ['class' =>'form-control w-100 summernote' . ($errors->has('description-' . $key) ? ' border-danger' : ''), 'rows' => 4]) !!}
					</div>
					@php 					
				  	if ($errors->has('description-' . $key)) { 
				  		echo '<span class="input-error text-danger w-100 mt-2">' . $errors->first('description-' . $key) . '</span>'; 
				  	}
				  	@endphp
				  </div>
				  @php 
				  $firstPanel = '';
				  @endphp
				  @endforeach
				</div>
      		</div>

      		{!! Form::close() !!}

      		<div class="tab-pane fade" id="panel-images" role="tabpanel" aria-labelledby="tab-images">
      			<div class="tile">
                    <h3 class="tile-title">Subir imagenes</h3>
                    <hr>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-12">
                            	{!! Form::open(['url' => '/admin/catalog/category/images/upload', 'class' => 'dropzone', 'id' => 'dropzone']) !!}
                                	{{ Form::hidden('category', $category->id_category) }}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right">
                                <button class="btn btn-success" type="button" id="btn-upload">
                                    <i class="fa fa-fw fa-lg fa-upload"></i>Subir
                                </button>
                            </div>
                        </div>
                        @if ($category->Images)
                            <hr>
                            <div class="row">
                                @foreach($category->Images as $image)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="{{ public_path() . $image->path }}" class="img-fluid" alt="img">
                                                <a class="card-link float-right text-danger" href="{{ url('/admin/catalog/category/images/delete/' . $image->id) }}">
                                                    <i class="fa fa-fw fa-lg fa-trash"></i>
                                                </a>
                                            </div>
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



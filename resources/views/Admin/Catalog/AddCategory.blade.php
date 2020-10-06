@extends('Admin.Master')

@section('title', Lang::get('admin.newcategory'))
@section('headtitle', Lang::get('admin.newcategory'))

@push('styles')
    <link rel="stylesheet" href="{{ url('public/static/vendors/summernote/summernote.min.css') }}" />  
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ url('public/static/vendors/summernote/summernote.min.js') }}"></script>    
@endpush

@section('toolbar')
{!! Form::open(['url' => '/admin/catalog/category/save']) !!}
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
					{!! Form::text('code', null, ['class' => 'form-control' . ($errors->has('code') ? ' border-danger' : '')]) !!}					
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
					{!! Form::select('parent', $comboCategories, null, ['class' =>'form-control'])  !!}
				</div>

				<label class="w-100 mt-2" for="sortorder">Orden: </label>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>		
					</div>
					{!! Form::number('sortorder', '0', ['class' =>'form-control'])  !!}
				</div>
				
				<label class="float-left mt-2" for="status">Habilitado: </label>
				<div class="input-group float-left w-50 mb-2">					
					{!! Form::checkbox('status', false, ['class' =>'custom-control-input'])  !!}
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
				  <div class="tab-pane fade {{ $firstPanel }}" id="panel-{{$key}}" role="tabpanel" aria-labelledby="tab-{{$key}}">
						
					<label class="w-100 mt-2" for="name-{{$key}}">Nombre: </label>
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>
						</div>
						{!! Form::text('name-' . $key, null, ['class' =>'form-control' . ($errors->has('name-' . $key) ? ' border-danger' : '')]) !!}
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
						{!! Form::textarea('description-' . $key, null, ['class' =>'form-control w-100 summernote' . ($errors->has('description-' . $key) ? ' border-danger' : ''), 'rows' => 4]) !!}
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
      	</div>		
	</div>
</div>

{!! Form::close() !!}

@stop
@extends('Admin.Master')

@section('title', Lang::get('admin.newattributegroup'))
@section('headtitle', Lang::get('admin.newattributegroup'))

@section('toolbar')
{!! Form::open(['url' => '/admin/catalog/attributegroup/save']) !!}
{!! Form::button('<i class="far fa-save"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
{!! Form::button('<a href="' . url('/admin/catalog/attributegroup') . '"><i class="fa fa-undo"></i></a>', ['class' => 'btn btn-primary']) !!}
@stop


@section('content')

@php 
$firstTab = 'active';
$firstPanel = 'active show';
@endphp

<div class="row">
	<div class="col-md-3 col-xs-12">
	    <div class="nav flex-column nav-pills" id="adminTab" role="tablist" aria-orientation="vertical">
	      <a class="nav-link active" id="tab-data" data-toggle="pill" href="#panel-data" role="tab" aria-controls="panel-data" aria-selected="false">Datos</a>	      
	    </div>
  	</div>
	<div class="col-md-9 col-xs-12">		
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

      	<label class="w-100 mt-2" for="sort_order">Orden: </label>
		<div class="input-group mb-2">
			<div class="input-group-prepend">
				<div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>		
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

{!! Form::close() !!}

@stop
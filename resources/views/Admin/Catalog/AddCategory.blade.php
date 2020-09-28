@extends('Admin.Master')

@section('title', Lang::get('admin.newcategory'))
@section('headtitle', Lang::get('admin.newcategory'))

@section('content')

@php 
$firstTab = 'active';
$firstPanel = 'active show';
@endphp

<div class="row">
	<div class="col-xs-12">

		{!! Form::open(['url' => '/admin/catalog/category/add']) !!}

		<label class="mt-2" for="code">Código: </label>
		<div class="input-group mb-2">
			<div class="input-group-prepend">
				<div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>			
			</div>
			{!! Form::text('code', null, ['class' =>'form-control']) !!}
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
		  @foreach(array_keys(Config::get('languages')) as $key)
		  <div class="tab-pane fade {{ $firstPanel }}" id="panel-{{$key}}" role="tabpanel" aria-labelledby="tab-{{$key}}">
				
			<label class="mt-2" for="name-{{$key}}">Nombre: </label>
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>			
				</div>
				{!! Form::text('name-' . $key, null, ['class' =>'form-control']) !!}
			</div>

			<label for="description-{{$key}}">Descripción: </label>
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fa fa-pencil-alt" aria-hidden="true"></i></div>			
				</div>
				{!! Form::textarea('description-' . $key, null, ['class' =>'form-control', 'rows' => 4]) !!}
			</div>
		  </div>
		  @php 
		  $firstPanel = '';
		  @endphp
		  @endforeach
		</div>

		{!! Form::submit('Guardar', ['class' => 'btn btn-primary w-100 mt-4']) !!}
		{!! Form::close() !!}
	</div>
</div>

@stop



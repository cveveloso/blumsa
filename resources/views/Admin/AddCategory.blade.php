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
		<ul class="nav nav-tabs" id="langTab" role="tablist">
		  @foreach(array_keys(Config::get('languages')) as $key)
		  <li class="nav-item">
		    <a class="nav-link {{ $firstTab }}" id="tab{{$key}}" data-toggle="tab" href="#panel{{$key}}" role="tab" aria-controls="panel{{$key}}" aria-selected="true">{{ Config::get('languages')[$key] }}</a>
		  </li>
		  @php 
		  $firstTab = '';
		  @endphp
		  @endforeach
		</ul>
		<div class="tab-content" id="langTabContent">
		  @foreach(array_keys(Config::get('languages')) as $key)
		  <div class="tab-pane fade {{ $firstPanel }}" id="panel{{$key}}" role="tabpanel" aria-labelledby="tab{{$key}}">
		  	TEST {{ $firstPanel }}
		  </div>
		  @php 
		  $firstPanel = '';
		  @endphp
		  @endforeach
		</div>
	</div>
</div>

@stop



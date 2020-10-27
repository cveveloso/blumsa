@extends('Admin.Master')

@section('title', Lang::get('admin.attributes'))
@section('headtitle', Lang::get('admin.attributes'))

@push('scripts')
    <link rel="stylesheet" href="{{ url('public/static/vendors/datatables/dataTables.min.css') }}" />  
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ url('public/static/vendors/datatables/dataTables.min.js') }}"></script>    
@endpush

@section('toolbar')
{!! Form::button('<a href="' . url('/admin/catalog/attribute/add') . '"><i class="fa fa-plus"></i></a>', ['class' => 'btn btn-primary']) !!}
@stop

@section('content')

@php 
$firstTab = 'active';
$firstPanel = 'active show';
@endphp

<div class="row">
	<div class="col-12">

		<table id="grid-data" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed">
			<thead>
				<tr>					
					<th scope="col">Código</th>					
					<th scope="col">Nombre</th>
					<th scope="col">Orden</th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($attributes as $attribute)
				<tr>
			      <th scope="row">{{ $attribute->id_attribute }}</th>
			      <td>{{ $attribute->name }}</td>
			      <td>{{ $attribute->sort_order }}</td>
			      <td>
                    <a href="{{ url('/admin/catalog/attribute/edit/' . $attribute->id_attribute) }}" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                    <a href="{{ url('/admin/catalog/attribute/delete/' . $attribute->id_attribute) }}" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
			      </td>
			    </tr>
			  	@endforeach
		  	</tbody>
		</table>

	</div>
</div>

@stop



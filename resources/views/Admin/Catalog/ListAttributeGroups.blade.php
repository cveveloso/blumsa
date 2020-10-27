@extends('Admin.Master')

@section('title', Lang::get('admin.attributegroups'))
@section('headtitle', Lang::get('admin.attributegroups'))

@push('scripts')
    <link rel="stylesheet" href="{{ url('public/static/vendors/datatables/dataTables.min.css') }}" />  
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ url('public/static/vendors/datatables/dataTables.min.js') }}"></script>    
@endpush

@section('toolbar')
{!! Form::button('<a href="' . url('/admin/catalog/attributegroup/add') . '"><i class="fa fa-plus"></i></a>', ['class' => 'btn btn-primary']) !!}
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
					<th scope="col">Atributos</th>
					<th scope="col">Orden</th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($groups as $group)
				<tr>
			      <th scope="row">{{ $group->id_attribute_group }}</th>			      
			      <td>{{ $group->name }}</td>
			      <td>{{ $group->Attributes()->count() }}</td>
			      <td>{{ $group->sort_order }}</td>
			      <td>
                    <a href="{{ url('/admin/catalog/attributegroup/edit/' . $group->id_attribute_group) }}" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                    <a href="{{ url('/admin/catalog/attributegroup/delete/' . $group->id_attribute_group) }}" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
			      </td>
			    </tr>
			  	@endforeach
		  	</tbody>
		</table>

	</div>
</div>

@stop



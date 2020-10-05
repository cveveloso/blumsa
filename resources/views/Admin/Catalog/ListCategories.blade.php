@extends('Admin.Master')

@section('title', Lang::get('admin.categories'))
@section('headtitle', Lang::get('admin.categories'))

@push('scripts')
    <link rel="stylesheet" href="{{ url('public/static/vendors/datatables/dataTables.min.css') }}" />  
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ url('public/static/vendors/datatables/dataTables.min.js') }}"></script>    
@endpush

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
					<th scope="col">Slug</th>
					<th scope="col">Nombre</th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($categories as $category)
				<tr>
			      <th scope="row">{{ $category->id_category }}</th>
			      <td>{{ $category->slug }}</td>
			      <td>{{ $category->name }}</td>
			      <td>
                    <a href="{{ url('/admin/catalog/category/edit/' . $category->id_category) }}" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                    <a href="{{ url('/admin/catalog/category/delete/' . $category->id_category) }}" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
			      </td>
			    </tr>
			  	@endforeach
		  	</tbody>
		</table>

	</div>
</div>

@stop



@extends('Admin.Master')

@section('title', Lang::get('admin.users'))
@section('headtitle', Lang::get('admin.users'))

@push('scripts')
    <link rel="stylesheet" href="{{ url('public/static/vendors/datatables/dataTables.min.css') }}" />  
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ url('public/static/vendors/datatables/dataTables.min.js') }}"></script>    
@endpush

@section('toolbar')

@stop

@section('content')

<div class="row">
	<div class="col-12">

		<table id="grid-data" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed">
			<thead>
				<tr>					
					<th scope="col">Código</th>
					<th scope="col">Email</th>
					<th scope="col">Descripción</th>
					<th scope="col">Tipo</th>
					<th scope="col">Estado</th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
			      <th scope="row">{{ $user->id }}</th>
			      <td>{{ $user->email }}</td>
			      <td>{{ $user->firstname . ' ' . $user->lastname }}</td>
			      <td>{{ ($user->role) ? 'Admin' : 'Cliente' }}</td>
			      <td>{{ ($user->status) ? 'Habilitado' : 'Deshabilitado' }}</td>
			      <td>
                    <a href="{{ url('/admin/user/edit/' . $user->id) }}" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                    <a href="{{ url('/admin/user/delete/' . $user->id) }}" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
			      </td>
			    </tr>
			  	@endforeach
		  	</tbody>
		</table>

	</div>
</div>

@stop



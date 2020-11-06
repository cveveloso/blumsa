@extends('Admin.Master')

@section('title', Lang::get('admin.customers'))
@section('headtitle', Lang::get('admin.customers'))

@push('scripts')
    <link rel="stylesheet" href="{{ url('public/static/vendors/datatables/dataTables.min.css') }}" />  
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ url('public/static/vendors/datatables/dataTables.min.js') }}"></script>    
@endpush

@section('toolbar')
{!! Form::button('<a href="' . url('/admin/customer/add') . '"><i class="fa fa-plus"></i></a>', ['class' => 'btn btn-primary']) !!}
@stop

@section('content')

<div class="row">
	<div class="col-12">

		<table id="grid-data" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed">
			<thead>
				<tr>					
					<th scope="col">Código</th>
					<th scope="col">Nro Cliente</th>
					<th scope="col">Empresa</th>
					<th scope="col">CUIT/CUIL</th>
					<th scope="col">Estado</th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($customers as $customer)
				<tr>
			      <th scope="row">{{ $customer->id_customer }}</th>
			      <td>{{ $customer->company_code }}</td>
			      <td>{{ $customer->company_name }}</td>
			      <td>{{ $customer->company_number }}</td>
			      <td>{{ ($customer->status) ? 'Habilitado' : 'Deshabilitado' }}</td>
			      <td>
                    <a href="{{ url('/admin/customer/edit/' . $customer->id_customer) }}" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                    <a href="{{ url('/admin/customer/delete/' . $customer->id_customer) }}" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
			      </td>
			    </tr>
			  	@endforeach
		  	</tbody>
		</table>

	</div>
</div>

@stop



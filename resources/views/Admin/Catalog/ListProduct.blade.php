@extends('Admin.Master')

@section('title', Lang::get('admin.products'))
@section('headtitle', Lang::get('admin.products'))

@push('scripts')
    <script type="text/javascript" src="{{ url('public/static/vendors/datatables/dataTables.min.js') }}"></script>    
@endpush

@section('toolbar')
{!! Form::button('<a href="' . url('/admin/catalog/products/add') . '"><i class="fa fa-plus"></i></a>', ['class' => 'btn btn-primary']) !!}
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <table id="grid-data" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed">
            <thead>
            <tr>
                <th>#</th>
                <th>Sku</th>
                <th>Modelo</th>                    
                <th>Acciones</th>  
            </tr>
            </thead>
            <body>
                @foreach($products as $product)
                    <tr>
                        <td></td>   
                        <td>{{ $product->sku }}</td>  
                        <td>{{ $product->model }}</td>  
                        <td>
                            <a href="{{ url('/admin/catalog/products/edit/' . $product->id_product) }}" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                            <a href="{{ url('/admin/catalog/products/delete/' . $product->id_product) }}" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>                        
                        </td>  
                    </tr>
                @endforeach                    
            </body>
        </table>     
    </div>
</div>


@stop
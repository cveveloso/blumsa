@extends('Admin.Master')

@section('title', Lang::get('admin.products'))
@section('headtitle', Lang::get('admin.products'))

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-outline-success">Nuevo Producto</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-4">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Sku</th>
                    <th>Modelo</th>                    
                    <th>Editar</th>  
                    <th>Eliminar</th>  
                </tr>
                </thead>
                <body>
                    @foreach($products as $product)
                        <tr>
                          <td></td>   
                          <td>{{ $product->sku }}</td>  
                          <td>{{ $product->model }}</td>  
                          <td><i class="fa fa-pencil-alt" aria-hidden="true"></i></td>  
                          <td><i class="fa fa-trash" aria-hidden="true"></i></td>  
                        </tr>
                    @endforeach                    
                </body>
            </table>     
        </div>
    </div>
</div>


@stop
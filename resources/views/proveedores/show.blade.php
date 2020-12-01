@extends('admin-lte.index')

@section('content')

<div class="card-body">
    <table class="table table-borderless table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>

            <th scope="col">Cuit</th>
            <th scope="col">Telefono</th>
            <th scope="col">Email</th>
        </tr>
        </thead>
        <tbody>

            <tr>
                <td>{{$proveedor->id}}</td>
                <td>{{$proveedor->nombre}}</td>

                <td>{{$proveedor->cuit}}</td>
                <td>{{$proveedor->telefono}}</td>
                <td>{{$proveedor->email}}</td>

            </tr>

        </tbody>
    </table>
</div

@endsection

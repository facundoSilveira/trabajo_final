@extends('admin-lte.index')

@section('content')

<div class="card-body">
    <table class="table table-borderless table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">DNI</th>
            <th scope="col">Telefono</th>
            <th scope="col">Email</th>
        </tr>
        </thead>
        <tbody>
            
            <tr>
                <td>{{$cliente->id}}</td>
                <td>{{$cliente->nombre}}</td>
                <td>{{$cliente->apellido}}</td>
                <td>{{$cliente->dni}}</td>
                <td>{{$cliente->telefono}}</td>
                <td>{{$cliente->email}}</td>

            </tr>

        </tbody>
    </table>
</div

@endsection

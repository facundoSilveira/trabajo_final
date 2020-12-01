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
                <td>{{$tecnico->id}}</td>
                <td>{{$tecnico->nombre}}</td>
                <td>{{$tecnico->apellido}}</td>
                <td>{{$tecnico->dni}}</td>
                <td>{{$tecnico->telefono}}</td>
                <td>{{$tecnico->email}}</td>

            </tr>

        </tbody>
    </table>
</div

@endsection

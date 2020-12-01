@extends('admin-lte.index')

@section('content')

<form class="form-group" method="POST" action="/clientes/{{$cliente->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5>
                    Editar Cliente
                </h5>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
               </ul>
            </div>
            @endif
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="nombre" value="{{$cliente->nombre}}"class="form-control">
        </div>
        <div class="form-group">
            <label for="">Apellido</label>
            <input type="text" name="apellido" value="{{$cliente->apellido}}"class="form-control">
        </div>
        <div class="form-group">
            <label for="">DNI</label>
            <input type="text" name="dni" value="{{$cliente->dni}}"class="form-control" >
        </div>
        <div class="form-group">
            <label for="">Telefono</label>
            <input type="text" name="telefono" value="{{$cliente->telefono}}"class="form-control">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email" value="{{$cliente->email}}"class="form-control">
        </div>


        <button type="submit" class="btn btn-primary">Editar</button>
    </form>


@endsection

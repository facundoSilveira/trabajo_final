@extends('admin-lte.index')

@section('content')

<form class="form-group" method="POST" action="/proveedores/{{$proveedor->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5>
                    Editar Proveedor
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
            <input type="text" name="nombre" value="{{$proveedor->nombre}}"class="form-control">
        </div>

        <div class="form-group">
            <label for="">Cuit</label>
            <input type="text" name="cuit" value="{{$proveedor->cuit}}"class="form-control" >
        </div>
        <div class="form-group">
            <label for="">Telefono</label>
            <input type="text" name="telefono" value="{{$proveedor->telefono}}"class="form-control">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email" value="{{$proveedor->email}}"class="form-control">
        </div>
        <div class="form-group">
            <label for="">Direccion Postal</label>
            <input type="text" name="direc_postal" value="{{$proveedor->direc_postal}}"class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Editar</button>
    </form>


@endsection

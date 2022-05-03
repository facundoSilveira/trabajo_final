@extends('admin-lte.index')

@section('content')

<form class="form-group" method="POST" action="/tecnicos/{{$tecnico->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5>
                    Editar tecnico
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
            <input type="text" name="nombre" value="{{$tecnico->nombre}}"class="form-control">
        </div>
        <div class="form-group">
            <label for="">Apellido</label>
            <input type="text" name="apellido" value="{{$tecnico->apellido}}"class="form-control">
        </div>
        <div class="form-group">
            <label for="">DNI</label>
            <input type="text" name="dni" value="{{$tecnico->dni}}"class="form-control" >
        </div>
        <div class="form-group">
            <label for="">Telefono</label>
            <input type="text" name="telefono" value="{{$tecnico->telefono}}"class="form-control">
        </div>

        <div class="form-group">
            <label for="">Calle</label>
            <input type="text" name="calle" value="{{$tecnico->direccion->calle}}"class="form-control">
        </div>

        <div class="form-group">
            <label for="">Altura</label>
            <input type="text" name="altura" value="{{$tecnico->direccion->altura}}"class="form-control">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email" value="{{$tecnico->email}}"class="form-control">
        </div>
        <div class="form-group">
            <label for="">Contraseña</label>
            <input type="password" name="password" id="password" value="**********" class="form-control"
            placeholder="Ingrese la contraseña del usuario" readonly>
        </div>


        <button type="submit" class="btn btn-primary">Editar</button>
    </form>


@endsection

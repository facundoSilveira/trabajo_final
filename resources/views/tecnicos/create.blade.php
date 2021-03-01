@extends('admin-lte.index')


@section('content')


<form class="form-group" method="POST" action="/tecnicos" enctype="multipart/form-data">
@csrf
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>
                Crear tecnico
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
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="form-control"
        placeholder="Ingrese el nombre del tecnico">
    </div>
    <div class="form-group">
        <label for="">Apellido</label>
        <input type="text" name="apellido" id="apellido" value="{{ old('apellido') }}" class="form-control"
        placeholder="Ingrese el apellido del tecnico">
    </div>
    <div class="form-group">
        <label for="">DNI</label>
        <input type="text" name="dni" id="id" value="{{ old('id') }}"class="form-control"
        placeholder="Ingrese el DNI del tecnico">
    </div>
    <div class="form-group">
        <label for="">Telefono</label>
        <input type="text" name="telefono" id="id" value="{{ old('id') }}"class="form-control"
        placeholder="Ingrese el telefono del tecnico">
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control"
        placeholder="Ingrese el email del tecnico">
    </div>
    <div class="form-group">
        <label for="">Contraseña</label>
        <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control"
        placeholder="Ingrese la contraseña del usuario" required>
    </div>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>
                Direccion del tecnico
            </h5>
        </div>
        <div class="form-group">
            <label for="">Calle</label>
            <input type="text" name="calle" id="calle" value="{{ old('calle') }}" class="form-control"
            placeholder="Ingrese la calle del tecnico">
        </div>

        <div class="form-group">
            <label for="">Altura</label>
            <input type="text" name="altura" id="altura" value="{{ old('altura') }}"class="form-control"
            placeholder="Ingrese la altura del tecnico">
        </div>


        <div class="card-footer float">
            <div class="float-right">
                <a href="javascript:history.back()" class="btn btn-dark"><i class="fa fa-times"></i> Cancelar </a>
                <button type="submit" class="btn btn-primary "><i class="fa fa-check"></i> Guardar</button>
            </div>
        </div>

</form>

@endsection

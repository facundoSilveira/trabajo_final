@extends('admin-lte.index')


@section('content')
<h1>Cliente</h1>
<form class="form-group"  method="POST" action="/clientes">
    @csrf
    <div class="form-group">
        <h2>Datos Personales</h2>
        <label>Apellido</label>
        <input type="text" value="{{$cliente->apellido}}" name="apellido" class="form-control" readonly>

        <label>Nombre</label>
        <input type="text" value="{{$cliente->nombre}}" name="nombre" class="form-control" readonly>
        <label>Dni</label>
        <input type="text" value="{{$cliente->dni}}" name="dni" class="form-control" readonly>
        <label>Telefono</label>
        <input type="text" value="{{$cliente->telefono}}" name="telefonon" class="form-control" readonly>
        <br>
        <h3>Domicilio</h3>
        <label>Calle</label>
        <input type="text" value="{{$cliente->direccion->calle}}"  name="calle" class="form-control" readonly>
        <label>Altura</label>
        <input type="text" value="{{$cliente->direccion->altura}}" name="altura" class="form-control" readonly>

    </div>

    <div class="text-right">
    <input type="reset" value="Editar" class="btn btn-secondary"  onclick="location.href='/clientes/{{$cliente->id}}/edit'">
    </div>

    <div class="card-footer d-flex justify-content-center">
        <a href="javascript:history.back()" class="btn btn-primary btn-sm">Volver</a>
    </div>


</form>
@endsection

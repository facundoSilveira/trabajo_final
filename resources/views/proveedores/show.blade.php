@extends('admin-lte.index')


@section('content')
<h1>Proveedor</h1>
<form class="form-group"  method="POST" action="/proveedores">
    @csrf
    <div class="form-group">
        <h2>Datos Personales</h2>
        <label>Nombre</label>
        <input type="text" value="{{$proveedor->nombre}}" name="nombre" class="form-control" readonly>

        <label>Cuit</label>
        <input type="text" value="{{$proveedor->cuit}}" name="cuit" class="form-control" readonly>
        <label>Telefono</label>
        <input type="text" value="{{$proveedor->telefono}}" name="telefono" class="form-control" readonly>
        <label>Email</label>
        <input type="text" value="{{$proveedor->email}}" name="email" class="form-control" readonly>
        <label>Direccion postal</label>
        <input type="text" value="{{$proveedor->direc_postal}}" name="direc_postal" class="form-control" readonly>
        <br>
        <h3>Domicilio</h3>
        <label>Calle</label>
        <input type="text" value="{{$proveedor->direccion->calle}}"  name="calle" class="form-control" readonly>
        <label>Altura</label>
        <input type="text" value="{{$proveedor->direccion->altura}}" name="altura" class="form-control" readonly>

    </div>

    <div class="text-right">
    <input type="reset" value="Editar" class="btn btn-secondary"  onclick="location.href='/proveedores/{{$proveedor->id}}/edit'">
    </div>

    <div class="card-footer d-flex justify-content-center">
        <a href="javascript:history.back()" class="btn btn-primary btn-sm">Volver</a>
    </div>


</form>
@endsection

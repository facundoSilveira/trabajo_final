@extends('admin-lte.index')


@section('content')


<form class="form-group" method="POST" action="/proveedores" enctype="multipart/form-data">
@csrf
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>
                Crear Proveedor
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
        placeholder="Ingrese el nombre del proveedor">
    </div>

    <div class="form-group">
        <label for="">Cuit</label>
        <input type="text" name="cuit" id="cuit" value="{{ old('cuit') }}"class="form-control"
        placeholder="Ingrese el cuit del proveedor">
    </div>
    <div class="form-group">
        <label for="">Telefono</label>
        <input type="text" name="telefono" id="id" value="{{ old('telefono') }}"class="form-control"
        placeholder="Ingrese el telefono del proveedor">
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control"
        placeholder="Ingrese el email del proveedor">
    </div>
    <div class="form-group">
        <label for="">Direccion Postal</label>
        <input type="text" name="direc_postal" id="direc_posta" value="{{ old('direc_postal') }}" class="form-control"
        placeholder="Ingrese la Direccion Postal del proveedor">
    </div>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>
                Direccion del proveedor
            </h5>
        </div>
        <div class="form-group">
            <label for="">Calle</label>
            <input type="text" name="calle" id="calle" value="{{ old('calle') }}" class="form-control"
            placeholder="Ingrese la calle del proveedor">
        </div>

        <div class="form-group">
            <label for="">Altura</label>
            <input type="text" name="altura" id="altura" value="{{ old('altura') }}"class="form-control"
            placeholder="Ingrese la altura del proveedor">
        </div>


        <div class="card-footer float">
            <div class="float-right">
                <a href="javascript:history.back()" class="btn btn-dark"><i class="fa fa-times"></i> Cancelar </a>
                <button type="submit" class="btn btn-primary "><i class="fa fa-check"></i> Guardar</button>
            </div>
        </div>

</form>

@endsection

@extends('admin-lte.index')


@section('content')


<form class="form-group" method="POST" action="/tipo_equipos" enctype="multipart/form-data">
@csrf
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>
                Crear Marca
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
        <input type="text" name="nombre" class="form-control">
    </div>

    <div class="card-footer float">
        <div class="float-right">
            <a href="javascript:history.back()" class="btn btn-dark"><i class="fa fa-times"></i> Cancelar </a>
            <button type="submit" class="btn btn-primary "><i class="fa fa-check"></i> Guardar</button>
        </div>
    </div>

</form>

@endsection

@extends('admin-lte.index')


@section('content')


<form class="form-group" method="POST" action="/tipo_recursos" enctype="multipart/form-data">
@csrf
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>
                Crear Tipo Recurso
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
            placeholder="Ingrese el nombre del tipo de recurso">
        </div>

        <div class="form-group">
            <label for="">Descripcion</label>
            <input type="text" name="descripcion" id="descripcion" value="{{ old('descripcion') }}" class="form-control"
            placeholder="Ingrese el descripcion del tipo de recurso">
        </div>





        <div class="card-footer float">
            <div class="float-right">
                <a href="javascript:history.back()" class="btn btn-dark"><i class="fa fa-times"></i> Cancelar </a>
                <button type="submit" class="btn btn-primary "><i class="fa fa-check"></i> Guardar</button>
            </div>
        </div>
    </div>

</form>

@endsection


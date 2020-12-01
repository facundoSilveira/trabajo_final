@extends('admin-lte.index')


@section('content')


<form class="form-group" method="POST" action="/modelos" enctype="multipart/form-data">
@csrf
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>
                Crear Modelo
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
            placeholder="Ingrese el nombre del modelo">
        </div>


        </div>
        <div class="form-group ">
            <label for="cliente" class=" col-form-label text-md-right">Tipo Recursos</label>
            <label for="agregar_tipoRecurso">
                <a role="button" type="button" href="{{route('tipo_recursos.create')}}" title="Nuevo Tipo Recurso"><i
                        class="fas fa-plus-circle fa-md"></i></a>
            </label>

            <select class="form-control" name="tipo_recurso_id"  id="tipo_recurso" required>
                @foreach($tipo_recursos as $tipo_recurso)
                <option value="{{$tipo_recurso->id}}" @if(old('tipo_recurso_id')==$tipo_recurso->id) selected
                    @endif>{{$tipo_recurso->nombre}}</option>
                @endforeach
            </select>
        </div>

    <div class="card-footer float">
        <div class="float-right">
            <a href="javascript:history.back()" class="btn btn-dark"><i class="fa fa-times"></i> Cancelar </a>
            <button type="submit" class="btn btn-primary "><i class="fa fa-check"></i> Guardar</button>
        </div>
    </div>

</form>

@endsection

@push('scripts')
<script>

        $("#modelo").select2({
            placeholder: "seleccione un Tipo de recurso"
        });


</script>
@endpush


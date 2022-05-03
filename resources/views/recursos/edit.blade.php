@extends('admin-lte.index')

@section('content')

<form class="form-group" method="POST" action="/recursos/{{$recurso->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5>
                    Editar Recurso
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

        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="tipo_recurso" class=" col-form-label text-md-right">Tipo Recurso</label>
                    <select class="seleccion form-control" name="tipo_recurso_id" id="tipo_recurso" required>
                        <option value="{{$recurso->tipo_recurso_id}}" disabled selected>{{$recurso->tipo_recurso->nombre}}</option>
                        @foreach($tipo_recursos as $tipo_recurso)
                        <option value="{{$tipo_recurso->id}}" @if(old('tipo_recurso_id')==$tipo_recurso->id) selected
                            @endif>{{$tipo_recurso->nombre}} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="" class="col-form-label text-md-right">Precio</label>
                    <input type="text" name="precio" value="{{$recurso->precio}}"class="form-control" >
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="marca" class=" col-form-label text-md-right">Marca</label>
                    <select class="seleccion form-control" name="marca_recurso_id" id="marca" required>
                        <option value="{{$recurso->marca_recurso_id}}" disabled selected>{{$recurso->marcaRecurso->nombre}}</option>
                        @foreach($marcas as $marca)
                        <option value="{{$marca->id}}" @if(old('marca_id')==$marca->id) selected
                            @endif>{{$marca->nombre}} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="modelo" class=" col-form-label text-md-right">Modelo</label>
                    <select class="seleccion form-control" name="modelo_id" id="modelo" required>
                        <option value="{{$recurso->modelo_id}}" disabled selected>{{$recurso->modelo->nombre}}</option>
                        @foreach($modelos as $modelo)
                        <option value="{{$modelo->id}}" @if(old('modelo_id')==$modelo->id) selected
                            @endif>{{$modelo->nombre}} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="medida" class=" col-form-label text-md-right">Medida</label>
                    <select class="seleccion form-control" name="medida_id" id="medida" required>
                        <option value="{{$recurso->medida_id}}" disabled selected>{{$recurso->medida->nombre}}</option>
                        @foreach($medidas as $medida)
                        <option value="{{$medida->id}}" @if(old('medida_id')==$medida->id) selected
                            @endif>{{$medida->nombre}} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="" class="col-form-label text-md-right">stockMinimo</label>
                    <input type="text" name="stockMinimo" value="{{$recurso->stockMinimo}}"class="form-control">
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="" class="col-form-label text-md-right">Tamaño</label>
                    <input type="text" name="tamaño" value="{{$recurso->tamaño}}"class="form-control" >
                </div>
            </div>




        </div>




        <button type="submit" class="btn btn-primary">Editar</button>
    </form>

    <div class="card-footer d-flex justify-content-center">
        <a href="javascript:history.back()" class="btn btn-primary btn-sm">Volver</a>
    </div>


@endsection

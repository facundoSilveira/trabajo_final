@extends('admin-lte.index')

@section('content')

<form class="form-group" method="POST" action="/servicios/{{$servicio->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5>
                    Editar Servicio
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
        <select class="seleccion form-control" name="equipo_id" id="equipo" required>
                <option value="" disabled selected>--Seleccione un tipo de equipo--</option>
                @foreach($equipos as $equipo)
                <option value="{{$equipo->id}}" @if(old('equipo_id')==$equipo->id) selected
                    @endif>{{$equipo->nroSerie}} {{$equipo->cliente->nombre}}
                    {{$equipo->cliente->apellido}}{{$equipo->cliente->dni}} </option>
                @endforeach
        </select>
        <div class="form-group">
            <label for="">Problema Cliente</label>
            <input type="text" name="problemaCliente" value="{{$servicio->problemaCliente}}"class="form-control">
        </div>
        <div class="form-group">
            <label for="">Contraseña</label>
            <input type="text" name="contraseña" value="{{$servicio->contraseña}}"class="form-control">
        </div>




        <button type="submit" class="btn btn-primary">Editar</button>
    </form>


@endsection

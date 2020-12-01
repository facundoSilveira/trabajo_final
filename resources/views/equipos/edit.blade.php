@extends('admin-lte.index')

@section('content')

<form class="form-group" method="POST" action="/equipos/{{$equipo->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5>
                    Editar Equipo
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
            <label for="">Foto</label>
            <input type="file" name="foto" value="{{$equipo->foto}}">
        </div>
        <div class="form-group">
            <label for="">Numero Serie</label>
            <input type="text" name="nroSerie" value="{{$equipo->nroSerie}}"class="form-control">
        </div>
        <div class="form-group">
            <label for="">Detalles Generales</label>
            <input type="text" name="detallesGenerales" value="{{$equipo->detallesGenerales}}"class="form-control" >
        </div>
        


        <button type="submit" class="btn btn-primary">Editar</button>
    </form>


@endsection
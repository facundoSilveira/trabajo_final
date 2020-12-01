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
        <div class="form-group">
            <label for="">stockMinimo</label>
            <input type="text" name="stockMinimo" value="{{$recurso->stockMinimo}}"class="form-control">
        </div>
        <div class="form-group">
            <label for="">Numero Serie</label>
            <input type="text" name="nroSerie" value="{{$recurso->nroSerie}}"class="form-control">
        </div>
        <div class="form-group">
            <label for="">Tamaño</label>
            <input type="text" name="tamaño" value="{{$recurso->tamaño}}"class="form-control" >
        </div>



        <button type="submit" class="btn btn-primary">Editar</button>
    </form>


@endsection

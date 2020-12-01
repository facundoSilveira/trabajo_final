@extends('admin-lte.index')

@section('content')
<div class="content-fluid">
    <div class="row  justify-content-center">
        <div class="col-md-10">
            <div class="card card-primary card-outline">

                <div class="card-body box-profile">
                    <div class="text-center">
                        <h3 class="profile-username text-center">Recurso: {{$recurso->tipo_recurso->nombre}} </h3>
                        <p class="text-muted">Numero de Serie: <span class="badge badge-info"><i class="fal fa-num nav-icon"></i>{{$recurso->nroSerie}}</span></p>



                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <strong><i class="fal fa-file-alt mr-1"></i>Detalles del recurso: <br>
                                <p>
                                    Tipo de recurso: {{$recurso->tipo_recurso->nombre}} <br>
                                    Modelo: {{$recurso->modelo->nombre}} <br>
                                    Tamaño: {{$recurso->tamaño}}{{$recurso->medida->nombre}} <br>
                                    Marca: <i class="text-muted"> {{$recurso->marcaRecurso->nombre}} </i><br>
                                    Stock Minimo: {{$recurso->stockMinimo}}<br>
                                    Stock: {{$recurso->stock}}<br>

                                </p>
                            </strong>
                        </div>
                        <div class="col-md-4">
                                <strong><i class="fal fa-file-alt mr-1"></i>Comprado a: <br>
                                    <p>
                                        Nombre: <i class="text-muted"> {{$recurso->nombre}} {{$recurso->nombre}} </i><br>
                                        DNI: {{$recurso->modelo->nombre}}<br>

                                    </p>
                                </strong>
                        </div>
                    </div>




                </div>

                <div class="card-footer d-flex justify-content-center">
                    <a href="javascript:history.back()" class="btn btn-primary btn-sm">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

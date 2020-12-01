@extends('admin-lte.index')

@section('content')

<div class="content-fluid">
    <div class="row  justify-content-center">
        <div class="col-md-10">
            <div class="card card-primary card-outline">

                <div class="card-body box-profile">
                    <div class="text-center">
                        <h3 class="profile-username text-center">Equipo: {{$equipo->tipo_equipo->nombre}} </h3>
                        <p class="text-muted">Numero de Serie: <span class="badge badge-info"><i class="fal fa-num nav-icon"></i>{{$equipo->nroSerie}}</span></p>

                            <img style="height: 300px; width: 300px; background-color: #EFEFEF; margin: 0px;" class="card-img-top rounded-circle mx-auto d-block"  src="{{asset("images/$equipo->foto")}}" alt="">

                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <strong><i class="fal fa-file-alt mr-1"></i>Detalles del Equipo: <br>
                                <p>
                                    Marca: <i class="text-muted"> {{$equipo->marca->descripcion}} </i><br>
                                    Tipo de Equipo: {{$equipo->tipo_equipo->nombre}} <br>

                                    Detalles: {{$equipo->detallesGenerales}}
                                </p>
                            </strong>
                         </div>
                        <div class="col-md-4">
                                <strong><i class="fal fa-file-alt mr-1"></i>Registrado por: <br>
                                    <p>
                                        Nombre: <i class="text-muted"> {{$equipo->cliente->apellido}} {{$equipo->cliente->nombre}} </i><br>
                                        DNI: {{$equipo->cliente->dni}}<br>

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

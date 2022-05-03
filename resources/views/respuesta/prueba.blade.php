
@extends('admin-lte.index')

@section('content')

<div class="content-fluid">
    <div class="row  justify-content-center">
        <div class="col-md-10">
            <div class="card card-primary card-outline">

                <div class="card-body box-profile">
                    <div class="text-center">
                        <h3 class="profile-username text-center">Equipo: {{$informe->servicio->equipo->tipo_equipo->nombre}} </h3>
                        <p class="text-muted">Numero de Serie: <span class="badge badge-info"><i class="fal fa-num nav-icon"></i>{{$informe->servicio->equipo->nroSerie}}</span></p>

                            <img style="height: 300px; width: 300px; background-color: #EFEFEF; margin: 0px;" class="card-img-top rounded-circle mx-auto d-block"  src="{{asset("images/".$informe->servicio->equipo->foto)}}" alt="">

                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <strong><i class="fal fa-file-alt mr-1"></i>Detalles del informe: <br>
                                <p>
                                    Presupuesto: <i class="text-muted"> {{$informe->presupuesto}} </i><br>
                                    @foreach ($informe->servicio->tipos as $tipo)
                                    ProblemaTecnico: {{$tipo->tipo->nombre}} <br>
                                    @endforeach

                                    Descripcion: {{$informe->descripcion}}<br>
                                </p>
                            </strong>
                         </div>
                        <div class="col-md-4">
                                <strong><i class="fal fa-file-alt mr-1"></i>Registrado por: <br>
                                    <p>
                                        Nombre: <i class="text-muted"> {{$informe->servicio->equipo->cliente->apellido}} {{$informe->servicio->equipo->cliente->nombre}} </i><br>
                                        DNI: {{$informe->servicio->equipo->cliente->dni}}<br>

                                    </p>
                                </strong>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-success btn-sm" href="{{ route('mis_servicios.confirmado', ['valor' => 1, 'informe' => $informe]) }}">confirmar</a>
                        <a class="btn btn-danger btn-sm" href="{{ route('mis_servicios.confirmado', ['valor' => 0, 'informe' => $informe]) }}">rechazar</a>
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

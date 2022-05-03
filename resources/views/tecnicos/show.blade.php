@extends('admin-lte.index')

@section('content')
<div class="content-fluid">
    <div class="row  justify-content-center">
        <div class="col-md-10">
            <div class="card card-primary card-outline">

                <div class="card-body box-profile">
                    <div class="text-center">
                        <h3 class="profile-username text-center">Tecnico: {{$tecnico->nombre}} {{$tecnico->apellido}} </h3>
                        <p class="text-muted">DNI: <span class="badge badge-info"><i class="fal fa-num nav-icon"></i>{{$tecnico->dni}}</span></p>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <strong><i class="fal fa-file-alt mr-1"></i>Datos Personales <br>
                                <p>
                                    Telefono: <i class="text-muted"> {{$tecnico->telefono}} </i><br>
                                    Email: {{$tecnico->email}} <br>
                                    Direccion: {{$tecnico->direccion->calle}} {{$tecnico->direccion->altura}}
                                </p>
                            </strong>
                         </div>
                        <div class="col-md-4">
                                <strong><i class="fal fa-file-alt mr-1"></i>Rendimiento <br>
                                    <p>
                                        Servicios asignados: <i class="text-muted">  </i><br>
                                        Servicios finalisados: <br>

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

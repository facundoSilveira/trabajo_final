@extends('admin-lte.index')

@section('content')
<br>
<div class="content-fluid">
    <div class="row  justify-content-center">
        <div class="col-md-10">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <h3 class="profile-username text-center">Informacion de Movimiento Nº {{$movimiento->id}} </h3>
                    </div>

                    <strong><i class="fal fa-file-alt mr-1"></i>Datos del Comprobante </strong>
                    <br>

                    <div class="row">

                        <div class="col-md-4">
                            <p>
                                Proveedor: <i
                                    class="text-muted">{{$movimiento->cabeceraMovimiento->proveedor->nombre}}</i> <br>
                            </p>
                        </div>
                        <div class="col-md-3">
                            <p>
                                Cuit: {{$movimiento->cabeceraMovimiento->proveedor->cuit}}
                            </p>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <p>Tipo de Comprobante: {{$movimiento->cabeceraMovimiento->tipoComprobante->nombre}}</p>
                        </div>
                        <div class="col-md-4">
                            <p> Nº del Comprobante: {{$movimiento->cabeceraMovimiento->numeroComprobante}} </p>
                        </div>

                        <div class="col-md-4">
                            <p>Fecha del Comprobante: {{$movimiento->cabeceraMovimiento->fechaComprobante}} </p>
                        </div>

                    </div>
                    <hr>
                    <strong><i class="fal fa-file-alt mr-1"></i>Datos del Movimiento: </strong>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                Tipo de Movimiento: <i class="text-muted">
                                    {{$movimiento->tipoMovimiento->nombre}}</i><br>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p>
                                Recurso: {{$movimiento->recurso->tipo_recurso->nombre}} {{$movimiento->recurso->modelo->nombre}} {{$movimiento->recurso->tamaño}} {{$movimiento->tamaño}} {{$movimiento->recurso->medida->nombre}}<br>
                                {{-- recurso: {{$movimiento->recurso->tipo_recurso->nombre}} {{$movimiento->recurso->modelo->nombre}} {{$movimiento->tamaño}} {{$movimiento->medida->nombre}}<br> --}}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p>
                                Fecha del Movimiento: {{$movimiento->cabeceraMovimiento->fecha}}
                            </p>
                        </div>

                        <div class="col-md-4">
                            <p>
                                Cantidad Ingresada: {{$movimiento->cantidad}}
                            </p>
                        </div>

                        <div class="col-md-4">
                            <p>
                                {{-- Fecha de Creacion: {{$movimiento->cabeceraMovimiento->trabajo->getFecha()}} <br> --}}
                            </p>
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

@extends('admin-lte.index')

@section('content')
<br>
<div class="content-fluid">
    <div class="row  justify-content-center">
        <div class="col-md-10">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <h3 class="profile-username text-center">Informacion del pedido Nº {{$pedido->id}} </h3>
                    </div>

                    <strong><i class="fal fa-file-alt mr-1"></i>Pedido</strong>
                    <br>

                    <div class="row">

                        <div class="col-md-4">
                            <p>
                                Proveedor:
                                @if ($pedido->proveedor == null)
                                <span class="badge badge-secondary">Sin Asignar</span>
                                @else
                                <i class="text-muted">{{$pedido->proveedor->nombre}}</i> <br>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-3">
                            @if ($pedido->proveedor == null)
                                <span class="badge badge-secondary">Sin Asignar</span>
                                @else
                                <p>
                                    Cuit: {{$pedido->proveedor->cuit}}
                                </p>
                                @endif

                        </div>

                    </div>

                        <div class="col-md-4">
                            <p>


                                    @foreach ($detalles as $detalle)
                                    @if ($detalle->pedido_id == $pedido->id)
                                    Recurso:  {{$detalle->recurso->tipo_recurso->nombre}} {{$detalle->recurso->modelo->nombre}} {{$detalle->recurso->tamaño}} {{$detalle->recurso->medida->nombre}} <br>
                                    Cantidad Ingresada: {{$detalle->cantidad}} <br>
                                    @endif
                                    @endforeach

                                {{-- {{$pedido->detalles->recurso->tipo_recurso->nombre}} {{$pedido->recurso->modelo->nombre}} {{$pedido->recurso->tamaño}} {{$pedido->tamaño}} {{$pedido->recurso->medida->nombre}}<br> --}}
                                {{-- recurso: {{$pedido->recurso->tipo_recurso->nombre}} {{$movimiento->recurso->modelo->nombre}} {{$movimiento->tamaño}} {{$movimiento->medida->nombre}}<br> --}}
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


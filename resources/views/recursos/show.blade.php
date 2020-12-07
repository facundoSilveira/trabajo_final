@extends('admin-lte.index')

@section('content')
<div class="content-fluid">
    <div class="row  justify-content-center">
        <div class="col-md-10">
            <div class="card card-primary card-outline">
                <div class="card-header text-center"><h3>Recurso: {{$recurso->tipo_recurso->nombre}} </h3></div>
                <div class="card-body box-profile">
                    <div class="row">
                        <div class="col">
                            <div class="box box-solid">
                                <div class="box-header with-border">


                                  <h3 class="box-title"><i class="fas fa-file-alt ml-2 mr-1"></i>Detalle</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                  <blockquote>
                                    <p><b>Marca:</b> {{$recurso->marcaRecurso->nombre}}</p>
                                    <p><b>Modelo:</b> {{$recurso->modelo->nombre}}</p>
                                    <p><b>Tamaño:</b> {{$recurso->tamaño}} {{$recurso->medida->nombre}}</p>
                                    <p><b>Precio:</b> ${{$recurso->precio}}</p>
                                    <p><b>Stock:</b> <span class="badge badge bg-success">{{$recurso->stock}} unidades</span></p>
                                    <p><b>Reservas:</b> <span class="badge badge bg-light">{{$recurso->getReservas()}} unidades</span></p>
                                    <p><b>Stock disponible:</b> <span class="badge badge bg-warning">{{$recurso->stock - $recurso->getReservas()}} unidades</span></p>
                                </blockquote>
                                </div>
                                <!-- /.box-body -->
                              </div>
                        </div>
                    </div>

                    @if ($recurso->stock - $recurso->getReservas() < $recurso->stockMinimo)
                      <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading"><h4><i class="fas fa-exclamation-triangle"></i><b> Stock en riesgo</b></h4></h4>
                        <p>Ten en cuenta que tu stock esta por debajo del mínimo establecido.</p>
                        <hr>
                        <p class="mb-0"><a href="{{route('movimientos.create')}}">Solicitar mas</a></p>
                      </div>
                    @endif

                </div>

                <div class="card-footer d-flex justify-content-center">
                    <a href="javascript:history.back()" class="btn btn-light btn-sm">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

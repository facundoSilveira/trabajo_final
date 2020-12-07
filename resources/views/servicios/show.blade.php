@extends('admin-lte.index')

@section('content')

<div class="row">
    <div class="col-md-4">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <span style="font-size: 8em; color: #3c8dbc;">
                        <i class="fas fa-tasks"></i>
                    </span>
                </div>

                <h3 class="profile-username text-center">@foreach ($servicio->tipos as $tipo)
                         <b>{{ $tipo->tipo->nombre }}</b>
                    @endforeach para
                    {{ $servicio->equipo->cliente->nombre }} {{ $servicio->equipo->cliente->apellido }}</h3>

                <ul>
                    <li class="list-group-item">
                        @foreach ($servicio->tipos as $tipo)
                             <b>{{ $tipo->tipo->nombre }}</b>
                        @endforeach

                        <a class="float-right">
                            <span class="badge badge-pill bg-light">Tipo de servicio</span>
                        </a>

                    </li>

                </ul>
                <ul>
                    <li class="list-group-item">
                        @if ($servicio->tecnico_id == null)
                        <form class="form-group" method="POST" action="{{route('servicios.agregar_tecnico', ['servicio' => $servicio->id])}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="servicio" value="{{$servicio}}">
                        <select class="seleccion form-control" name="tecnico_id" id="tecnico" required>
                            <option value="" disabled selected>--Seleccione un tipo de equipo--</option>
                            @foreach($tecnicos as $tecnico)
                            <option value="{{$tecnico->id}}" @if(old('tecnico_id')==$tecnico->id) selected
                                @endif>{{$tecnico->nombre}} </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary "><i class="fa fa-check"></i> Guardar</button>
                        </form>
                        @else
                        <b>{{ $servicio->tecnico->nombre }} {{ $servicio->tecnico->apellido }}</b>
                        <a class="float-right">
                            <span class="badge badge-pill bg-light">Tecnico Asignado</span>
                        </a>
                        @endif


                    </li>

                </ul>
                <ul>
                    <li class="list-group-item">
                        <b>{{ $servicio->getEstado() }}</b>
                        <a class="float-right">
                            <span class="badge badge-pill bg-light">Estado del Servicio</span>
                        </a>

                    </li>

                </ul>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#detalleservicio" data-toggle="tab">Detalle</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#recursos" data-toggle="tab">recursos</a>
                    </li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="detalleservicio">

                        <div class="text-muted" style="font-family: 'Open Sans', serif;">servicio</div>
                        <hr style="margin-bottom: 1%; margin-top: 0%">
                        <dl class="row" style="margin-left: 1%">
                            <dt class="col-sm-3">Fecha Recibido</dt>
                            <dd class="col-sm-8 text-muted">
                                {{ $servicio->fechaRecibida}}
                            </dd>
                        </dl>

                        <dl class="row" style="margin-left: 1%">
                            <dt class="col-sm-3">Precio de trabajo</dt>
                            <dd class="col-sm-8 text-muted">${{ $servicio->getPrecio() }}</dd>
                        </dl>



                        <div class="text-muted" style="font-family: 'Open Sans', serif;">CLIENTE</div>
                        <hr style="margin-bottom: 1%; margin-top: 0%">
                        <dl class="row" style="margin-left: 1%">
                            <dt class="col-sm-3">Nombre</dt>
                            <dd class="col-sm-8 text-muted">{{ $servicio->equipo->cliente->nombre }}</dd>
                        </dl>
                        <dl class="row" style="margin-left: 1%">
                            <dt class="col-sm-3">Apellido</dt>
                            <dd class="col-sm-8 text-muted">{{ $servicio->equipo->cliente->apellido }}</dd>
                        </dl>
                        <dl class="row" style="margin-left: 1%">
                            <dt class="col-sm-3">DNI</dt>
                            <dd class="col-sm-8 text-muted">{{ $servicio->equipo->cliente->dni }}</dd>
                        </dl>
                        <dl class="row" style="margin-left: 1%">
                            <dt class="col-sm-3">Teléfono</dt>
                            <dd class="col-sm-8 text-muted">{{ $servicio->equipo->cliente->telefono}}</dd>
                        </dl>
                        <dl class="row" style="margin-left: 1%">
                            <dt class="col-sm-3">Teléfono</dt>
                            <dd class="col-sm-8 text-muted">{{ $servicio->equipo->cliente->email }}</dd>
                        </dl>

                        @if ($servicio->tecnico_id != null)
                        <div class="text-muted" style="font-family: 'Open Sans', serif;">TECNICO</div>
                        <hr style="margin-bottom: 1%; margin-top: 0%">
                        <dl class="row" style="margin-left: 1%">
                            <dt class="col-sm-3">Nombres</dt>
                            <dd class="col-sm-8 text-muted">{{ $servicio->tecnico->nombre }}</dd>
                        </dl>
                        <dl class="row" style="margin-left: 1%">
                            <dt class="col-sm-3">Apellidos</dt>
                            <dd class="col-sm-8 text-muted">{{ $servicio->tecnico->apellido }}</dd>
                        </dl>
                        <dl class="row" style="margin-left: 1%">
                            <dt class="col-sm-3">DNI</dt>
                            <dd class="col-sm-8 text-muted">{{ $servicio->tecnico->dni }}</dd>
                        </dl>
                        <dl class="row" style="margin-left: 1%">
                            <dt class="col-sm-3">Teléfono</dt>
                            <dd class="col-sm-8 text-muted">{{ $servicio->tecnico->telefono }}</dd>
                        </dl>
                        @endif

                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="recursos">

                        <div class="callout" style="border-left-color: #3c8dbc;">
                            <h5>Recursos</h5>

                            <p>no programado</p>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->



@endsection

@push('scripts')

@endpush

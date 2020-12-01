@extends('admin-lte.index')


@section('content')


<form class="form-group" method="POST" action="/servicios" enctype="multipart/form-data">
    @csrf
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>
                Crear Servicio
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
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <div class="form-group ">
                    <label for="equipo" class=" col-form-label text-md-right">equipo</label>
                    <label for="agregar_equipo">
                        <a role="button" type="button" href="{{route('equipos.create')}}" title="Nueva equipo"><i
                                class="fas fa-plus-circle fa-md"></i></a>
                    </label>

                    <select class="seleccion form-control" name="equipo_id" id="equipo" required>
                        <option value="" disabled selected>--Seleccione un tipo de equipo--</option>
                        @foreach($equipos as $equipo)
                        <option value="{{$equipo->id}}" @if(old('equipo_id')==$equipo->id) selected
                            @endif>{{$equipo->nroSerie}} {{$equipo->cliente->nombre}}
                            {{$equipo->cliente->apellido}}{{$equipo->cliente->dni}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                    <div class="form-group ">
                        <label for="tipo_servicio" class=" col-form-label text-md-right">tipo servicios</label>
                        <label for="agregar_tipo_servicio">
                            <!-- estamos indicando a la etiqueta a que habra el modal cuyo id es modal-lg-->
                            <a role="button" type="button" href="#" title="Nueva tipo servicio" data-toggle="modal"
                            data-target="#modal-lg" role="button"
                            data-toggle="modal" data-target="#modal-lg"
                            ><i class="fas fa-plus-circle fa-md"></i></a>
                        </label>

                        <select class="seleccion form-control" name="tipo_servicio_id" id="tipo_servicio" required>
                            <option value="" disabled selected>--Seleccione un tipo_servicio--</option>
                            @foreach($tipo_servicios as $tipo_servicio)
                            <option value="{{$tipo_servicio->id}}" @if(old('tipo_servicio_id')==$tipo_servicio->id) selected
                                @endif>{{$tipo_servicio->nombre}} </option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="" class=" col-form-label text-md-right">Fecha Recibida</label>
                    <input type="date" name="fechaRecibida" class="form-control" placeholder="Ingrese la fecha ">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="" class=" col-form-label text-md-right">Problema Cliente</label>
                    <input type="text" name="problemaCliente" class="form-control" placeholder="Ingrese el problema descrito por el cliente">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="" class=" col-form-label text-md-right">Contraseña</label>
                    <input type="text" name="contraseña" class="form-control" placeholder="Ingrese la contraseña">
                </div>
            </div>

            <div class="col-3">
                <div class="form-group ">
                    <label for="servicio" class=" col-form-label text-md-right">Accesorios</label>
                    <label for="agregar_accesorio">
                        <a role="button" type="button" href="{{route('accesorios.create')}}" title="Nuevo Accesorio"><i
                                class="fas fa-plus-circle fa-md"></i></a>
                    </label>
                    <select class="form-control" name="accesorios_id[]"  id="accesorio" multiple required>

                        @foreach($accesorios as $accesorio)
                        <option value="{{$accesorio->id}}" @if(old('accesorio_id')==$accesorio->id) selected
                            @endif>{{$accesorio->descripcion}}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="col-3">
                <div class="form-group ">
                    <label for="prioridad" class=" col-form-label text-md-right">Prioridad</label>
                    <label for="agregar_prioridad">
                        <a role="button" type="button" href="{{route('prioridades.create')}}" title="Nueva prioridad"><i
                                class="fas fa-plus-circle fa-md"></i></a>
                    </label>

                    <select class="seleccion form-control" name="prioridad_id" id="prioridad" required>
                        <option value="" disabled selected>--Seleccione un tipo de equipo--</option>
                        @foreach($prioridades as $prioridad)
                        <option value="{{$prioridad->id}}" @if(old('prioridad_id')==$prioridad->id) selected
                            @endif>{{$prioridad->nombre}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group ">
                    <label for="tecnico" class=" col-form-label text-md-right">Tecnico </label>
                    <label for="agregar_tecnico">
                        <a role="button" type="button" href="{{route('tecnicos.create')}}" title="Nueva tecnico"><i
                                class="fas fa-plus-circle fa-md"></i></a>
                    </label>

                    <select class="seleccion form-control" name="tecnico_id" id="tecnico">
                        <option value="" disabled selected>--Seleccione un tipo de equipo--</option>
                        @foreach($tecnicos as $tecnico)
                        <option value="{{$tecnico->id}}" @if(old('tecnico_id')==$tecnico->id) selected
                            @endif>{{$tecnico->nombre}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>


        <div class="card-footer float">
            <div class="float-right">
                <a href="javascript:history.back()" class="btn btn-dark"><i class="fa fa-times"></i> Cancelar </a>
                <button type="submit" class="btn btn-primary "><i class="fa fa-check"></i> Guardar</button>
            </div>
        </div>

</form>

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nueva tipo Servicio</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-group" method="POST" action="/tipo_servicios_ajax" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" id="nombreTipoServicio" name="nombre" class="form-control">
                    </div>
              <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <a role="button" onclick="agregarTipoServicio()" class="btn btn-primary text-white"><i
            class="fal fa-check"></i> Confirmar</a>


        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

@endsection
@push('scripts')
<script>

        $("#accesorio").select2({
            placeholder: "seleccione un aasdasd"
        });


</script>

<script>
    function agregarTipoServicio(){
        //tenemos que obtener el token y la descripcion
        var token = '{{csrf_token()}}';
                var nombre = $('#nombreTipoServicio').val();

        $.ajax({
            url:"/tipo_servicios_ajax",
            method:"POST",
            data: {_token:token, nombre:nombre},
            success:function(result){

                console.log(result);
                if (result[0] === "1"){
                            $('#modal-lg').modal('hide');
                            $('#nombreTipoServicio').val('');
                            var mensaje = 'TipoServicio '+ result[1]['nombre'] + 'creada con exito';
                            toastr.success(mensaje, 'Correcto');
                            $("#TipoServicio").append(new Option(String(result[1]['nombre']), result[1]['id']));
                        }else{
                            var errores ="";
                            for (let i = 0; i < result.length; i++) {
                                errores += result[i]+'\n';
                            }
                            toastr.error(errores, 'Error');
                        }
            }
        })



    }
</script>


@endpush

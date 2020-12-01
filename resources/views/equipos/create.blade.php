@extends('admin-lte.index')


@section('content')


<form class="form-group" method="POST" action="/equipos" enctype="multipart/form-data">
    @csrf
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>
                Crear Equipo
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
                    <label for="cliente" class=" col-form-label text-md-right">Clientes</label>
                    <label for="agregar_cliente">
                        <a role="button" type="button" href="{{route('clientes.create')}}" title="Nuevo Cliente"><i
                                class="fas fa-plus-circle fa-md"></i></a>
                    </label>

                    <select class="seleccion form-control" name="cliente_id" id="cliente" required>
                        <option value="" disabled selected>--Seleccione un cliente--</option>
                        @foreach($clientes as $cliente)
                        <option value="{{$cliente->id}}" @if(old('cliente_id')==$cliente->id) selected
                            @endif>{{$cliente->apellido . ' ' . $cliente->nombre}} - {{$cliente->dni}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-3">
                <div class="form-group">
                    <label for="" class=" col-form-label text-md-right">Numero Serie</label>
                    <input type="text" name="nroSerie" class="form-control" placeholder="Ingrese el numero de serie">
                </div>
            </div>

            <div class="col-3">
                <div class="form-group ">
                <label for="marca" class=" col-form-label text-md-right">Marcas</label>
                <label for="agregar_marca">
                    <!-- estamos indicando a la etiqueta a que habra el modal cuyo id es modal-lg-->
                    <a role="button" type="button" href="#" title="Nueva Marca" data-toggle="modal"
                    data-target="#modal-lg" role="button"
                    data-toggle="modal" data-target="#modal-lg"
                    ><i class="fas fa-plus-circle fa-md"></i></a>
                </label>

                <select class="seleccion form-control" name="marca_id" id="marca" required>
                    <option value="" disabled selected>--Seleccione una marca--</option>
                    @foreach($marcas as $marca)
                    <option value="{{$marca->id}}" @if(old('marca_id')==$marca->id) selected
                        @endif>{{$marca->descripcion}}</option>
                    @endforeach
                </select>
            </div>
            </div>

            <div class="col-3">
                <div class="form-group ">
                    <label for="tipo_equipo" class=" col-form-label text-md-right">Tipo Equipos</label>
                    <label for="agregar_tipo_equipo">
                        <a role="button" type="button" href="{{route('tipo_equipos.create')}}" title="Nueva Tipo Equipo"><i
                                class="fas fa-plus-circle fa-md"></i></a>
                    </label>

                    <select class="seleccion form-control" name="tipo_equipo_id" id="tipo_equipo" required>
                        <option value="" disabled selected>--Seleccione un tipo de equipo--</option>
                        @foreach($tipo_equipos as $tipo_equipo)
                        <option value="{{$tipo_equipo->id}}" @if(old('tipo_equipo_id')==$tipo_equipo->id) selected
                            @endif>{{$tipo_equipo->nombre}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
     </div>
</div>
    <div class="col-3">
        <div class="form-group">
            <label for="">Foto</label>
            <input type="file" name="foto" placeholder="Ingrese la foto del equipo">

        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="form-group ">
                <label for="nombre">Detalles Generales</label>
                <textarea name="detallesGenerales" id="detallesGenerales" cols="30" rows="5" class="form-control"
                    placeholder="Ingrese los detalles generales">{{ old('detallesGenerales') }}</textarea>
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
          <h4 class="modal-title">Nueva Marca</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-group" method="POST" action="/marcas_ajax" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="">Descripcion</label>
                        <input type="text" id="descripcionMarca" name="descripcion" class="form-control">
                    </div>
              <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <a role="button" onclick="agregarMarca()" class="btn btn-primary text-white"><i
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
    function agregarMarca(){
        //tenemos que obtener el token y la descripcion
        var token = '{{csrf_token()}}';
                var descripcion = $('#descripcionMarca').val();

        $.ajax({
            url:"/marcas_ajax",
            method:"POST",
            data: {_token:token, descripcion:descripcion},
            success:function(result){

                console.log(result);
                if (result[0] === "1"){
                            $('#modal-lg').modal('hide');
                            $('#descripcionMarca').val('');
                            var mensaje = 'Marca '+ result[1]['descripcion'] + 'creada con exito';
                            toastr.success(mensaje, 'Correcto');
                            $("#marca").append(new Option(String(result[1]['descripcion']), result[1]['id']));
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

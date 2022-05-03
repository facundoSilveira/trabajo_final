@extends('admin-lte.index')


@section('content')


<form class="form-group" method="POST" action="/recursos" enctype="multipart/form-data">
    @csrf
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>
                Crear Recurso
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
                    <label for="tipo_recurso" class=" col-form-label text-md-right">Tipo Recurso</label>
                    <label for="agregar_tipo_recurso">
                        <a role="button" type="button" href="{{route('tipo_recursos.create')}}" title="Nuevo Tipo Recurso"><i
                                class="fas fa-plus-circle fa-md"></i></a>
                    </label>

                    <select class="seleccion form-control" name="tipo_recurso_id" id="tipo_recurso" required>
                        <option value="" disabled selected>--Seleccione un tipo_recurso--</option>
                        @foreach($tipo_recursos as $tipo_recurso)
                        <option value="{{$tipo_recurso->id}}" @if(old('tipo_recurso_id')==$tipo_recurso->id) selected
                            @endif>{{$tipo_recurso->nombre}} </option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-3">
                <div class="form-group">
                    <label for="" class=" col-form-label text-md-right">Precio</label>
                    <input type="text" name="precio" class="form-control" placeholder="Ingrese el precio del recurso">
                </div>
            </div>

            <div class="col-3">
                <div class="form-group ">
                    <label for="marca" class=" col-form-label text-md-right">Marcas del Recurso</label>
                    <label for="agregar_marca">
                        <!-- estamos indicando a la etiqueta a que habra el modal cuyo id es modal-lg-->
                        <a role="button" type="button" href="#" title="Nueva Marca" data-toggle="modal"
                        data-target="#modal-lg" role="button"
                        data-toggle="modal" data-target="#modal-lg"
                        ><i class="fas fa-plus-circle fa-md"></i></a>
                    </label>

                    <select class="seleccion form-control" name="marca_recurso_id" id="marca" required>
                        <option value="" disabled selected>--Seleccione una marca--</option>
                        @foreach($marca_recursos as $marca_recurso)
                        <option value="{{$marca_recurso->id}}" @if(old('marca_recurso_id')==$marca_recurso->id) selected
                            @endif>{{$marca_recurso->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-3">
                <div class="form-group ">
                    <label for="modelo" class=" col-form-label text-md-right">Modelos</label>
                    <label for="agregar_modelo">
                        <a role="button" type="button" href="{{route('modelos.create')}}" title="Nueva Modelo"><i
                                class="fas fa-plus-circle fa-md"></i></a>
                    </label>

                    <select class="seleccion form-control" name="modelo_id" id="modelo" required>
                        <option value="" disabled selected>--Seleccione un modelo--</option>
                        @foreach($modelos as $modelo)
                        <option value="{{$modelo->id}}" @if(old('modelo_id')==$modelo->id) selected
                            @endif>{{$modelo->nombre}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group ">
                    <label for="medida" class=" col-form-label text-md-right">Medidas</label>
                    <label for="agregar_medida">
                        <a role="button" type="button" href="{{route('medidas.create')}}" title="Nueva Medida"><i
                                class="fas fa-plus-circle fa-md"></i></a>
                    </label>

                    <select class="seleccion form-control" name="medida_id" id="medida" required>
                        <option value="" disabled selected>--Seleccione una medida-</option>
                        @foreach($medidas as $medida)
                        <option value="{{$medida->id}}" @if(old('medida_id')==$medida->id) selected
                            @endif>{{$medida->nombre}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group ">
                    <label for="nombre" class=" col-form-label text-md-right">Tamaño</label>
                    <input type="text" name="tamaño" class="form-control" id="tamaño" placeholder="Ingrese el tamaño"{{ old('tamaño')}}>
                </div>
            </div>

            <div class="col-4">
                <div class="form-group ">
                    <label for="nombre" class=" col-form-label text-md-right">Stock Minimo</label>
                    <input type="text" name="stockMinimo" id="stockMinimo" class="form-control" placeholder="Ingrese el stock minimo del recurso" {{old('stockMinimo')}}>
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
          <h4 class="modal-title">Nueva Marca</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-group" method="POST" action="/marcas_ajax" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" id="descripcionMarca" name="nombre" class="form-control">
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
                var nombre = $('#nombreMarca').val();

        $.ajax({
            url:"/marcas_ajax",
            method:"POST",
            data: {_token:token, nombre:nombre},
            success:function(result){

                console.log(result);
                if (result[0] === "1"){
                            $('#modal-lg').modal('hide');
                            $('#nombreMarca').val('');
                            var mensaje = 'Marca '+ result[1]['nombre'] + 'creada con exito';
                            toastr.success(mensaje, 'Correcto');
                            $("#marca").append(new Option(String(result[1]['nombre']), result[1]['id']));
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

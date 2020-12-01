@extends('admin-lte.index')


@section('content')


<form class="form-group" method="POST" action="/movimientos" enctype="multipart/form-data">
@csrf
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>
                Cabecera de movimiento
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
        <div class="row">
            <div class="col-3">
                <div class="form-group ">
                    <label for="proveedores" class=" col-form-label text-md-right">Proveeores</label>
                    <label for="agregar_proveedor">
                        <a role="button" type="button" href="{{route('proveedores.create')}}" title="Nuevo Proveedor"><i
                                class="fas fa-plus-circle fa-md"></i></a>
                    </label>

                    <select class="form-control" name="proveedor_id"  id="proveedor" required>
                        @foreach($proveedors as $proveedor)
                        <option value="{{$proveedor->id}}" @if(old('proveedor_id')==$proveedor->id) selected
                            @endif>{{$proveedor->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-2">
                <div class="form-group ">
                    <label for="tipoComprobante" class=" col-form-label text-md-right">Tipo Comprobante</label>
                    <label for="agregar_tipoComprobante">
                        <a role="button" type="button" href="{{route('tipo_comprobantes.create')}}" title="Nuevo Tipo comprobante"><i
                                class="fas fa-plus-circle fa-md"></i></a>
                    </label>

                    <select class="form-control" name="tipo_comprobante_id"  id="tipo_comprobante" required>
                        @foreach($tipo_comprobantes as $tipo_comprobante)
                        <option value="{{$tipo_comprobante->id}}" @if(old('tipo_comprobante_id')==$tipo_comprobante->id) selected
                            @endif>{{$tipo_comprobante->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-2">
                <div class="form-group ">
                    <label for="tipo_movimiento" class=" col-form-label text-md-right">tipo movimiento</label>
                    <label for="agregar_tipo_movimiento">
                        <a role="button" type="button" href="{{route('tipo_movimientos.create')}}" title="tipo movimiento"><i
                                class="fas fa-plus-circle fa-md"></i></a>
                    </label>

                    <select class="form-control" name="tipo_movimiento_id"  id="tipo_movimiento" required>
                        @foreach($tipo_movimientos as $tipo_movimiento)
                        <option value="{{$tipo_movimiento->id}}" @if(old('tipo_movimiento_id')==$tipo_movimiento->id) selected
                            @endif>{{$tipo_movimiento->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-2">
                    <div class="form-group">
                        <label for="">Fecha</label>
                        <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}"class="form-control"
                        placeholder="Ingrese el fecha ">
                    </div>
            </div>



            <div class="col-2">
                <div class="form-group">
                    <label for="">Fecha Comprobante</label>
                    <input type="date" name="fechaComprobante" id="fechaComprobante" value="{{ old('fechaComprobante') }}"class="form-control"
                    placeholder="Ingrese el fecha del comprobante">
                </div>
            </div>



            <div class="col-2">
                <div class="form-group">
                    <label for="">Nro Comprobante</label>
                    <input type="text" name="numeroComprobante" id="numeroComprobante" value="{{ old('nroComprobante') }}" class="form-control"
                    placeholder="Ingrese el numero del comprobante">
                </div>
            </div>
        </div>

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>
                Movimiento
            </h5>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="form-group ">
                    <label for="recurso" class=" col-form-label text-md-right">Recurso</label>
                    <label for="agregar_recurso">
                        <a role="button" type="button" href="{{route('recursos.create')}}" title="Recurso"><i
                                class="fas fa-plus-circle fa-md"></i></a>
                    </label>

                    <select class="form-control" name="recur"  id="recurso_id" >
                        @foreach($recursos as $recurso)
                        <option value="{{$recurso->id}}" @if(old('recurso_id')==$recurso->id) selected
                            @endif>{{$recurso->tipo_recurso->nombre}} {{$recurso->modelo->nombre}} {{$recurso->tamaño}} {{$recurso->medida->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>



            <div class="col-2">
                <div class="form-group">
                    <label for="">Cantidad</label>
                    <input type="text" name="cant" id="cantidad_id" value="{{ old('cantidad') }}"class="form-control"
                    placeholder="Ingrese la cantidad de recursos">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="">Precio</label>
                    <input type="text" name="preciso" id="precio_id" value="{{ old('precio') }}"class="form-control"
                    placeholder="Ingrese la precio del recursos">
                </div>
            </div>
            <div class="col-2 mt-4 pt-2">
                <button type="button" class="btn btn-primary btn-sm " id="addRow"><i class="fa fa-check"></i> </button>
            </div>
         </div>

        <div class="card-body">
            <table class="table table-borderless table-dark">
                <thead>
                <tr>


                    <th scope="col">Recurso</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Accion</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

        <div class="card-footer float">
            <div class="float-right">
                <a href="javascript:history.back()" class="btn btn-dark"><i class="fa fa-times"></i> Cancelar </a>
                <button type="submit" class="btn btn-primary "><i class="fa fa-check"></i> Guardar</button>
            </div>
        </div>

</form>


@endsection
@push('scripts')
<script>
    $('#addRow').on('click',function(){
    addRow();
    });

    function addRow(){
        //Obtener los valores de los inputs
        recurso_select_id = $('#recurso_id').val() ;
        recurso = $("#recurso_id option:selected").text();
        cantidad = $("#cantidad_id").val();
        precio = $("#precio_id").val();
        console.log(precio);
        if(recurso_select_id != null ){
            if(cantidad > 0){
                    var fila = '<tr> <td><input type="hidden" name="recurso[]" value="'+recurso_select_id+'">'+recurso+'</td>'+
                                '<td style="text-align:right;"><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+' </td>'+
                                '<td style="text-align:right;"><input type="hidden" name="precio[]" value="'+precio+'">'+precio+' </td>'+
                                '<td style="text-align:center;"><a href="#" class="btn btn-danger btn-xs remove"><i class="fas fa-minus"></i></a></td>' +
                                '</tr>' ;

                    $('tbody').append(fila) ;
                    limpiar();
                    if (fila = null){
                        console.error(error);
                    }
            }else{
                swal({
                        title: "Error",
                        text: "Ingrese una cantidad valida y mayor a 0",
                        icon: "error",
                    });
            }
        }else{
            swal({
                        title: "Error",
                        text: "Seleccione un producto",
                        icon: "error",
                    });
        }

    }

    function limpiar(){
        $("#cantidad_id").val("");
        $("#recurso_id").val(null).trigger("change");
        $("#precio_id").val("");

    }

    $('body').on('click', '.remove',function(){
        // var last=$('tbody tr').length;
        // if(last==1){
        //     alert("No es posible eliminar la ultima fila");
        // }
        // else{
            $(this).parent().parent().remove();
        //}

    });

</script>

@endpush

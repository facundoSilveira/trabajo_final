@extends('admin-lte.index')


@section('content')


<form class="form-group" method="POST" action="/informes" enctype="multipart/form-data">
@method('post')
@csrf
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>
                informes
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
            <div class="row ">
                <input type="hidden" name="servicio_id" id="" value="{{$id}}" class="form-control">


                <div class="col-6">
                    <div class="form-group ">
                        <label for="tipo_servicio"  class=" col-form-label text-md-right">Problema Tecnico</label>
                        {{-- <input type="text" name="problemaTecnico" value="" placeholder="Por favor describa el problema tecnico"> --}}
                        <label for="agregar_tipo_servicio">
                            <!-- estamos indicando a la etiqueta a que habra el modal cuyo id es modal-lg-->
                            <i title="Precios" id="popover" onclick="milagro()" class="fas fa-question-circle"
                                    data-content="">
                                </i>
                            <a role="button" type="button" href="#" title="Nuevo tipo servicio" data-toggle="modal"
                            data-target="#modal-lg" role="button"
                            data-toggle="modal" data-target="#modal-lg"
                            ><i class="fas fa-plus-circle fa-md"></i></a>
                        </label>

                        <select class="seleccion form-control" name="tipo_servicio_id[]" id="tipo_servicio" multiple required>
                            {{-- <option value="" disabled selected>--Seleccione un tipo_servicio--</option> --}}
                            <script>
                                var tipoServicios = []
                            </script>
                            @foreach($tipo_servicios as $tipo_servicio)
                            <script>
                                tipoServicios.push('{{$tipo_servicio->nombre}} ${{$tipo_servicio->precio}}')
                            </script>
                                @if($servicio->tipos->contains('tipo_servicio_id', $tipo_servicio->id) )
                                    <option value="{{$tipo_servicio->id}}" selected>{{$tipo_servicio->nombre}} </option>
                                @else
                                    <option value="{{$tipo_servicio->id}}">{{$tipo_servicio->nombre}} </option>
                                @endif
                            @endforeach
                            @foreach ($tipo_servicios as $tipo_servicio )
                            <input type="hidden" name="valorPrecio" id="{{$tipo_servicio->id}}" value="{{$tipo_servicio->precio}}">
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="hidden" name="subtotal" id="subtotal" value="{{$servicio->getPrecio()}}">
                <div class="col-4">
                    <div class="form-group">
                        <label for="" class=" col-form-label text-md-right">Descripción</label>
                        <textarea type="text" name="descripcion" id="Descripcion" value="{{ old('Descripcion') }}" class="form-control"
                        placeholder="Ingrese el numero del comprobante"></textarea>
                    </div>
                </div>
        </div>
        </div>

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>
                Recursos a utilizar
            </h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <div class="form-group ">
                        <label for="recurso" class=" col-form-label text-md-right">Recurso</label>
                        <label for="agregar_recurso">
                            <i title="Precios" id="popover2"  class="fas fa-question-circle"
                            data-content="">
                             </i>
                            <a role="button" type="button" href="{{route('recursos.create')}}" title="Recurso"><i
                                    class="fas fa-plus-circle fa-md"></i></a>
                        </label>
                        <script>var precioRecurso=[]</script>
                        <select class="form-control" name="recur"  id="recurso_id" >
                            @foreach($recursos as $recurso)
                            <script>
                                precioRecurso.push('{{$recurso->tipo_recurso->nombre}} ${{$recurso->precio}}')
                            </script>
                                <option value="{{$recurso->id}}" @if(old('recur')==$recurso->id) selected
                                @endif>{{$recurso->tipo_recurso->nombre}} {{$recurso->modelo->nombre}} {{$recurso->tamaño}} {{$recurso->medida->nombre}}</option>
                            @endforeach
                        </select>
                        @foreach($recursos as $recurso)
                        <input type="hidden" name="valorRecurso" id="recurso{{$recurso->id}}" value="{{$recurso->precio}}">
                        @endforeach
                    </div>
                </div>



                <div class="col-2">
                    <div class="form-group">
                        <label for="" class=" col-form-label text-md-right">Cantidad</label>
                        <input type="text" name="cant" id="cantidad_id" value="{{ old('cant') }}"class="form-control"
                        placeholder="Ingrese la cantidad de recursos">
                    </div>
                </div>

                <div class="col-2 mt-4 pt-2">
                    <button type="button" class="btn btn-primary btn-sm " id="addRow"><i class="fa fa-check"></i> </button>
                </div>
             </div>
        </div>

        <div class="card-body">
            <table class="table table-borderless table-dark">
                <thead>
                <tr>


                    <th scope="col">Recurso</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Acción</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <br>
            <div class="row float-right">
                <label for="">Presupuesto $</label>
                <div class="col-8">
                    <div class="form-group">
                        <input type="text" name="presupuesto" id="presupuesto" readonly value="" class="form-control"
                        placeholder="presupuesto">
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


@endsection
@push('scripts')
<script>
    $( document ).ready(function(){
        $("#tipo_servicio").select2({
            placeholder: "seleccione un tipo de servicio"
        });

    })

    function milagro(){
        var contenidoPopover = '<ul>'
        console.log(tipoServicios)
        tipoServicios.map((tipo)=> {
            contenidoPopover += '<li>'+tipo+'</li>'
        })
        contenidoPopover += '</ul>'
         $(function () {
                $('#popover').popover({
                    html:true,
                    content: contenidoPopover
                });

            })
    }

    var contenidoPopover = '<ul>'

        precioRecurso.map((recurso)=> {
            contenidoPopover += '<li>'+recurso+'</li>'
        })
        contenidoPopover += '</ul>'
         $(function () {
                $('#popover2').popover({
                    html:true,
                    content: contenidoPopover
                });

            })

</script>
<script>
    $(document).ready( function (){
        subtotal = $('#subtotal').val()
        $('#presupuesto').val(subtotal)

    })

    $('#tipo_servicio').change(function () {
        tiposServicios = $('#tipo_servicio').val()
        subtotal = 0
        if(tiposServicios.length == 0 ){
            $('#presupuesto').val(0)
        }
        tiposServicios.map((tipo) => {
            precio = $('#'+tipo).val()
            subtotal += parseFloat(precio)
            $('#presupuesto').val(subtotal)
        })
    })
</script>
<script>
    $('#addRow').on('click',function(){
    addRow();
    });

    function addRow(){
        //Obtener los valores de los inputs
        recurso_select_id = $('#recurso_id').val() ;
        recurso = $("#recurso_id option:selected").text();
        cantidad = $("#cantidad_id").val();

        console.log(cantidad);
        if(recurso_select_id != null ){
            if(cantidad > 0){
                    var fila = '<tr> <td><input type="hidden" name="recurso[]" value="'+recurso_select_id+'">'+recurso+'</td>'+
                                '<td style="text-align:right;"><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+' </td>'+

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

        total = 0
        subtotal = $('#presupuesto').val()
        console.log('recurso '+ recurso_select_id)
        precioProducto = $('#recurso'+recurso_select_id).val()
        console.log('preico prod ' + precioProducto )
        total += parseFloat(subtotal) + parseFloat(precioProducto * cantidad)
        $('#presupuesto').val(total)

    }

    function limpiar(){
        $("#cantidad_id").val("");
        $("#recurso_id").val(null).trigger("change");


    }

    $('body').on('click', '.remove',function(){
        // var last=$('tbody tr').length;
        // if(last==1){
        //     alert("No es posible eliminar la ultima fila");
        // }
        // else{


            total = total - (precioProducto * cantidad)
            $('#presupuesto').val(total)
            $(this).parent().parent().remove();
        //}

    });

</script>

@endpush

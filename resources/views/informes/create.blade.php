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
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label for="">Presupuesto</label>
                    <input type="text" name="presupuesto" id="presupuesto" value="{{ old('presupuesto') }}" class="form-control"
                    placeholder="presupuesto">
                </div>
            </div>
            <input type="hidden" name="servicio_id" id="" value="{{$id}}" class="form-control">


            <div class="col-2">
                <div class="form-group">
                    <label for="">Problema Tecnico</label>
                    <input type="text" name="problemaTecnico" id="problemaTecnico" value="{{ old('problemaTecnico') }}" class="form-control"
                    placeholder="Ingrese el numero del comprobante">
                </div>
            </div>

            <div class="col-2">
                <div class="form-group">
                    <label for="">Descripcion</label>
                    <input type="text" name="descripcion" id="Descripcion" value="{{ old('Descripcion') }}" class="form-control"
                    placeholder="Ingrese el numero del comprobante">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="">Fecha Inicio</label>
                    <input type="date" name="fechaInicio" id="fechaInicio" value="{{ old('fechaInicio') }}"class="form-control"
                    placeholder="Ingrese el fecha ">
                </div>
            </div>

            <div class="col-2">
                <div class="form-group">
                    <label for="">Fecha Fin</label>
                    <input type="date" name="fechaFin" id="fechaFin" value="{{ old('fechaFin') }}"class="form-control"
                    placeholder="Ingrese el fecha ">
                </div>
            </div>


    </div>


    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5>
                Recursos a utilizar
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
                        <option value="{{$recurso->id}}" @if(old('recur')==$recurso->id) selected
                            @endif>{{$recurso->tipo_recurso->nombre}} {{$recurso->modelo->nombre}} {{$recurso->tamaño}} {{$recurso->medida->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>



            <div class="col-2">
                <div class="form-group">
                    <label for="">Cantidad</label>
                    <input type="text" name="cant" id="cantidad_id" value="{{ old('cant') }}"class="form-control"
                    placeholder="Ingrese la cantidad de recursos">
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
            $(this).parent().parent().remove();
        //}

    });

</script>

@endpush

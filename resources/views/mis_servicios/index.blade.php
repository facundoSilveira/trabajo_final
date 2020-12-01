@extends('admin-lte.index')

@section('content')
<div class="card">
    <div class="card-header">Servicio
        <a class="btn btn-primary btn-sm float-right text-white" href="{{route('servicios.create')}}">Nuevo</a>

    </div>

    <div class="card-body">
        <!-- Filtros -->
        <div class="mt-1 mr-1">
            <div class="float-right">
              <button title="Desplegar filtros" data-toggle="collapse" data-target="#demo" class="btn primary bg-light"><i
                  class="fas fa-filter"></i></button>
            </div>
            <div class="ml-1">
              <div id="demo" class="collapse">
                <div class="row">
                  <div class="col-md-2">
                    <label for="desde" class="col-form-label text-md-right">Desde</label>
                    <input type="date" id="desde" class="form-control" data-inputmask-alias="datetime"
                      data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" placeholder="dd/mm/yyyy">
                  </div>
                  <div class="col-md-2">
                    <label for="hasta" class="col-form-label text-md-right">Hasta</label>
                    <input type="date" id="hasta" class="form-control" data-inputmask-alias="datetime"
                      data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" placeholder="dd/mm/yyyy">
                  </div>
                  <div class="col-md-3">
                    <label for="prioridades" class=" col-form-label text-md-right">prioridades</label>
                    <select class="select2bs4 select2-hidden-accessible" multiple=""
                      data-placeholder="Seleccione prioridad" style="width: 100%;" aria-hidden="true" id="prioridades">
                      @foreach ($prioridades as $prioridad)
                      <option value="{{$prioridad->nombre}} ">{{ $prioridad->nombre}}  </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label for="estados" class=" col-form-label text-md-right">estados</label>
                    <select class="select2bs4 select2-hidden-accessible" multiple=""
                      data-placeholder="Seleccione estados" style="width: 100%;" aria-hidden="true"
                      id="estados">
                      @foreach ($estados as $estado)
                      <option value="{{$estado->nombre}}">{{ $estado->nombre}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-1">
                    <label for="" class="col-form-label text-md-right text-white">Filtro</label>
                    <button id="filtrar" type="button" class="btn btn-dark">Filtrar</button>
                  </div>
                </div>
              </div>
            </div>
        </div>



        <input type="hidden" id="filtros" value="Ningún filtro aplicado.">
        <table class="table table-borderless table-dark dataTable">
            <thead>
            <tr>



                <th scope="col">Estado</th>
                <th scope="col">Priridad</th>
                <th scope="col">fecha recibida</th>
                <th scope="col">Tipo servicio</th>
                <th scope="col">contraseña</th>
                <th scope="col">Opciones</th>

            </tr>
            </thead>
            <tbody>
                @foreach ($servicios as $servicio)
                <tr>

                    <td>{{$servicio->getEstado()}}</td>
                    <td>{{$servicio->prioridad->nombre}}</td>
                    <td>{{ \Carbon\Carbon::create($servicio->fechaRecibida)->format('d/m/Y')}}</td>
                    <td>{{$servicio->tipo_servicio->nombre}}</td>
                    <td>{{$servicio->contraseña}}</td>


                    <td class="text-right">
                        @if ($servicio->getEstado() == "En Espera")
                        <a class="btn btn-outline-light btn-sm" href="{{ route('show_servicio_espera', $servicio->informe) }}">show </a>

                        @endif
                        <a class="btn btn-outline-light btn-sm" href="{{ route('ver_servicio', $servicio->id) }}">Ver </a>

                    </td>
                </tr>
                @endforeach



            </tbody>
        </table>
    </div>
</div>



@endsection
@push('scripts')
<!-- Primer script (inicializacion de inputs de fecha) -->
<script>
    $(function () {
      //Datemask dd/mm/yyyy
      $('#desde').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
      $('#hasta').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy' });
      $('.select2bs4').select2({
          theme: 'bootstrap4'
      });
      document.getElementById("desde").max = new Date().toISOString().split("T")[0];
      document.getElementById("hasta").max = new Date().toISOString().split("T")[0];

      $("#desde").change(function () {
        var fecha = $(this).val();
        document.getElementById("hasta").min = fecha;
      });
      $("#hasta").change(function () {
        var fecha = $(this).val();
        document.getElementById("desde").max = fecha;
      });
      })
  </script>

  <!-- Filtros -->
  <script>
    $(document).ready(function () {
      var table = $('#tabla').DataTable();

      //un boton con id filtrar
      $('#filtrar').click(function () {


        //aca se obtienen los valores
        var filtro3 = [];
        filtro3 = $('#prioridades').val();

        var filtro4 = [];
        filtro4 = $('#estados').val();

        var filtro1 = $('#desde').val();
        var filtro1Titulo = moment(filtro1).format('DD/MM/YYYY');
        if (filtro1 != "") {
          filtro1 = moment(filtro1).format('YYYYMMDD');
        }

        var filtro2 = $('#hasta').val();
        var filtro2Titulo = moment(filtro2).format('DD/MM/YYYY');
        if (filtro2 != "") {
          filtro2 = moment(filtro2).format('YYYYMMDD');
        }

        //no olvidarme de volver a poner (pop) las filas
        //esto es por si se realizo algun filtro asi se vuelve a cargar el datatable

        $.fn.dataTable.ext.search.pop(
          function (settings, data, dataIndex) {
            if (1) {
              return true;
            }
            return false;
          }
        );
        table.draw();

        if (filtro3 != "") {
          var prioridades = filtro3;
          console.log(prioridades);
        }
        if (filtro4 != "") {
          var estados = filtro4;
          console.log(estados);
        }
        if (filtro1 != "") {
          var desde = filtro1;
          console.log(desde);
        }
        if (filtro2 != "") {
          var hasta = filtro2;
          console.log(hasta);
        }
        filtros = "";
        if (filtro1 == "" && filtro2 == "" && filtro3 == "" && filtro4 == "") {
          console.log('filtro 0');
          var filtros = "Ningún filtro aplicado.";
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            if (true) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        if (filtro1 != "" && filtro2 == "" && filtro3 == "" && filtro4 == "") {
          console.log('filtro 1');
          var filtros = "F. desde: " + filtro1Titulo+".";
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (desde <= newdate1) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }

        else if (filtro1 != "" && filtro2 != "" && filtro3 == "" && filtro4 == "") {
          console.log('filtro 2');
          var filtros = "F. desde: " + filtro1Titulo+" y F. hasta: " + filtro2Titulo;
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (desde <= newdate1 && hasta >= newdate1) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }

        else if (filtro1 != "" && filtro2 != "" && filtro3 != "" && filtro4 == "") {
          console.log('filtro 3');
          var filtros = "F. desde: " + filtro1Titulo+", F. hasta: " + filtro2Titulo +" y prioridades: "+String(filt1o3);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (desde <= newdate1 && hasta >= newdate1 && prioridades.includes(data[1])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 != "" && filtro2 != "" && filtro3 != "" && filtro4 != "") {
          console.log('filtro 4');
          var filtros = "F. desde: " + filtro1Titulo+", F. hasta: " + filtro2Titulo +", prioridades: "+String(filtro3) +" y Estados: "+ String(filtro4);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (desde <= newdate1 && hasta >= newdate1 && prioridades.includes(data[1]) && estados.includes(data[0])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 == "" && filtro2 != "" && filtro3 != "" && filtro4 != "") {
          console.log('filtro 5');
          var filtros = "F. hasta: "+filtro2Titulo+", prioridades: "+String(filtro3)+" y Estados: "+String(filtro4);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (hasta >= newdate1 && prioridades.includes(data[1]) && estados.includes(data[0])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 == "" && filtro2 != "" && filtro3 == "" && filtro4 != "") {
          console.log('filtro 6');
          var filtros = "F. hasta: "+filtro2Titulo+" y Estados: "+String(filtro4);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (hasta >= newdate1 && estados.includes(data[0])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 == "" && filtro2 != "" && filtro3 == "" && filtro4 == "") {
          console.log('filtro 7');
          var filtros = "F. hasta: "+filtro2Titulo+".";
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (hasta >= newdate1) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }

        else if (filtro1 == "" && filtro2 == "" && filtro3 != "" && filtro4 != "") {
          console.log('filtro 8');
          var filtros = "prioridades: "+String(filtro3)+" y Estados: "+String(filtro4);
          console.log(filtros);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            if (prioridades.includes(data[1]) && Estados.includes(data[0])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 == "" && filtro2 == "" && filtro3 != "" && filtro4 == "") {
          console.log('filtro 9');
          var filtros = "prioridades: "+String(filtro3);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            if (tecnicos.includes(data[1])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 != "" && filtro2 == "" && filtro3 != "" && filtro4 == "") {
          console.log('filtro 10');
          var filtros = "F. desde: " + filtro1Titulo+"y prioridades: "+String(filtro3)+".";
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (desde <= newdate1 && prioridades.includes(data[1])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 == "" && filtro2 != "" && filtro3 != "" && filtro4 == "") {
          console.log('filtro 11');
          var filtros = "F. hasta: "+filtro2Titulo+"y prioridades: "+String(filtro3)+".";
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (hasta >= newdate1 && prioridades.includes(data[1])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }

        else if (filtro1 == "" && filtro2 == "" && filtro3 == "" && filtro4 != "") {
          console.log('filtro 12');
          var filtros = "Estados: "+String(filtro4)+".";
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            if (estados.includes(data[0])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 != "" && filtro2 == "" && filtro3 == "" && filtro4 != "") {
          console.log('filtro 13');
          var filtros = "F. desde: "+filtro1Titulo+" y Estados: "+String(filtro4);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (desde <= newdate1 && estados.includes(data[0])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 != "" && filtro2 != "" && filtro3 == "" && filtro4 != "") {
          console.log('filtro 14');
          var filtros = "F. desde: " + filtro1Titulo+", F. hasta: " + filtro2Titulo +" y Estados: "+String(filtro4);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (desde <= newdate1 && hasta >= newdate1 && estados.includes(data[0])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 != "" && filtro2 == "" && filtro3 != "" && filtro4 != "") {
          console.log('filtro 15');
          var filtros = "F. desde: " + filtro1Titulo+", prioridades: " + String(filtro3) +" y Estados: "+String(filtro4);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (desde <= newdate1 && prioridades.includes(data[1]) && estados.includes(data[0])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()



        }
        $('#filtros').val(String(filtros));

      });
    });
  </script>
@endpush




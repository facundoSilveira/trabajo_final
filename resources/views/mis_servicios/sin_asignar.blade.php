@extends('admin-lte.index')

@section('content')
<div class="card">
    <div class="card-header">Servicio
        <a class="btn btn-primary btn-sm float-right text-white" href="{{route('servicios.create')}}">Nuevo</a>

    </div>

    <div class="card-body">



        <table class="table table-bordered table-dark" id="tabla">
            <thead>
            <tr>


                <th scope="col">Tipo servicio</th>
                <th scope="col">Priridad</th>
                <th scope="col">Fecha Recibida</th>
                <th scope="col">Estado</th>
                <th scope="col">Tecnico</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Opciones</th>

            </tr>
            </thead>
            <tbody>
                @foreach ($servicios as $servicio)
                <tr>
                    <td>
                        @foreach ($servicio->tipos as $tipo )
                            {{$tipo->tipo->nombre}}
                        @endforeach
                    </td>
                    <td>{{$servicio->prioridad->nombre}}</td>
                    <td class="text-right">{{ \Carbon\Carbon::create($servicio->fechaRecibida)->format('d/m/Y')}}</td>
                    <td>{{$servicio->getEstado()}}</td>
                    <td>
                        @if($servicio->tecnico == null)
                        <span class="badge badge-secondary">Sin Asignar</span>
                        @else
                        <span class="badge badge-info">{{$servicio->tecnico->nombre}} {{$servicio->tecnico->apellido}}</span>
                        @endif
                    </td>
                    <td>{{$servicio->contraseña}}</td>


                    <td class="text-right">
                        <a class="btn btn-light btn-sm" href="{{ route('servicios.edit', $servicio->id) }}">Editar</a>
                        <a class="btn btn-danger btn-sm text-white delete" val-palabra={{$servicio->id}}>Borrar</a>
                        <a class="btn btn-outline-light btn-sm" href="{{ route('servicios.show', $servicio->id) }}">Ver mas</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="confirmDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Confirmacion</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">¿Esta seguro que desea borrarlo?</h4>
            </div>
            <div class="modal-footer">
                <form id="formDelete" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    {{-- Paso el id del servicio a borrar --}}
                    <button type="submit" name="ok_delete" id="ok_delete" class="btn btn-danger">SI Borrar</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">NO Borrar</button>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

{{-- Script para eliminar --}}
<script>
    $(document).on('click', '.delete', function(){
    id = $(this).attr('val-palabra');

    url2="{{route('servicios.destroy',":id")}}";
    url2=url2.replace(':id',id);

    $('#formDelete').attr('action',url2);
    $('#confirmDelete').modal('show');
    });

    $('#formDelete').on('submit',function(){
    $('#ok_delete').text('Eliminando...')
    });
</script>

<!--Datatable con reportes -->
<script>
    $(function () {
          $("#tabla").DataTable({
            "responsive": true,
            "autoWidth": false,
            "lengthChange": true,
            "ordering": true,
            buttons: [
              'copy', 'csv', 'excel',
              {
                extend: 'pdfHtml5',
                className: 'btn btn-secondary buttons-pdf buttons-html5',
                text: 'PDF',
                filename: 'servicios_pdf',
                orientation: 'portrait', //landscape
                pageSize: 'A4', //A3 , A5 , A6 , legal , letter


                customize: function (doc) {
                  //quitamos el titulo por defecto del pdfhtml5 eliminando el primer elemento del pdf que esta en el array content.
                  doc.content.splice(0, 1);
                  //Fecha para usar en el reporte mas adelante
                  var now = new Date();
                  var jsDate = now.getDate() + '/' + (now.getMonth() + 1) + '/' + now.getFullYear();

                  //Para poner una imagen hay que convertirla a Base64 con esta pagina se puede:
                  // http://codebeautify.org/image-to-base64-converter


                  //#region aca esta el logo en base64 (expandir, es muy largo xd)
                  var logo = '{{$configuracion->getImagenReporte64()}}'
;
                  //#endregion


                  // Ahora establecemos los margenes: [left,top,right,bottom] o [horizontal,vertical]
                  // si ponemos solo un numero se establece ese mismo para todos los margenes
                  doc.pageMargins = [60, 135, 20, 50];

                  // Tamaño de fuente de todo el documento
                  doc.defaultStyle.fontSize = 10;
                  // Tamaño de fuente del encabezado
                  doc.styles.tableHeader.fontSize = 12;

                  //Al elemento 0 (porque borre el titulo al principio) del contenido o sea la tabla
                  //lo centramos forzadamente
                  //doc.content[0].margin = [100, 0, 100, 0]

                  // Para personalizar el encabezado:
                  // Creamos un encabezado con 3 columnas
                  // A la izquierdalogo
                  // En el medio: Titulo
                  // A la derecha: algo xd

                  //El titulo lo saco de un input oculto para poder usar esta misma configuracion para reportes distintos, entonces cambia el titulo segun el reporte.
                  var titulo = 'Listado de servicios ';
                  var autor_reporte = 'yo';
                  filtros = String($('#filtros').val());

                  var titulo_header = "Reportes " + '{{$configuracion->nombre}}'
                  var direccion_header = "{{$configuracion->direccion}}"
                  var contacto_header = "Teléfono: " + '{{$configuracion->telefono}}'

                  doc['header'] = (function () {
                    return {
                      columns: [
                        {
                          image: logo,
                          width: 70,
                          margin: [-10, -10, 10, 0]
                        },
                        // {
                        //   alignment: 'left',
                        //   fontSize: 10,
                        //   text: [
                        //     { text: titulo + " \n", bold: true, fontSize: 12 },
                        //     { text: 'Filtros' + "\n", fontSize: 10 },
                        //     { text: filtros + "\n" },
                        //   ],
                        //   width: 100,
                        //   margin: [-30, 100, 0, 0],
                        //   alignment: 'left'
                        // },
                        {
                          alignment: 'center',
                          text: [
                            { text: titulo_header + " \n", bold: true, fontSize: 16 },
                            { text: direccion_header + " \n" },
                            { text: contacto_header + "\n \n \n \n" },
                            { text: titulo + " \n", bold: true, fontSize: 12, alignment: 'left' },
                            { text: filtros, fontSize: 10, alignment: 'left' },
                          ],
                          fontSize: 10,
                          margin: [-28, 10, 0, 10]
                        },
                        {
                          alignment: 'right',
                          fontSize: 10,
                          text: ['Fecha: ', { text: jsDate.toString() }, { text: '\n Autor: ' + autor_reporte, bold: true, fontSize: 11 }],
                          width: 75,
                          margin: [0, 10, 0, 0],
                          alignment: 'left'
                        }
                      ],
                      margin: [20, 10, 20, 20]
                    }
                  });

                  //Funcion que pone cada columna en tamaño *, para que se ajuste automagicamente. cuenta cada <td> del data table y genera array del tipo [*,*,*,..,n] y establece dicho array como width.
                  var colCount = new Array();
                  $("#tabla").find('tbody tr:first-child td').each(function () {
                    if ($(this).attr('colspan')) {
                      for (var j = 1; j <= $(this).attr('colspan'); $j++) {
                        colCount.push('*');
                      }
                    } else { colCount.push('*'); }
                  });
                  //console.log(colCount);
                  colCount.push('*'); //Le pongo uno mas porque tengo un td oculto (el id)

                  //doc.content[0].table.widths = colCount;

                  //Es equivalente a:
                  doc.content[0].table.widths = [120, 60, 80, 70, 110];

                  //Obtenemos la cantidad de filas y le damos la orientacion (izquierda, centro, derecha) que queremos
                  var rowCount = document.getElementById("tabla").rows.length;
                  for (i = 1; i < rowCount; i++) {
                    doc.content[0].table.body[i][0].alignment = 'left';
                    doc.content[0].table.body[i][1].alignment = 'left';
                    doc.content[0].table.body[i][2].alignment = 'right';
                    doc.content[0].table.body[i][3].alignment = 'left';
                    doc.content[0].table.body[i][4].alignment = 'left';

                  };


                  // Para personalizar el pie de pagina:
                  // Creamos un objeto de pie de pagina con dos columnas
                  // Lado izquierdo: Fecha de creacion del reporte
                  // Lado derecho: pagina actual y total de pagina
                  doc['footer'] = (function (page, pages) {
                    return {
                      columns: [{
                        alignment: 'left',
                        text: ['Fecha de Generación: ', { text: jsDate.toString() }]
                      },
                      {
                        alignment: 'right',
                        text: ['Página ', { text: page.toString() }, ' de ', { text: pages.toString() }]
                      }
                      ],
                      margin: 20
                    }
                  });

                  // Change dataTable layout (Table styling)
                  // To use predefined layouts uncomment the line below and comment the custom lines below
                  // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                  var objLayout = {};
                  objLayout['hLineWidth'] = function (i) { return .7; };
                  objLayout['vLineWidth'] = function (i) { return .7; };
                  objLayout['hLineColor'] = function (i) { return '#cdcdcd'; };
                  objLayout['vLineColor'] = function (i) { return '#cdcdcd'; };
                  objLayout['paddingLeft'] = function (i) { return 4; };
                  objLayout['paddingRight'] = function (i) { return 4; };
                  objLayout['paddingTop'] = function (i) { return 6; };
                  objLayout['paddingBottom'] = function (i) { return 6; };
                  doc.content[0].layout = objLayout;
                },
                exportOptions: {
                  columns: [0,1,2,3,4]
                }
              }
            ],
            dom: 'lrfBtip',
            language: {
              "sProcessing": "Procesando...",
              "sLengthMenu": "Ver _MENU_",
              "sZeroRecords": "No se encontraron resultados",
              "sEmptyTable": "Todavía no se registraron pagos",
              "sInfo": "Mostrando del _START_ al _END_ de _TOTAL_",
              "sInfoEmpty": "Mostrando  del 0 al 0 de de 0 ",
              "sInfoFiltered": "(filtrado de _MAX_ registros)",
              "sInfoPostFix": "",
              "sSearch": "Buscar:",
              "sUrl": "",
              "sInfoThousands": ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Sig",
                "sPrevious": "Ant"
              },
              "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              },
              "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
              }
            }
          });

$('#tabla_length').css({
          'position': 'absolute'
});

$('.dt-buttons').css({
          'position': "relative",
  'display': "-ms-inline-flexbox",
  'display': "block",
  'vertical-align': "middle",
  'text-align':" right"
});
});
  </script>

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



@endpush

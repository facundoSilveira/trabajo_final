<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>PCshop Apostoles</title>
  </head>
  <body>
    @if ($informe->servicio->getEstado() != "En Espera")
    <div class="content-fluid">
        <div class="row  justify-content-center">
            <div class="col-md-10">
                <div class="card card-primary card-outline">

                    <div class="card-body box-profile">
                        <div class="text-center">
                            <h3 class="profile-username text-center">Equipo: {{$informe->servicio->equipo->tipo_equipo->nombre}} </h3>
                            <p class="text-muted">Numero de Serie: <span class="badge badge-info"><i class="fal fa-num nav-icon"></i>{{$informe->servicio->equipo->nroSerie}}</span></p>

                                <img style="height: 300px; width: 300px; background-color: #EFEFEF; margin: 0px;" class="card-img-top rounded-circle mx-auto d-block"  src="{{asset("images/".$informe->servicio->equipo->foto)}}" alt="">

                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <strong><i class="fal fa-file-alt mr-1"></i>Detalles del informe: <br>
                                    <p>
                                        Presupuesto: <i class="text-muted"> {{$informe->presupuesto}} </i><br>
                                        @foreach ($informe->servicio->tipos as $tipo)
                                        ProblemaTecnico: {{$tipo->tipo->nombre}} <br>
                                        @endforeach

                                        Descripcion: {{$informe->descripcion}}<br>
                                    </p>
                                </strong>
                             </div>
                            <div class="col-md-4">
                                    <strong><i class="fal fa-file-alt mr-1"></i>Registrado por: <br>
                                        <p>
                                            Nombre: <i class="text-muted"> {{$informe->servicio->equipo->cliente->apellido}} {{$informe->servicio->equipo->cliente->nombre}} </i><br>
                                            DNI: {{$informe->servicio->equipo->cliente->dni}}<br>

                                        </p>
                                    </strong>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-success btn-sm" href="{{ route('mis_servicios.confirmar', ['valor' => 1, 'informe' => $informe]) }}">confirmar</a>
                            <a class="btn btn-danger btn-sm" href="{{ route('mis_servicios.confirmar', ['valor' => 0, 'informe' => $informe]) }}">rechazar</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <p>Su respuesta ya fue enviada, gracias</p>
    @endif


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>









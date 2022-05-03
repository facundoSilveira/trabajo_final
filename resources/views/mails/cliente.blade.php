<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>PC-Shop</title>
</head>
<body>

        <body>
            <p>Hola! Ya revisamos su equipo, le declaramos la descripcion de lo que realizaremos en su equipo, {{ $informe->descripcion}}, el costo del total del servicio es ${{$informe->presupuesto}} y el tiempo estimado para la reparación del servicio es de 2 dias. </p>

                     {{-- {{$informe->servicio->duracionEstimada($informe->servicio->tipos)}} dias.</p> --}}

            <p>A continuacion se detallan el/los servicios a realizar:</p>
            <ul>
                @foreach ($informe->servicio->tipos as $tipo)
                    <li>Nombre del servicio:  {{ $tipo->tipo->nombre }} </li>
                    <li>Precio: ${{ $tipo->tipo->precio}}</li>
                    <li>Detalles: {{ $tipo->tipo->descripcion}}</li>
                    <br>
                @endforeach
            </ul>
            @if($hayStock == true)

                <p>Estos son recursos que vamos a utilizar para la reparacion:</p>
                <ul>
                @foreach ($informe->informeRecurso as $recur)
                    <li>Nombre:  {{ $recur->recurso->tipo_recurso->nombre }} </li>
                    <li>Cantidad: {{ $recur->cantidad}}</li>
                    <li>Precio por unidad: ${{ $recur->recurso->precio}}</li>
                    <br>
                 @endforeach

                </ul>


            @else
                <p>Actualmente no contamos con estos recursos:</p>
                <ul>
                @foreach ($informe->informeRecurso as $recur)
                    <li>Nombre:  {{ $recur->recurso->tipo_recurso->nombre }} </li>
                    <li>Cantidad: {{ $recur->cantidad}}</li>
                    <li>Precio por unidad: ${{ $recur->recurso->precio}}</li>
                    <br>
                 @endforeach
                </ul>
                <p>Por ende al tiempo estimado se le sumara de 5 a 7 dias mas</p>

            @endif
            <a href="http://trabajo_final.test/show_servicio_espera2/{{$informe->slug}}">Para confirmar o rechazar haga click en el enlace</a>

            {{-- <p>Para confirmar o rechazar por favor ingrese al siguiente enlace dando click sobre el mismo!</p>
            http://trabajo_final.test/show_servicio_espera2/{{$informe->slug}} --}}


</body>
</html>

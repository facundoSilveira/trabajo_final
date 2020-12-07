<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>PC-Shop</title>
</head>
<body>

        <body>
            <p>Hola! Ya revisamos su equipo, el problema que de su equipo es {{ $informe->problemaTecnico}}, el costo del total del servicio es ${{$informe->presupuesto}} tiempo estimado es {{$informe->servicio->duracionEstimada($informe->servicio->tipos)}}.</p>
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

            <p>Para confirmar o rechazar por favor ingrese al siguiente enlace dando click sobre el mismo!</p>
            http://trabajo_final.test/mis_servicios/show_servicio_espera/{{$informe->servicio->id}}


</body>
</html>

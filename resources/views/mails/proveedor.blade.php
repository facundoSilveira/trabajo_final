<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>PC-Shop</title>
</head>
<body>

        <body>
            <p>Hola! en la siguiente lista se detalla los productos que la empresa solicita adquirir  </p>

                     {{-- {{$informe->servicio->duracionEstimada($informe->servicio->tipos)}} dias.</p> --}}


                <ul>
                @foreach ($pedido->detalles as $det)
                    <li>Nombre:  {{ $det->recurso->tipo_recurso->nombre }}  Cantidad: {{ $det->cantidad}} </li>

                    <br>
                 @endforeach

                </ul>







</body>
</html>


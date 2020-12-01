<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>PC-Shop</title>
</head>
<body>

        <body>
            <p>Hola! Ya revisamos su equipo, el problema que de su equipo es {{ $data->problemaTecnico}}, el costo del servicio es {{$data->presupuesto}}.</p>
            <p>Estos son recursos que vamos a utilizar para la reparacion:</p>
            <ul>
                @foreach ($data->recurso as $recur)
                <li>Cantidad  {{ $recur }} </li>
                <li>Precio: {{ $recur}}</li>
             @endforeach

            </ul>

            http://trabajo_final.test/mis_servicios/show_servicio_espera/22



</body>
</html>

@extends('admin-lte.index')

@section('content')

<div class="card">
    <form class="form-group " method="GET" enctype="multipart/form-data" action={{route("estadisticas.index")}}>
    <div class="card-header">Servicios finalizado por tecnicos

    </form>
    </div>

    <div class="card-body">
        <canvas id="tecnicosChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>
</div>

<div class="card">
    <div class="card-header">Cantidad de servicios por estados

    </div>

    <div class="card-body">
        <canvas id="estadosChart" style="min-height: 500px; height: 500px; max-height: 500px; max-width: 100%;"></canvas>
    </div>

</div>



@endsection
@push('scripts')


<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
{{-- inicializamos nuestros labels y nuestros datas --}}
<script>
    var labelsTecnicos = [];
    var labelsEstados = [];
    var dataEstados = [];
    var dataTecnicos = [];
    dataTecnicos = []


    colors = ["#98FFB7", "#74C9E8","#A38CFF","#FFDB80","#EAFFA6","#C596FF", "#7DE8E6","#FFEC59","#E8E3FF","#B5E2FF","#D599E8", "#88EBAC","#A5EBA4","#FFE078","#7E7DFF","#81C8EB", "#D1FEED","#C4EBBE","#E1FCEE","#F3E1FD","#96FFB7", "#3DC1EB","#FFD359","#A296FF","#96FFFC","#E6E3FE", "#67EBBC","#DE96FF","#E3FFFC"];

</script>
{{-- cargamos el labes de tecinicos --}}
@foreach ($tecnicos as $clave => $valor)
<script>
    labelsTecnicos.push(" {{ $clave }} ");
    dataTecnicos.push(" {{ $valor }} ");
</script>
@endforeach

{{-- cargamos el labes de estados --}}
@foreach ($estados as $clave => $valor)
<script>
    labelsEstados.push(" {{ $clave }} ");
    dataEstados.push(" {{ $valor }} ");
</script>
@endforeach



{{-- primera parte configura, 2da crea --}}
<script>
    var tecnicosChartCanvas = $('#tecnicosChart').get(0).getContext('2d')
    var chartOptions     = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    title: {
        display: true,
        text: 'Gráfico de servicios finalizados por cada tecnico',
        fontSize: 16
    },
    scales: {
            yAxes: [{
                ticks: {
                    stepSize: 1,
                    min: 0,
                    max: dataTecnicos.max
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Cantidad de servicios',
                    fontSize: 14
                }
            }],

    xAxes: [{
            ticks: {
                beginAtZero: false,
                stepSize: 1,
                min: 0,
                max: dataTecnicos.max
            },
            scaleLabel: {
                display: true,
                labelString: 'Tecnicos' ,
                fontSize: 14
            }
        }],
    },
    }

    var tecnicosChart = new Chart(tecnicosChartCanvas, {
    type: 'bar',
    data: {
        labels: labelsTecnicos,

        datasets: [{
            label: "Finalizados",
            data: dataTecnicos,
            borderColor: "#14B517",
            backgroundColor: colors,
            fill: false
        }
        ]

    },
    options: chartOptions
    })
</script>



<script>

            var estadosChart = new Chart(document.getElementById("estadosChart"), {
            type: 'doughnut',
            data: {
            labels: labelsEstados,
            datasets: [
                {
                label: "Estados",
                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850", "#7DE8E6","#FFEC59","#E8E3FF","#B5E2FF","#D599E8", "#88EBAC","#A5EBA4"],
                data: dataEstados
                }
            ]
            },
            options: {
            title: {
                display: true,
                text: 'Servicios por cada estado del sistema',
                fontSize: 16
            }
            }
        })


</script>
@endpush

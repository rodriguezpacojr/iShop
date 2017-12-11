@extends('principal.index')

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['gauge']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Label', 'Value'],
                    ['Usuarios', {{ $usuarios[0]-> total }}],
                    ['Ordenes', {{ $ordenes[0]-> total }}],
                    ['Productos', {{ $productos[0]-> total }}],
                    ['Proveedores', {{ $proveedores[0]-> total }}],
                    ['Categorias', {{ $categorias[0]-> total }}],
                ]);
                var options = {
                    //width: 800, height: 120,
                    minorTicks: 2
                };

                var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

                chart.draw(data, options);
            }
        </script>
        </div>
    </div>
    <div id="chart_div" style="width: 1000px; height: 500px;"></div>
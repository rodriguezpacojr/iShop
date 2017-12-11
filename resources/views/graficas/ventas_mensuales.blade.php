@extends('principal.index');

@section('content');
<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel-heading"><h3 class="panel-title text-center"><i class="fa fa-hand-peace-o" aria-hidden="true"></i>
                Historial de ventas totales del Año</h3></div>
        <div class="panel-body">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                        @foreach($ventasmes as $vm)
                            ['{{ $vm-> mes}}', {{ $vm-> total }}],
                        @endforeach
                ]);

                var options = {
                    is3D: true,
                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                chart.draw(data, options);
            }
        </script>
    </div>
    </div>
</div>

<div id="piechart_3d" style="width: 1900px; height: 700px;"></div>

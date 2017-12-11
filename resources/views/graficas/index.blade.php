@extends('principal.index');

@section('content');
<div class="panel panel-default">
    <div class="panel-body">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                        @foreach($ventascliente as $vc)
                            ['{{ $vc-> usuario }}', {{ $vc-> total }}],
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
<div id="piechart_3d" style="width: 1000px; height: 500px;"></div>

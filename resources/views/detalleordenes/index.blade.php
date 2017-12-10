@extends('principal.index')

@section('content')
    <br>
    <a href="{{route('detalleordenes.create')}}" class="btn btn-info">
        <i class="fa fa-hand-peace-o" aria-hidden="true"></i>
        Agregar
    </a>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title text-center"><i class="fa fa-hand-peace-o" aria-hidden="true"></i>
                Detalle de Ventas</h3></div>
        <div class="panel-body">
            <table class="table table-hover table-striped " s>
                <thead class="bg-primary">
                <tr>
                    <th>Orden</th>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Catidad</th>
                </tr>
                <thead>
                <tbody>

                </tbody>
                @foreach($detalleorden as $do)
                    <tr>
                        <td>{{ $do-> id }}</td>
                        <td>{{ $do-> nombres .' '.$do->apellidos }}</td>
                        <td>{{ $do-> nombre }}</td>
                        <td>{{ $do-> cantidad }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop
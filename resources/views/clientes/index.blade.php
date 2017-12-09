@extends('principal.index')

@section('content')
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title text-center"><i class="fa fa-hand-peace-o" aria-hidden="true"></i>
                Clientes</h3></div>
        <div class="panel-body">
            <table class="table table-hover table-striped ">
                <thead class="bg-primary">
                <tr>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Ciudad</th>
                    <th>Rol</th>
                    <th>Accion</th>
                </tr>
                <thead>
                <tbody>

                </tbody>
                @foreach($cliente as $cl)
                    <tr>
                        <td>{{ $cl-> usuario}}</td>
                        <td>{{ $cl-> email}}</td>
                        <td>{{ $cl-> nombres}}</td>
                        <td>{{ $cl-> apellidos }}</td>
                        <td>{{ $cl-> telefono}}</td>
                        <td>{{ $cl-> id_ciudad}}</td>
                        <td>
                            @if($cl->rol == 'admin')
                                <span class="label label-danger">{{ $cl->rol }}</span>
                            @else
                                <span class="label label-primary">{{ $cl->rol }}</span>
                            @endif
                        </td>
                        <td><a  href="{{ route('clientes.edit',$cl->id) }}" class="btn btn-warning" >
                                <span class="glyphicon glyphicon-wrench" ></span>
                            </a><a href="{{route('clientes.destroy',$cl->id)}}"  onclick="return confirm('¿Seguro que desea eliminar este Cliente?')" class="btn btn-danger">
                                <span class="glyphicon glyphicon-remove-circle"></span>
                            </a></td>
                    </tr>
                @endforeach
            </table>
            {!! $cliente->render() !!}
        </div>
    </div>
@stop
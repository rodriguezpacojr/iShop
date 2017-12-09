@extends('principal.index')

@section('content')
    <br>
    <a href="{{route('clientecupones.create')}}" class="btn btn-info">
        <i class="fa fa-hand-peace-o" aria-hidden="true"></i>
        Agregar Relacion
    </a>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title text-center"><i class="fa fa-hand-peace-o" aria-hidden="true"></i>
                Cliente - Cupon</h3></div>
        <div class="panel-body">
            <table class="table table-hover table-striped " s>
                <thead class="bg-primary">
                <tr>
                    <th>Cliente</th>
                    <th>Clave</th>
                    <th>Accion</th>
                </tr>
                <thead>
                <tbody>

                </tbody>
                @foreach($clientecupon as $cc)
                    <tr>
                        <td>{{ $cc-> usuario}}</td>
                        <td>{{ $cc-> clave }}</td>
                        <td><a  href="{{ route('clientecupones.edit',$cc->id) }}" class="btn btn-success" >
                                <i class="fa fa-pencil fa-lg" ></i>
                            </a>
                            <a href="{{route('clientecupones.destroy',$cc->id)}}"  onclick="return confirm('¿Seguro que desea eliminar esta Categoria?')" class="btn btn-danger">
                                <i class="fa fa-remove fa-lg "></i>
                            </a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop
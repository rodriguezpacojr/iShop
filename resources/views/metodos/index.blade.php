@extends('principal.index')

@section('content')
    <br>
    <a href="{{route('metodos.create')}}" class="btn btn-info">
        <i class="fa fa-hand-peace-o" aria-hidden="true"></i>
        Agregar Metodo
    </a>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title text-center"><i class="fa fa-hand-peace-o" aria-hidden="true"></i>
                Metodos</h3></div>
        <div class="panel-body">
            <table class="table table-hover table-striped " s>
                <thead class="bg-primary">
                <tr>
                    <th>Nombre</th>
                    <th>Accion</th>
                </tr>
                <thead>
                <tbody>

                </tbody>
                @foreach($metodo as $me)
                    <tr>
                        <td>{{ $me-> nombre}}</td>
                        <td><a  href="{{ route('metodos.edit',$me->id) }}" class="btn btn-success" >
                                <i class="fa fa-pencil fa-lg" ></i>
                            </a>
                            <a href="{{route('metodos.destroy',$me->id)}}"  onclick="return confirm('¿Seguro que desea eliminar este Metodo?')" class="btn btn-danger">
                                <i class="fa fa-remove fa-lg "></i>
                            </a></td>
                    </tr>
                @endforeach
            </table>
            {!! $metodo->render() !!}
        </div>
    </div>
@stop
@extends('principal.index')

@section('content')
    <br>
    <a href="{{route('categorias.create')}}" class="btn btn-info">
        <i class="fa fa-hand-peace-o" aria-hidden="true"></i>
        Agregar Categoria
    </a>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title text-center"><i class="fa fa-hand-peace-o" aria-hidden="true"></i>
                Categorias</h3></div>
        <div class="panel-body">
            <table class="table table-hover table-striped " s>
                <thead class="bg-primary">
                <tr>
                    <th>Categoria</th>
                    <th>Accion</th>
                </tr>
                <thead>
                <tbody>

                </tbody>
                @foreach($categoria as $cate)
                    <tr>
                            <td>{{ $cate-> nombre}}</td>
                            <td><a  href="{{ route('categorias.edit',$cate->id) }}" class="btn btn-success" >
                                    <i class="fa fa-pencil fa-lg" ></i>
                                </a>
                                <a href="{{route('categorias.destroy',$cate->id)}}"  onclick="return confirm('¿Seguro que desea eliminar esta Categoria?')" class="btn btn-danger">
                                    <i class="fa fa-remove fa-lg "></i>
                                </a></td>
                    </tr>
                @endforeach
            </table>
            {!! $categoria->render() !!}
        </div>
    </div>
@stop
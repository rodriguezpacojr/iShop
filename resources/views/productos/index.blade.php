@extends('principal.index')

@section('content')
    <br>
    <a href="{{route('productos.create')}}" class="btn btn-info">
        <i class="fa fa-hand-peace-o" aria-hidden="true"></i>
        Agregar Producto
    </a>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title text-center"><i class="fa fa-hand-peace-o" aria-hidden="true"></i>
                Productos</h3></div>
        <div class="panel-body">
            <table class="table table-hover table-striped " s>
                <thead class="bg-primary">
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio Venta</th>
                    <th>Stock</th>
                    <th>Categoria</th>
                    <th>Accion</th>
                </tr>
                <thead>
                <tbody>

                </tbody>
                @foreach($producto as $pr)
                    <tr>
                        <td>{{ $pr-> nombre}}</td>
                        <td>{{ $pr-> descripcion}}</td>
                        <td>{{ $pr-> precio_venta}}</td>
                        <td>{{ $pr-> stock}}</td>
                        <td>{{ $pr-> id_categoria}}</td>
                        <td><a  href="{{ route('productos.edit',$pr->id) }}" class="btn btn-success" >
                                <i class="fa fa-pencil fa-lg" ></i>
                            </a>
                            <a href="{{route('productos.destroy',$pr->id)}}"  onclick="return confirm('¿Seguro que desea eliminar esta Categoria?')" class="btn btn-danger">
                                <i class="fa fa-remove fa-lg "></i>
                            </a></td>
                    </tr>
                @endforeach
            </table>
            {!! $producto->render() !!}
        </div>
    </div>
@stop
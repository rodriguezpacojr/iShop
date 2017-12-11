@extends('principal.index')

@section('content')
    <br>
    <a href="{{route('proveedores.create')}}" class="btn btn-info">
        <i class="fa fa-hand-peace-o" aria-hidden="true"></i>
        Agregar Proveedor
    </a>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title text-center"><i class="fa fa-hand-peace-o" aria-hidden="true"></i>
                Proveedores</h3></div>
        <div class="table-responsive">
            <table class="table table-striped " s>
                <thead class="bg-primary">
                <tr>
                    <th>Proveedor</th>
                    <th>Direccion</th>
                    <th>Accion</th>
                </tr>
                <thead>
                <tbody>

                </tbody>
                @foreach($proveedor as $prov)
                    <tr>
                            <td>{{ $prov-> nombre}}</td>
                            <td>{{ $prov-> direccion }}</td>
                            <td><a  href="{{ route('proveedores.edit',$prov->id) }}" class="btn btn-success" >
                                    <i class="fa fa-pencil fa-lg" ></i>
                                </a>
                                <a href="{{route('proveedores.destroy',$prov->id)}}"  onclick="return confirm('¿Seguro que desea eliminar esta Categoria?')" class="btn btn-danger">
                                    <i class="fa fa-remove fa-lg "></i>
                                </a></td>
                    </tr>
                @endforeach
            </table>
            {!! $proveedor->render() !!}
        </div>
    </div>
@stop
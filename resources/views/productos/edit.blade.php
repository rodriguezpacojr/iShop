@extends('principal.index')

@section('content')
    <br>
    {!! Form::open(array('route' => ['productos.update',$producto->id], 'method' => 'PUT', 'files' => true)) !!}﻿

    <div class="panel panel-primary">
        <div class="panel-heading">Editar Producto: {{$producto->nombre}}</div>
        <div class="panel-body">
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('nombre','Nombre: ') !!}
                    {!! Form::text('nombre',$producto->nombre,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('descripcion','Descripcion: ') !!}
                    {!! Form::text('descripcion',$producto->descripcion,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('precio_venta','Precio Venta: ') !!}
                    {!! Form::text('precio_venta',$producto->precio_venta,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('stock','Stock: ') !!}
                    {!! Form::text('stock',$producto->stock,['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('imagen','Imagen') !!}
                    {!! Form::file('imagen') !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('id_categoria','Categorias') !!}
                    <select class="form-control" name="id_categoria">
                        @foreach($categorias as $ca)
                            <option value="{{$ca->id}}">{{$ca->nombre}}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-xs-5">
                    {{ Form::button('<i class="fa fa-paper-plane" aria-hidden="true"></i> Editar', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
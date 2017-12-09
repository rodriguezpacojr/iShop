@extends('principal.index')

@section('content')
    <br>
    {!! Form::open(array('route' => ['proveedores.update',$proveedor->id], 'method' => 'PUT')) !!}﻿

    <div class="panel panel-primary">
        <div class="panel-heading">Editar Proveedor: {{$proveedor->nombre}}</div>
        <div class="panel-body">
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('nombre','Proveedor: ') !!}
                    {!! Form::text('nombre',$proveedor->nombre,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('direccion','Proveedor: ') !!}
                    {!! Form::text('direccion',$proveedor->direccion,['class' => 'form-control']) !!}
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
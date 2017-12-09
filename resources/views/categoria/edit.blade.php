@extends('principal.index')

@section('content')
    <br>
    {!! Form::open(array('route' => ['categorias.update',$categoria->id], 'method' => 'PUT')) !!}﻿

    <div class="panel panel-primary">
        <div class="panel-heading">Editar Categoria: {{$categoria->nombre}}</div>
        <div class="panel-body">
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('nombre','Categoria: ') !!}
                    {!! Form::text('nombre',$categoria->nombre,['class' => 'form-control']) !!}
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
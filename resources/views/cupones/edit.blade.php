@extends('principal.index')

@section('content')
    <br>
    {!! Form::open(array('route' => ['cupones.update',$cupon->id], 'method' => 'PUT')) !!}﻿

    <div class="panel panel-primary">
        <div class="panel-heading">Editar Cupon</div>
        <div class="panel-body">
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('clave','Clave: ') !!}
                    {!! Form::text('clave',$cupon->clave,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('descripcion','Descripcion: ') !!}
                    {!! Form::text('descripcion',$cupon->descripcion,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('descuento','Descuento: ') !!}
                    {!! Form::text('descuento',$cupon->descuento,['class' => 'form-control']) !!}
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
@extends('principal.index')

@section('content')
    <br>
    {!! Form::open(array('route' => ['clientecupones.update',$clientecupon->id], 'method' => 'PUT')) !!}﻿

    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('id_cliente','Usuario') !!}
                    <select class="form-control" name="id_cliente">
                        <option>--Selecciona un cliente--</option>
                        @foreach($clientes as $cliente)
                            <option value="{{$cliente->id}}">{{$cliente->usuario}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('id_cupon','Cupon') !!}
                    <select class="form-control" name="id_cupon">
                        <option>--Selecciona un cupon--</option>
                        @foreach($cupones as $cu)
                            <option value="{{$cu->id}}">{{$cu->clave}}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-1 col-xs-5">
                    {{ Form::button('<i class="fa fa-paper-plane" aria-hidden="true"></i> Editar', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
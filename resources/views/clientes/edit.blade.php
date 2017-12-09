@extends('principal.index')

@section('content')
    <br>
    {!! Form::open(array('route' => ['clientes.update',$cliente->id], 'method' => 'PUT')) !!}﻿

    <div class="panel panel-primary">
        <div class="panel-heading">Editar Cliente: {{$cliente->nombres}}</div>
        <div class="panel-body">
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('usuario','Usuario: ') !!}
                    {!! Form::text('usuario',$cliente->usuario,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('correo','Correo: ') !!}
                    {!! Form::text('correo',$cliente->email,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('rol','Rol:') !!}
                    {!! Form::select('rol', ['member'=>'Miembro', 'admin'=>'Administrador'],null,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('nombres','Nombres: ') !!}
                    {!! Form::text('nombres',$cliente->nombres,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('apellidos','Apellidos: ') !!}
                    {!! Form::text('apellidos',$cliente->apellidos,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('rfc','RFC: ') !!}
                    {!! Form::text('rfc',$cliente->rfc,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('telefono','Telefono: ') !!}
                    {!! Form::text('telefono',$cliente->telefono,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('direccion','Direccion: ') !!}
                    {!! Form::text('direccion',$cliente->direccion,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('compania','Compania: ') !!}
                    {!! Form::text('compania',$cliente->compania,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('cp','CP: ') !!}
                    {!! Form::text('cp',$cliente->cp,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-5">
                    {!! Form::label('id_ciudad','Ciudades') !!}
                    <select class="form-control" name="id_ciudad">
                        @foreach($ciudades as $ci)
                            <option value="{{$ci->id}}">{{$ci->nombre}}</option>
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
@extends('principal.index')

@section('content')
<br>
    {!! Form::open(['route' => 'clientes.store','method' => 'POST']) !!}
        <div class="panel panel-primary">
            <div class="panel-heading">Crear Cliente</div>
            <div class="panel-body">
                <div class="form-group row">
                    <div class="col-xs-5">
                        {!! Form::label('email','Correo:') !!}
                        {!! Form::email('email',null,['class' => 'form-control','placeholder'=>'example@gmail.com']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-5">
                        {!! Form::label('password','Contraseña:') !!}
                        {!! Form::password('password',['class' => 'form-control','placeholder'=>'********','required']) !!}
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
                        {!! Form::label('name','Nombre:') !!}
                        {!! Form::text('name',null,['class' => 'form-control','placeholder'=>'Nombre ','required']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-5">
                        {!! Form::label('apellidos','Apellidos:') !!}
                        {!! Form::text('apellidos',null,['class' => 'form-control','placeholder'=>'Apellidos']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-5">
                        {!! Form::label('rfc','RFC:') !!}
                        {!! Form::text('rfc',null,['class' => 'form-control','placeholder'=>'RORF941203HGT']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-5">
                        {!! Form::label('telefono','Telefono:') !!}
                        {!! Form::text('telefono',null,['class' => 'form-control','placeholder'=>'(461) 2305577']) !!}
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
                        {{ Form::button('<i class="fa fa-paper-plane" aria-hidden="true"></i> Registrar', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
@extends('principal.index')

@section('content')
<br>
    {!! Form::open(['route' => 'proveedores.store','method' => 'POST']) !!}
        <div class="panel panel-primary">
            <div class="panel-heading">Crear Proveedor</div>
            <div class="panel-body">
                <div class="form-group row">
                    <div class="col-xs-5">
                        {!! Form::label('nombre','Nombre:') !!}
                        {!! Form::text('nombre',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-5">
                        {!! Form::label('direccion','Direccion:') !!}
                        {!! Form::text('direccion',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-xs-5">
                        {{ Form::button('<i class="fa fa-paper-plane" aria-hidden="true"></i> Enviar', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
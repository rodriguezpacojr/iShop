@extends('principal.index')

@section('content')
<br>
    {!! Form::open(['route' => 'cupones.store','method' => 'POST']) !!}
        <div class="panel panel-primary">
            <div class="panel-heading">Crear Cupon</div>
            <div class="panel-body">
                <div class="form-group row">
                    <div class="col-xs-5">
                        {!! Form::label('clave','Clave: ') !!}
                        {!! Form::text('clave',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-5">
                        {!! Form::label('descripcion','Descripcion: ') !!}
                        {!! Form::text('descripcion',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-5">
                        {!! Form::label('descuento','Descuento: ') !!}
                        {!! Form::text('descuento',null,['class' => 'form-control']) !!}
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
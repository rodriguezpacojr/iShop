@extends('principal.index')

@section('content')
<br>
    {!! Form::open(['route' => 'clientecupones.store','method' => 'POST']) !!}
        <div class="panel panel-primary">
            <div class="panel-heading">Crear Relacion</div>
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
                        {!! Form::label('id_cupon','Clave') !!}
                        <select class="form-control" name="id_cupon">
                            <option>--Selecciona un cupon--</option>
                            @foreach($cupones as $cupon)
                                <option value="{{$cupon->id}}">{{$cupon->clave}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="offset-sm-1 col-xs-5">
                        {{ Form::button('<i class="fa fa-paper-plane" aria-hidden="true"></i>
                                            Enviar',
                                            ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
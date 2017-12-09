<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    protected $table = "detalleorden";

    protected $fillable = [
        'id_orden','id_cliente', 'id_producto','cantidad'
    ];
}

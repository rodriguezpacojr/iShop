<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoProveedor extends Model
{
    protected $table = "productoproveedor";

    protected $fillable = [
        'id_producto', 'id_proveedor','precio_compra'
    ];
}

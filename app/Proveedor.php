<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = "proveedor";

    protected $fillable = [
        'nombre', 'direccion'
    ];
}

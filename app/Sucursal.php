<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = "sucursal";

    protected $fillable = [
        'nombre', 'longitud','latitud'
    ];
}

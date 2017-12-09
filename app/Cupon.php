<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $table = "cupon";

    protected $fillable = [
        'clave', 'descripcion','descuento'
    ];
}

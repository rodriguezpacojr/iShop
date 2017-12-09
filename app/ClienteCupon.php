<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteCupon extends Model
{
    protected $table = "clientecupon";

    protected $fillable = [
        'id_cliente', 'id_cupon'
    ];
}

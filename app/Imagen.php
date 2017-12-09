<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = "imagen";

    protected $fillable = ['nombre', 'id_producto'];

    public function producto()
    {
        return $this->belongsTo('App\Producto');
    }
}

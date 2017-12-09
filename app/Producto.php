<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "producto";

    protected $fillable = [
        'nombre', 'descripcion','precio_venta', 'stock', 'imagen', 'id_categoria'
    ];

    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }

    public function imagenes()
    {
        return $this->hasMany('App\Imagen');
    }
}

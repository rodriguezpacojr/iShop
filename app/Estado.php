<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = "estado";

    protected $fillable = [
        'nombre', 'id_pais'
    ];

    public function pais()
    {
        return $this->belongsTo('App\Pais');
    }

    public function ciudades()
    {
        return $this->hasMany('App\Ciudad');
    }
}

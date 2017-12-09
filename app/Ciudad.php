<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = "ciudad";

    protected $fillable = [
        'nombre', 'id_estado'
    ];

    public function clientes()
    {
        return $this->hasMany('App\User');
    }

    public function estado()
    {
        return $this->belongsTo('App\Estado');
    }
}

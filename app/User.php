<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario', 'email', 'password', 'rol', 'nombres', 'apellidos', 'rfc', 'telefono', 'direccion','compania','cp','id_ciudad'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }
}

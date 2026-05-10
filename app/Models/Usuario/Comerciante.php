<?php

namespace App\Models\Usuario;

use Illuminate\Database\Eloquent\Model;

class Comerciante extends Model
{
    protected $table = 'usuario_comerciante';

    protected $fillable = [
        'name',
        'email',
        'password',
        'foto'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
<?php

namespace App\Models\Usuario;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'usuario_cliente';

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
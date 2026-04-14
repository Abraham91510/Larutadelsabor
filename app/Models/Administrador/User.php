<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'admin_users'; 

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
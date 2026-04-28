<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class RedesSociales extends Model
{
    protected $table = 'redes_sociales';

    protected $fillable = [
        'clave',
        'icono',
        'url'
    ];
}
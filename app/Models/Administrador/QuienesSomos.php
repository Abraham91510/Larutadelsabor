<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class QuienesSomos extends Model
{
    protected $table = 'quienes_somos';

    protected $fillable = [
        'tipo',
        'titulo',
        'descripcion',
        'icono',
        'imagen',
        'is_active'
    ];
}
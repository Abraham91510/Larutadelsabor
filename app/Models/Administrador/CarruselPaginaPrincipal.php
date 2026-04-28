<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class CarruselPaginaPrincipal extends Model
{
    protected $table = 'carrusel_pagina_principal';

    protected $fillable = [
        'titulo',
        'texto',
        'imagen',
        'icono',
        'orden',
        'is_active',

        // 🔥 NUEVOS
        'icono_color',
        'icono_size',
        'titulo_color',
        'titulo_size',
        'texto_color',
        'texto_size'
    ];
}
<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class EnlacesConoceMas extends Model
{
    protected $table = 'conoce_mas';

    protected $fillable = [
        'clave',
        'icono',
        'texto',
        'url'
    ];
}
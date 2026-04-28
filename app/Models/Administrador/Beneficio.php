<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class Beneficio extends Model
{
    protected $table = 'beneficios';
    protected $fillable = ['icono', 'color_icono', 'titulo', 'texto', 'orden', 'is_active'];
}
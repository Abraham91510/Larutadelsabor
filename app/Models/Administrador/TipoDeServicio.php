<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class TipoDeServicio extends Model
{
    protected $table = 'tipos_de_servicios';
    protected $fillable = ['icono', 'color_icono', 'titulo', 'texto', 'bg_clase', 'orden', 'is_active'];
}
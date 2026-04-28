<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class PorqueElegirnos extends Model {
    protected $table = 'porque_elegirnos';
    protected $fillable = ['icono', 'color_icono', 'titulo', 'texto', 'orden', 'is_active'];
}
<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class OpcionDashboard extends Model
{
    protected $table = 'opciones_dashboard';

    protected $fillable = [
        'nombre',
        'slug',
        'url',
        'icono',
        'orden',
        'role'
    ];

    public function subopciones()
    {
        return $this->hasMany(SubopcionDashboard::class, 'opcion_id')
                    ->orderBy('orden');
    }
}
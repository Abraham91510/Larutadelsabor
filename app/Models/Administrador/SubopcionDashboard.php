<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class SubopcionDashboard extends Model
{
    protected $table = 'subopciones_dashboard';

    protected $fillable = [
        'opcion_id',
        'nombre',
        'url',
        'icono',
        'orden',
        'role'
    ];

    public function opcion()
    {
        return $this->belongsTo(OpcionDashboard::class, 'opcion_id');
    }
}
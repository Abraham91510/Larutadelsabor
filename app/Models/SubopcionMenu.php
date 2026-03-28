<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubopcionMenu extends Model
{
    protected $table = 'subopciones_menu';

    protected $fillable = [
        'opcion_id',
        'nombre',
        'url',
        'icono',
        'orden'
    ];

    public function opcion()
    {
        return $this->belongsTo(OpcionMenu::class, 'opcion_id');
    }
}
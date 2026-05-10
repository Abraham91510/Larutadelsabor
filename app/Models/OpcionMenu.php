<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpcionMenu extends Model
{
    protected $table = 'opciones_menu';

    protected $fillable = [
        'nombre',
        'slug',
        'url',
        'orden',
        'roles'
    ];

    public function subopciones()
    {
        return $this->hasMany(SubopcionMenu::class, 'opcion_id')
                    ->orderBy('orden');
    }
}
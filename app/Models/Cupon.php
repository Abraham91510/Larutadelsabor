<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $table = 'cupones';

    protected $fillable = [
        'codigo',
        'descuento',
        'tipo',
        'fecha_expiracion',
        'usos_maximos',
        'usos_usados',
        'activo'
    ];

    public function esValido()
    {
        if ($this->fecha_expiracion && now()->gt($this->fecha_expiracion)) {
            return false;
        }

        if (isset($this->usos_maximos, $this->usos_usados)) {
            if ($this->usos_usados >= $this->usos_maximos) {
                return false;
            }
        }

        if (isset($this->activo) && !$this->activo) {
            return false;
        }

        return true;
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TarjetaCliente extends Model
{
    protected $table = "tarjetas_cliente";

    protected $fillable = [
        'cliente_id',
        'titular',
        'numero',
        'cvv',
        'expiracion',
        'saldo'
    ];
}
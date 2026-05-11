<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = "pedidos";

    protected $fillable = [
        'cliente_id',
        'folio',
        'subtotal',
        'descuento',
        'total',
        'estado',
        'nota',
        'qr'
    ];

    
}
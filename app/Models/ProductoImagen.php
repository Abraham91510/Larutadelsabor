<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoImagen extends Model
{
    protected $table = "producto_imagen";

    protected $fillable = [
        'producto_id',
        'imagen'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
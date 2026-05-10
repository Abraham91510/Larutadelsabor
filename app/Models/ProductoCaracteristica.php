<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoCaracteristica extends Model
{
    protected $fillable = ['producto_id','nombre','descripcion'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
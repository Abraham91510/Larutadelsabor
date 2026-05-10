<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoDetalle extends Model
{
    protected $fillable = ['producto_id','descripcion','ingredientes','nutricional','advertencias'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
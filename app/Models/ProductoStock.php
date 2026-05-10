<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoStock extends Model
{
    protected $fillable = ['producto_id','stock'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
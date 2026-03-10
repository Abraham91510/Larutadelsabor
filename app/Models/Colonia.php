<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Colonia extends Model
{
    use HasFactory;

    protected $table = "colonias";

    protected $fillable = ['nombre', 'cp'];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_colonia');
    }
}
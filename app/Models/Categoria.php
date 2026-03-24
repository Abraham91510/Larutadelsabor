<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    protected $table = "categorias";

    protected $fillable = ['nombre', 'slug'];

    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class);
    }

    public function productos()
    {
        return $this->hasManyThrough(
            Producto::class,
            Subcategoria::class,
            'categoria_id',
            'subcategoria_id',
            'id',
            'id'
        );
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";

    protected $fillable = [
        'nombre', 'slug', 'descripcion', 'precio', 'rating', 
        'icono', 'subcategoria_id'
    ];

    // Relaciones

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'subcategoria_id');
    }

    public function colonias()
    {
        return $this->belongsToMany(Colonia::class, 'producto_colonia');
    }

    /**
     * Nueva relación: un producto puede tener muchas imágenes
     */
    public function imagenes()
    {
        return $this->hasMany(ProductoImagen::class, 'producto_id');
    }

    /**
     * Obtener productos filtrados (Eloquent)
     */
    public function ObtenerProductosFiltrados($categoria_slug = null, $subcategoria = null, $precio_min = null, $precio_max = null, $rating = null, $cp = null)
    {
         $query = self::with([
            'subcategoria.categoria',
            'colonias',
            'imagenes'
        ]);

        if ($categoria_slug) {
            $query->whereHas('subcategoria.categoria', function ($q) use ($categoria_slug) {
                $q->where('slug', $categoria_slug);
            });
        }

        if ($subcategoria) {
            $query->where('subcategoria_id', $subcategoria);
        }

        if ($precio_min) {
            $query->where('precio', '>=', $precio_min);
        }

        if ($precio_max) {
            $query->where('precio', '<=', $precio_max);
        }

        if ($rating) {
            $query->where('rating', '>=', $rating);
        }

        if ($cp) {
            $query->whereHas('colonias', function ($q) use ($cp) {
                $q->where('cp', $cp);
            });
        }

        return $query;
    }
}
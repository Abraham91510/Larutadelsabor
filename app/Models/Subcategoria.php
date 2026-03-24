<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model 
{
    protected $table = "subcategorias";

    protected $fillable = ['nombre', 'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function ObtenerPorCategoria($categoria_slug)
    {
        return self::whereHas('categoria', function ($q) use ($categoria_slug) {
            $q->where('slug', $categoria_slug);
        })->get();
    }
}
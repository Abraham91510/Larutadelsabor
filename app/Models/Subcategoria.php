<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subcategoria extends Model 
{
    protected $table = "subcategorias";

    /**
     * Obtener todas las subcategorías de una categoría específica
     *
     * @param string $categoria_slug
     * @return \Illuminate\Support\Collection
     */
    public function ObtenerPorCategoria($categoria_slug)
    {
        $subcategorias = DB::table('subcategorias')
            ->join('categorias', 'subcategorias.categoria_id', '=', 'categorias.id')
            ->where('categorias.slug', $categoria_slug)
            ->select('subcategorias.*')
            ->get();

        return $subcategorias;
    }
}
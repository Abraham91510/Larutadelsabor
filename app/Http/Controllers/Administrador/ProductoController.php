<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\ProductoImagen;
use App\Models\Colonia;
use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductoController extends Controller
{
    public function index()
    {
        $data = Producto::with(['imagenes', 'colonias', 'subcategoria.categoria'])->get();
        $colonias = Colonia::all();
        $categorias = Categoria::all(); // 👈 NUEVO

        return view('administrador.vistas.productos_admin', compact('data','colonias','categorias'));
    }

    public function store(Request $request)
    {
        $producto = Producto::create([
            'nombre' => $request->nombre,
            'slug' => Str::slug($request->nombre),
            'precio' => $request->precio,
            'rating' => $request->rating ?? 4,
            'icono' => $request->icono,
            'descripcion' => $request->descripcion ?? '',
            'subcategoria_id' => $request->subcategoria_id,
            'is_active' => 1,
            'is_destacado' => $request->is_destacado ?? 0,
        ]);

        // colonias
        if ($request->colonias) {
            $producto->colonias()->sync(array_unique($request->colonias));
        }

        // imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $img) {

                $name = time().'_'.uniqid().'.'.$img->getClientOriginalExtension();
                $img->move(public_path('Imagenes'), $name);

                ProductoImagen::create([
                    'producto_id' => $producto->id,
                    'imagen' => $name
                ]);
            }
        }

        return response()->json(['ok' => true]);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $producto->update([
            'nombre' => $request->nombre,
            'slug' => Str::slug($request->nombre),
            'precio' => $request->precio,
            'rating' => $request->rating,
            'icono' => $request->icono,
            'descripcion' => $request->descripcion,
            'subcategoria_id' => $request->subcategoria_id,
            'is_destacado' => $request->is_destacado ?? 0,
        ]);

        // colonias
        $producto->colonias()->sync(array_unique($request->colonias ?? []));

        // eliminar imágenes
        if ($request->imagenes_eliminadas) {
            foreach ($request->imagenes_eliminadas as $idImg) {
                $img = ProductoImagen::find($idImg);
                if ($img) {
                    File::delete(public_path('Imagenes/'.$img->imagen));
                    $img->delete();
                }
            }
        }

        // nuevas imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $img) {

                $name = time().'_'.uniqid().'.'.$img->getClientOriginalExtension();
                $img->move(public_path('Imagenes'), $name);

                ProductoImagen::create([
                    'producto_id' => $producto->id,
                    'imagen' => $name
                ]);
            }
        }

        return response()->json(['ok' => true]);
    }

    public function toggle($id)
    {
        $p = Producto::findOrFail($id);
        $p->is_active = !$p->is_active;
        $p->save();

        return response()->json(['ok' => true]);
    }

    public function destroy($id)
    {
        $p = Producto::findOrFail($id);

        foreach ($p->imagenes as $img) {
            File::delete(public_path('Imagenes/'.$img->imagen));
        }

        $p->delete();

        return response()->json(['ok' => true]);
    }

    public function toggleDestacado($id)
{
    $p = Producto::findOrFail($id);
    $p->is_destacado = !$p->is_destacado;
    $p->save();

    return response()->json(['ok' => true]);
}
}
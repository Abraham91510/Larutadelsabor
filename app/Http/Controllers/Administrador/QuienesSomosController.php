<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrador\QuienesSomos;
use Illuminate\Support\Facades\File;

class QuienesSomosController extends Controller
{
    public function index()
    {
        $data = QuienesSomos::all();
        return view('administrador.vistas.quienessomos_admin', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            $item = new QuienesSomos();
            $item->tipo = $request->tipo;
            $item->titulo = $request->titulo;
            $item->descripcion = $request->descripcion;
            $item->icono = $request->icono;
            $item->is_active = 1;

            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $nombre = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('imagenes/quienes_somos'), $nombre);
                $item->imagen = 'imagenes/quienes_somos/' . $nombre;
            }

            $item->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $item = QuienesSomos::findOrFail($id);
            $item->tipo = $request->tipo;
            $item->titulo = $request->titulo;
            $item->descripcion = $request->descripcion;
            $item->icono = $request->icono;

            if ($request->hasFile('imagen')) {
                if ($item->imagen && File::exists(public_path($item->imagen))) {
                    File::delete(public_path($item->imagen));
                }
                $file = $request->file('imagen');
                $nombre = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('imagenes/quienes_somos'), $nombre);
                $item->imagen = 'imagenes/quienes_somos/' . $nombre;
            }

            $item->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function toggle($id)
    {
        $item = QuienesSomos::findOrFail($id);
        $item->is_active = !$item->is_active;
        $item->save();
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $item = QuienesSomos::findOrFail($id);
        if ($item->imagen && File::exists(public_path($item->imagen))) {
            File::delete(public_path($item->imagen));
        }
        $item->delete();
        return response()->json(['success' => true]);
    }
}
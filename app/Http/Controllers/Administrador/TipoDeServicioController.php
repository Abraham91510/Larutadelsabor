<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrador\TipoDeServicio;

class TipoDeServicioController extends Controller
{
    public function index()
    {
        $data = TipoDeServicio::orderBy('orden')->get();
        return view('administrador.vistas.tiposDeServicios_admin', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            // Validar orden único
            if (TipoDeServicio::where('orden', $request->orden)->exists()) {
                return response()->json(['error' => true, 'msg' => 'Ese número de orden ya está en uso']);
            }

            // Validar campos vacíos (Lógica de seguridad trim)
            if (empty(trim($request->titulo)) || empty(trim($request->texto))) {
                return response()->json(['error' => true, 'msg' => 'El título y el texto no pueden estar vacíos']);
            }

            $item = new TipoDeServicio();
            $item->titulo = trim($request->titulo);
            $item->texto  = trim($request->texto);
            $item->icono  = trim($request->icono);
            $item->color_icono = trim($request->color_icono) ?? 'text-primary';
            $item->bg_clase = trim($request->bg_clase) ?? 'bg-primary bg-opacity-10';
            $item->orden  = $request->orden;
            $item->is_active = 1;
            $item->save();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validar orden (excepto este registro)
            $existe = TipoDeServicio::where('orden', $request->orden)
                        ->where('id', '!=', $id)
                        ->exists();

            if ($existe) {
                return response()->json(['error' => true, 'msg' => 'Ese número de orden ya está en uso']);
            }

            if (empty(trim($request->titulo)) || empty(trim($request->texto))) {
                return response()->json(['error' => true, 'msg' => 'No puedes dejar campos vacíos']);
            }

            $item = TipoDeServicio::findOrFail($id);
            $item->titulo = trim($request->titulo);
            $item->texto  = trim($request->texto);
            $item->icono  = trim($request->icono);
            $item->color_icono = trim($request->color_icono);
            $item->bg_clase = trim($request->bg_clase);
            $item->orden  = $request->orden;
            $item->save();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }

    public function toggle($id)
    {
        $item = TipoDeServicio::findOrFail($id);
        $item->is_active = !$item->is_active;
        $item->save();
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        TipoDeServicio::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
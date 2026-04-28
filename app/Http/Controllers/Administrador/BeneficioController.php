<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrador\Beneficio;

class BeneficioController extends Controller
{
    public function index()
    {
        $data = Beneficio::orderBy('orden')->get();
        return view('administrador.vistas.beneficios_admin', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            // Validar campos vacíos o solo espacios
            if (empty(trim($request->titulo)) || empty(trim($request->texto))) {
                return response()->json(['error' => true, 'msg' => 'El título y texto no pueden estar vacíos']);
            }

            // Validar orden único
            if (Beneficio::where('orden', $request->orden)->exists()) {
                return response()->json(['error' => true, 'msg' => 'Este número de orden ya está ocupado']);
            }

            Beneficio::create([
                'icono' => trim($request->icono),
                'color_icono' => trim($request->color_icono),
                'titulo' => trim($request->titulo),
                'texto' => trim($request->texto),
                'orden' => $request->orden,
                'is_active' => 1
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if (empty(trim($request->titulo)) || empty(trim($request->texto))) {
                return response()->json(['error' => true, 'msg' => 'No puedes dejar campos vacíos']);
            }

            // Validar orden único (excepto el actual)
            if (Beneficio::where('orden', $request->orden)->where('id', '!=', $id)->exists()) {
                return response()->json(['error' => true, 'msg' => 'Este número de orden ya está ocupado']);
            }

            $item = Beneficio::findOrFail($id);
            $item->update([
                'icono' => trim($request->icono),
                'color_icono' => trim($request->color_icono),
                'titulo' => trim($request->titulo),
                'texto' => trim($request->texto),
                'orden' => $request->orden
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }

    public function toggle($id)
    {
        $item = Beneficio::findOrFail($id);
        $item->is_active = !$item->is_active;
        $item->save();
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Beneficio::destroy($id);
        return response()->json(['success' => true]);
    }
}
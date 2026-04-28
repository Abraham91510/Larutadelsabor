<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrador\PorqueElegirnos;

class PorqueElegirnosController extends Controller
{
    public function index()
    {
        $data = PorqueElegirnos::orderBy('orden')->get();
        return view('administrador.vistas.porqueElegirnos_admin', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            // Validar orden único
            if (PorqueElegirnos::where('orden', $request->orden)->exists()) {
                return response()->json(['error' => true, 'msg' => 'Ese número de orden ya está en uso']);
            }

            // Validar campos vacíos (Lógica de seguridad)
            if (empty(trim($request->titulo)) || empty(trim($request->texto))) {
                return response()->json(['error' => true, 'msg' => 'El título y el texto no pueden estar vacíos']);
            }

            $item = new PorqueElegirnos();
            $item->titulo = trim($request->titulo);
            $item->texto  = trim($request->texto);
            $item->icono  = trim($request->icono);
            $item->color_icono = trim($request->color_icono) ?? 'text-primary';
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
            $existe = PorqueElegirnos::where('orden', $request->orden)
                        ->where('id', '!=', $id)
                        ->exists();

            if ($existe) {
                return response()->json(['error' => true, 'msg' => 'Ese número de orden ya está en uso']);
            }

            $item = PorqueElegirnos::findOrFail($id);
            $item->titulo = trim($request->titulo);
            $item->texto  = trim($request->texto);
            $item->icono  = trim($request->icono);
            $item->color_icono = trim($request->color_icono);
            $item->orden  = $request->orden;
            $item->save();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()], 500);
        }
    }

    public function toggle($id)
    {
        $item = PorqueElegirnos::findOrFail($id);
        $item->is_active = !$item->is_active;
        $item->save();
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        PorqueElegirnos::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
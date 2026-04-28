<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrador\CarruselPaginaPrincipal;
use Illuminate\Support\Facades\File;

class CarruselPaginaPrincipalController extends Controller
{
    public function index()
    {
        $data = CarruselPaginaPrincipal::orderBy('orden')->get();
        return view('administrador.vistas.carrusel_pagina_principal_admin', compact('data'));
    }

    public function store(Request $request)
    {
        try {

            // VALIDACIONES
            if (
                trim($request->titulo) === '' ||
                trim($request->texto) === '' ||
                trim($request->icono) === '' ||
                !$request->orden
            ) {
                return response()->json(['error'=>true,'msg'=>'Todos los campos son obligatorios']);
            }

            if (!$request->hasFile('imagen')) {
                return response()->json(['error'=>true,'msg'=>'Debes subir una imagen']);
            }

            if (CarruselPaginaPrincipal::where('orden', $request->orden)->exists()) {
                return response()->json(['error'=>true,'msg'=>'Ese orden ya está en uso']);
            }

            $item = new CarruselPaginaPrincipal();

            $item->titulo = $request->titulo;
            $item->texto  = $request->texto;
            $item->icono  = $request->icono;
            $item->orden  = $request->orden;
            $item->is_active = 1;

            // 🔥 NUEVO
            $item->icono_color = $request->icono_color;
            $item->icono_size  = $request->icono_size;

            $item->titulo_color = $request->titulo_color;
            $item->titulo_size  = $request->titulo_size;

            $item->texto_color = $request->texto_color;
            $item->texto_size  = $request->texto_size;

            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $nombre = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('imagenes/carrusel_pagina_principal'), $nombre);
                $item->imagen = 'imagenes/carrusel_pagina_principal/' . $nombre;
            }

            $item->save();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['error'=>true,'msg'=>$e->getMessage()],500);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            if (
                trim($request->titulo) === '' ||
                trim($request->texto) === '' ||
                trim($request->icono) === '' ||
                !$request->orden
            ) {
                return response()->json(['error'=>true,'msg'=>'Todos los campos son obligatorios']);
            }

            $existe = CarruselPaginaPrincipal::where('orden', $request->orden)
                ->where('id', '!=', $id)
                ->exists();

            if ($existe) {
                return response()->json(['error'=>true,'msg'=>'Ese orden ya está en uso']);
            }

            $item = CarruselPaginaPrincipal::findOrFail($id);

            $item->titulo = $request->titulo;
            $item->texto  = $request->texto;
            $item->icono  = $request->icono;
            $item->orden  = $request->orden;

            // 🔥 NUEVO
            $item->icono_color = $request->icono_color;
            $item->icono_size  = $request->icono_size;

            $item->titulo_color = $request->titulo_color;
            $item->titulo_size  = $request->titulo_size;

            $item->texto_color = $request->texto_color;
            $item->texto_size  = $request->texto_size;

            if ($request->hasFile('imagen')) {

                if ($item->imagen && File::exists(public_path($item->imagen))) {
                    File::delete(public_path($item->imagen));
                }

                $file = $request->file('imagen');
                $nombre = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('imagenes/carrusel_pagina_principal'), $nombre);
                $item->imagen = 'imagenes/carrusel_pagina_principal/' . $nombre;
            }

            $item->save();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['error'=>true,'msg'=>$e->getMessage()],500);
        }
    }

    public function toggle($id)
    {
        $item = CarruselPaginaPrincipal::findOrFail($id);
        $item->is_active = !$item->is_active;
        $item->save();
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $item = CarruselPaginaPrincipal::findOrFail($id);

        if ($item->imagen && File::exists(public_path($item->imagen))) {
            File::delete(public_path($item->imagen));
        }

        $item->delete();

        return response()->json(['success' => true]);
    }
}
<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\Administrador\OpcionDashboard;
use App\Models\Administrador\DatosEmpresa;

class DashboardController extends Controller
{
   public function index()
{
    $user = session('user');
    
    // Si no hay usuario, forzar datos de invitado para evitar errores
    if (!$user) {
        $user = (object)['name' => 'Invitado', 'role' => 'invitado', 'foto' => 'default.png'];
    }

    // Traemos el menú filtrando por rol
    $menu = OpcionDashboard::with(['subopciones' => function ($query) use ($user) {
            // Si el usuario es invitado, solo ve subopciones 'all' o 'invitado'
            // Si es admin, ve todas
            if ($user->role !== 'admin') {
                $query->whereIn('role', ['all', 'invitado']);
            }
            $query->orderBy('orden');
        }])
        ->where(function ($query) use ($user) {
            if ($user->role !== 'admin') {
                $query->whereIn('role', ['all', 'invitado']);
            }
        })
        ->orderBy('orden')
        ->get();

    $generales = DatosEmpresa::first() ?? (object)[
        "nombre_empresa" => "La Ruta del Sabor",
        "eslogan_empresa" => "Sabor y Tradición",
        "logo_empresa" => "logo.png"
    ];

    return view('administrador.vistas.dashboard', compact('menu', 'generales', 'user'));
}
}
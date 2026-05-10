<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

use App\Models\Administrador\OpcionDashboard;
use App\Models\Administrador\DatosEmpresa;
use App\Models\OpcionMenu; // 👈 MODELO DEL FRONTEND (ajústalo si se llama diferente)

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {

            /* =========================
               USUARIO DE SESIÓN
            ========================= */
            $user = session('user');

            if (!$user) {
                $user = (object)[
                    'name' => 'Invitado',
                    'role' => 'invitado',
                    'foto' => 'default.png'
                ];
            }

            /* =========================
               MENÚ FRONTEND (WEB)
            ========================= */
            $menu = OpcionMenu::with(['subopciones'])
                ->orderBy('orden')
                ->get();

            /* =========================
               MENÚ DASHBOARD (ADMIN)
            ========================= */
            $menuDashboard = OpcionDashboard::with(['subopciones' => function ($query) use ($user) {

                if ($user->role !== 'admin') {
                    $query->where('role', 'all');
                }

            }])
            ->where(function ($query) use ($user) {

                if ($user->role !== 'admin') {
                    $query->where('role', 'all');
                }

            })
            ->orderBy('orden')
            ->get();

            /* =========================
               DATOS EMPRESA
            ========================= */
            $generales = DatosEmpresa::first() ?? (object)[
    'nombre_empresa' => 'La Ruta del Sabor',
    'eslogan_empresa' => 'Siempre visible, Siempre a tiempo.',
    'logo_empresa' => 'Imagenes/La Ruta Del Sabor_Logo.ico'
];

            /* =========================
               COMPARTIR VISTAS
            ========================= */
            $view->with([
                'menu' => $menu,                     // FRONTEND
                'menuDashboard' => $menuDashboard,   // DASHBOARD
                'user' => $user,
                'generales' => $generales
            ]);


/* =========================
   NUEVO:
   CLIENTE Y COMERCIANTE
========================= */
View::share(
    'tipoUsuario',
    session('tipo_usuario')
);




        });


         Paginator::useBootstrap();
    }
}
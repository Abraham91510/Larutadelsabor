<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

use App\Models\Administrador\OpcionDashboard;
use App\Models\Administrador\DatosEmpresa;
use App\Models\OpcionMenu;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {

            // =========================
            // SESIONES SEPARADAS
            // =========================
            $admin = session('admin');
            $usuario = session('usuario');

            // =========================
            // SI NO HAY USUARIO → INVITADO
            // =========================
            if (!$admin && !$usuario) {
                $usuario = (object)[
                    'name' => 'Invitado',
                    'role' => 'invitado',
                    'foto' => 'default.png'
                ];
            }

            // =========================
            // MENÚ FRONTEND
            // =========================
            $menu = OpcionMenu::with(['subopciones'])
                ->orderBy('orden')
                ->get();

            // =========================
            // MENÚ DASHBOARD (ADMIN)
            // =========================
            $menuDashboard = OpcionDashboard::with(['subopciones' => function ($query) use ($admin) {

                // SOLO ADMIN VE TODO
                if (!$admin || $admin->role !== 'admin') {
                    $query->where('role', 'all');
                }

            }])
            ->where(function ($query) use ($admin) {

                if (!$admin || $admin->role !== 'admin') {
                    $query->where('role', 'all');
                }

            })
            ->orderBy('orden')
            ->get();

            // =========================
            // DATOS EMPRESA
            // =========================
            $generales = DatosEmpresa::first() ?? (object)[
                'nombre_empresa' => 'La Ruta del Sabor',
                'eslogan_empresa' => 'Siempre visible, Siempre a tiempo.',
                'logo_empresa' => 'Imagenes/La Ruta Del Sabor_Logo.ico'
            ];

            // =========================
            // COMPARTIR VISTAS
            // =========================
            $view->with([
                'menu' => $menu,
                'menuDashboard' => $menuDashboard,
                'admin' => $admin,
                'usuario' => $usuario,
                'generales' => $generales
            ]);

            // tipo de usuario global
            View::share('tipoUsuario', session('tipo_usuario'));
        });

        Paginator::useBootstrap();
    }
}
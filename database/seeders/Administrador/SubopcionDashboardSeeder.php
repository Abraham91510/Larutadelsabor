<?php

namespace Database\Seeders\Administrador;

use Illuminate\Database\Seeder;
use App\Models\Administrador\SubopcionDashboard;

class SubopcionDashboardSeeder extends Seeder
{
    public function run(): void
    {
        SubopcionDashboard::insert([
            // Pacientes (SOLO ADMIN)
            ['opcion_id'=>2,'nombre'=>'Agregar','url'=>'/dashboard/pacientes/create','icono'=>'fas fa-plus','orden'=>1,'role'=>'admin'],
            ['opcion_id'=>2,'nombre'=>'Lista','url'=>'/dashboard/pacientes','icono'=>'fas fa-list','orden'=>2,'role'=>'admin'],

            // Usuarios (SOLO ADMIN)
            ['opcion_id'=>3,'nombre'=>'Admins','url'=>'/dashboard/usuarios','icono'=>'fas fa-user-cog','orden'=>1,'role'=>'admin'],

            // Quiénes somos (VISIBLE PARA TODOS)
            ['opcion_id'=>4,'nombre'=>'Editar Información','url'=>'/dashboard/quienes-somos','icono'=>'fas fa-info-circle','orden'=>1,'role'=>'all'],

            // Carrusel (SOLO ADMIN)
            ['opcion_id'=>5,'nombre'=>'Administrar','url'=>'/dashboard/carrusel','icono'=>'fas fa-images','orden'=>1,'role'=>'admin'],

            // Productos (SOLO ADMIN)
            ['opcion_id'=>6,'nombre'=>'Catálogo','url'=>'/dashboard/productos','icono'=>'fas fa-box','orden'=>1,'role'=>'admin'],

            // Porque elegirnos (SOLO ADMIN)
            ['opcion_id'=>7,'nombre'=>'Gestionar Cards','url'=>'/dashboard/porque-elegirnos','icono'=>'fas fa-th-large','orden'=>1,'role'=>'admin'],

            // Beneficios (SOLO ADMIN)
            ['opcion_id'=>8,'nombre'=>'Gestionar','url'=>'/dashboard/beneficios','icono'=>'bi bi-list-stars','orden'=>1,'role'=>'admin'],
 // ⭐ TIPOS DE SERVICIOS (SOLO ADMIN) — NUEVO AL FINAL
    ['opcion_id'=>9,'nombre'=>'Gestionar','url'=>'/dashboard/tipos-servicios/admin','icono'=>'bi bi-collection-play','orden'=>1,'role'=>'admin'],
           
        ]);
    }
}
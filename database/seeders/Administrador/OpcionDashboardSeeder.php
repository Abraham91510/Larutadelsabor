<?php

namespace Database\Seeders\Administrador;

use Illuminate\Database\Seeder;
use App\Models\Administrador\OpcionDashboard;

class OpcionDashboardSeeder extends Seeder
{
    public function run(): void
    {
        OpcionDashboard::insert([
            ['id'=>1,'nombre'=>'Dashboard','slug'=>'dashboard','url'=>'/dashboard','icono'=>'fas fa-home','orden'=>1,'role'=>'all'],
            ['id'=>2,'nombre'=>'Pacientes','slug'=>'pacientes','url'=>'/dashboard/pacientes','icono'=>'fas fa-user','orden'=>2,'role'=>'admin'],
            ['id'=>3,'nombre'=>'Usuarios','slug'=>'usuarios','url'=>'/dashboard/usuarios','icono'=>'fas fa-users','orden'=>3,'role'=>'admin'],
            ['id'=>4,'nombre'=>'Inicio','slug'=>'inicio','url'=>'#','icono'=>'fas fa-globe','orden'=>4,'role'=>'all'],
            ['id'=>5,'nombre'=>'Carrusel','slug'=>'carrusel','url'=>'/dashboard/carrusel','icono'=>'fas fa-images','orden'=>5,'role'=>'admin'],
            ['id'=>6,'nombre'=>'Productos','slug'=>'productos','url'=>'/dashboard/productos','icono'=>'fas fa-box','orden'=>6,'role'=>'admin'],
            ['id'=>7,'nombre'=>'Porque Elegirnos','slug'=>'porque_elegirnos','url'=>'#','icono'=>'fas fa-check-circle','orden'=>7,'role'=>'admin'],
            ['id'=>8,'nombre'=>'Beneficios', 'slug'=>'beneficios', 'url'=>'#', 'icono'=>'bi bi-bank', 'orden'=>8,'role'=>'admin'],
            ['id'=>9,'nombre'=>'Servicios', 'slug'=>'tipos_servicios', 'url'=>'#', 'icono'=>'bi bi-gear-wide-connected', 'orden'=>9,'role'=>'admin'],
        ]);
    }
}
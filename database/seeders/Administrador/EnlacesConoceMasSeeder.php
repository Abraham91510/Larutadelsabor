<?php

namespace Database\Seeders\Administrador;

use Illuminate\Database\Seeder;
use App\Models\Administrador\EnlacesConoceMas;

class EnlacesConoceMasSeeder extends Seeder
{
    public function run()
    {
        EnlacesConoceMas::insert([

            [
                'clave' => 'enlace_inicio',
                'icono' => 'bi bi-house me-1',
                'texto' => 'Inicio',
                'url' => '/inicio'
            ],
            [
                'clave' => 'enlace_registro',
                'icono' => 'bi-person-plus',
                'texto' => 'Registrarse',
                'url' => '/registro'
            ],
            [
                'clave' => 'enlace_carrito',
                'icono' => 'bi-cart',
                'texto' => 'Carrito',
                'url' => '/carrito'
            ],
            [
                'clave' => 'enlace_ayuda',
                'icono' => 'bi-question-circle',
                'texto' => 'Ayuda',
                'url' => '/ayuda'
            ],
            [
                'clave' => 'enlace_contacto',
                'icono' => 'bi-envelope',
                'texto' => 'Contacto',
                'url' => '/contacto'
            ],

        ]);
    }
}
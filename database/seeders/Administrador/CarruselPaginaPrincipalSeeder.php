<?php

namespace Database\Seeders\Administrador;

use Illuminate\Database\Seeder;
use App\Models\Administrador\CarruselPaginaPrincipal;

class CarruselPaginaPrincipalSeeder extends Seeder
{
    public function run(): void
    {
        CarruselPaginaPrincipal::insert([

            [
                'titulo' => 'Apoya la Economía Local',
                'texto' => 'Compra productos locales de comida y ayuda a crecer a tu comunidad.',
                'imagen' => 'Imagenes/imagen05.jpg',
                'icono'  => 'bi bi-hand-thumbs-up',

                // 🔥 ESTILOS
                'icono_color' => '#28a745',
                'icono_size'  => '30px',

                'titulo_color' => '#ffffff',
                'titulo_size'  => '32px',

                'texto_color' => '#f8f9fa',
                'texto_size'  => '16px',

                'orden'  => 1,
                'is_active' => 1
            ],

            [
                'titulo' => 'Prueba la nueva Hamburguesa "Magnificarne"',
                'texto' => 'Producto 100% con carne natural a 99 MXN.',
                'imagen' => 'Imagenes/imagen06.png',
                'icono'  => 'bi bi-basket2-fill',

                // 🔥 ESTILOS
                'icono_color' => '#ffc107',
                'icono_size'  => '30px',

                'titulo_color' => '#ffffff',
                'titulo_size'  => '32px',

                'texto_color' => '#f8f9fa',
                'texto_size'  => '16px',

                'orden'  => 2,
                'is_active' => 1
            ]

        ]);
    }
}
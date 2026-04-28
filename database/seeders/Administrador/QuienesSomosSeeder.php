<?php

namespace Database\Seeders\Administrador;

use Illuminate\Database\Seeder;
use App\Models\Administrador\QuienesSomos;

class QuienesSomosSeeder extends Seeder
{
    public function run(): void
    {
        QuienesSomos::insert([

            [
                'tipo'   => 'mision',
                'titulo' => 'Misión',
                'descripcion'  => 'Ofrecer una plataforma digital integral que facilite la localización y contratación de comerciantes ambulantes de comida, permitiendo a los usuarios encontrar opciones cercanas de manera rápida y confiable, mientras se brinda a los prestadores una herramienta accesible para mejorar su visibilidad, organización y ventas. La Ruta Del Sabor promueve el uso de tecnología segura, pagos digitales validados y medios de movilidad de bajo impacto, fortaleciendo la economía local y el consumo responsable dentro de la comunidad.',
                'icono'  => 'bi bi-bullseye',
                'imagen' => 'Imagenes/imagen12.png',
                'is_active' => 1
            ],

            [
                'tipo'   => 'vision',
                'titulo' => 'Visión',
                'descripcion'  => 'Consolidarse como un referente en servicios digitales de comida ambulante, integrando innovación tecnológica, accesibilidad e inclusión para transformar el comercio móvil en una actividad más ordenada, segura y sostenible. La Ruta Del Sabor busca ser reconocida por conectar personas con la gastronomía local de forma eficiente, apoyar el crecimiento de los comerciantes ambulantes y contribuir a ciudades más cercanas, dinámicas y ambientalmente responsables.',
                'icono'  => 'bi bi-eye',
                'imagen' => 'Imagenes/imagen13.png',
                'is_active' => 1
            ],

            [
                'tipo'   => 'objetivo',
                'titulo' => 'Objetivo',
                'descripcion'  => 'Conectar de manera eficiente y segura a clientes con comerciantes ambulantes de comida mediante una plataforma digital con geolocalización en tiempo real que prioriza la cercanía y la disponibilidad. Además, impulsa la economía local, reduce el impacto ambiental y garantiza pagos digitales sin efectivo mediante el uso de códigos QR para validar el servicio y liberar el pago automáticamente, ofreciendo también una experiencia accesible e inclusiva para todos los usuarios.',
                'icono'  => 'bi bi-flag',
                'imagen' => 'Imagenes/imagen11.png',
                'is_active' => 1
            ]

        ]);
    }
}
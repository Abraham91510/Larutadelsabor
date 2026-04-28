<?php

namespace Database\Seeders\Administrador;

use Illuminate\Database\Seeder;
use App\Models\Administrador\PorqueElegirnos;

class PorqueElegirnosSeeder extends Seeder
{
    public function run(): void
    {
        PorqueElegirnos::insert([
            [
                'icono' => 'bi bi-geo-alt-fill',
                'color_icono' => 'text-success',
                'titulo' => 'Geolocalización en Tiempo Real',
                'texto' => 'Encuentra comerciantes de comida cerca de ti al instante.',
                'orden' => 1,
                'is_active' => 1
            ],
            [
                'icono' => 'bi bi-shield-lock-fill',
                'color_icono' => 'text-primary',
                'titulo' => 'Pagos digitales 100% Seguros',
                'texto' => 'Transacciones digitales protegidas con encriptación.',
                'orden' => 2,
                'is_active' => 1
            ],
            [
                'icono' => 'bi bi-clock-fill',
                'color_icono' => 'text-warning',
                'titulo' => 'Entrega Rápida',
                'texto' => 'Recibe tu comida en minutos o al instante.',
                'orden' => 3,
                'is_active' => 1
            ],
            [
                'icono' => 'bi bi-people-fill',
                'color_icono' => 'text-orange',
                'titulo' => 'Apoya Local',
                'texto' => 'Conecta directamente con vendedores de comida locales.',
                'orden' => 4,
                'is_active' => 1
            ],
            [
                'icono' => 'bi bi-star-fill',
                'color_icono' => 'text-purple',
                'titulo' => 'Calificaciones Verificadas',
                'texto' => 'Lee reseñas de clientes reales.',
                'orden' => 5,
                'is_active' => 1
            ],
            [
                'icono' => 'bi bi-graph-up-arrow', // Añadí un icono representativo ya que no venía en tu slot
                'color_icono' => 'text-danger',
                'titulo' => 'Crecimiento Continuo',
                'texto' => 'Más comerciantes de comida disponibles cada día.',
                'orden' => 6,
                'is_active' => 1
            ]
        ]);
    }
}
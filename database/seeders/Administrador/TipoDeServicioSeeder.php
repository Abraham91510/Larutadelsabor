<?php

namespace Database\Seeders\Administrador;

use Illuminate\Database\Seeder;
use App\Models\Administrador\TipoDeServicio;

class TipoDeServicioSeeder extends Seeder
{

public function run(): void
{
    TipoDeServicio::insert([
        [
            'icono' => 'bi bi-calendar-event', 
            'color_icono' => 'text-success', 
            'bg_clase' => 'bg-success bg-opacity-10',
            'titulo' => 'Servicio programado', 
            'texto' => '<ul class="mb-0"><li>El cliente agenda el servicio con anticipación.</li><li>Pago por transferencia bancaria dentro de la plataforma.</li><li>Confirmación de fecha, horario y alcance.</li></ul>',
            'orden' => 1, 'is_active' => 1
        ],
        [
            'icono' => 'bi bi-lightning-fill', 
            'color_icono' => 'text-primary', 
            'bg_clase' => 'bg-primary bg-opacity-10',
            'titulo' => 'Servicio inmediato', 
            'texto' => '<ul class="mb-0"><li>Contratación de un prestador cercano y disponible.</li><li>Pago previo por transferencia bancaria.</li><li>Ideal para servicios rápidos o compras locales.</li></ul>',
            'orden' => 2, 'is_active' => 1
        ],
        [
            'icono' => 'bi bi-map-fill', 
            'color_icono' => 'text-warning', 
            'bg_clase' => 'bg-warning bg-opacity-10',
            'titulo' => 'Servicios por ruta local', 
            'texto' => '<ul class="mb-0"><li>Aplicable a comerciantes ambulantes o móviles.</li><li>Visualización de ruta en tiempo real.</li><li>Reserva de productos o atención cercana.</li></ul>',
            'orden' => 3, 'is_active' => 1
        ]
    ]);
}
}
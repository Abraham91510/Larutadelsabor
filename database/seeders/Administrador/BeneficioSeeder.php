<?php

namespace Database\Seeders\Administrador;

use Illuminate\Database\Seeder;
use App\Models\Administrador\Beneficio;

class BeneficioSeeder extends Seeder
{
    public function run(): void
    {
        Beneficio::insert([
            ['icono' => 'bi bi-currency-dollar', 'color_icono' => 'text-success', 'titulo' => 'Pagos digitales', 'texto' => 'Recibir pagos de manera digital.', 'orden' => 1, 'is_active' => 1],
            ['icono' => 'bi bi-qr-code', 'color_icono' => 'text-primary', 'titulo' => 'Retiros con QR', 'texto' => 'Retirar dinero mediante código QR en cajeros autorizados.', 'orden' => 2, 'is_active' => 1],
            ['icono' => 'bi bi-credit-card', 'color_icono' => 'text-warning', 'titulo' => 'Tarjeta virtual', 'texto' => 'Generar una tarjeta virtual para el uso de los fondos.', 'orden' => 3, 'is_active' => 1]
        ]);
    }
}
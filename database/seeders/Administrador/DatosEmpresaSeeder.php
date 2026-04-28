<?php

// ✅ BIEN
namespace Database\Seeders\Administrador;

use Illuminate\Database\Seeder;
use App\Models\Administrador\DatosEmpresa;

class DatosEmpresaSeeder extends Seeder
{
    public function run(): void
    {
        DatosEmpresa::create([

            "nombre_empresa" => "La Ruta del Sabor",
            "eslogan_empresa" => "Siempre visible, Siempre a tiempo.",
            "logo_empresa" => "Imagenes/La Ruta Del Sabor_Logo.ico",
            "descripcion_empresa" => "Plataforma digital que conecta clientes 
            con comerciantes ambulantes de comida mediante geolocalización y tecnología segura.",

            // 👇 EXACTAMENTE tu estructura original
            "derechos_reservados_empresa" => [
                "icono" => "bi bi-c-circle",
                "anio" => date('Y'),
                "texto" => "Todos los derechos reservados."
            ]

        ]);
    }
}
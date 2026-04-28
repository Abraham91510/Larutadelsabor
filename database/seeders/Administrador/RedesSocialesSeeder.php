<?php

namespace Database\Seeders\Administrador;

use Illuminate\Database\Seeder;
use App\Models\Administrador\RedesSociales;

class RedesSocialesSeeder extends Seeder
{
    public function run()
    {
        RedesSociales::insert([

            [
                'clave' => 'facebook',
                'icono' => 'fa-facebook',
                'url' => 'https://www.facebook.com/?locale=es_LA'
            ],
            [
                'clave' => 'instagram',
                'icono' => 'fa-instagram',
                'url' => 'https://www.instagram.com/'
            ],
            [
                'clave' => 'x',
                'icono' => 'fa-x-twitter',
                'url' => 'https://x.com/?lang=es'
            ],
            [
                'clave' => 'whatsapp',
                'icono' => 'fa-whatsapp',
                'url' => 'https://www.whatsapp.com/?lang=es'
            ],
            [
                'clave' => 'youtube',
                'icono' => 'fa-youtube',
                'url' => 'https://www.youtube.com/'
            ],
            [
                'clave' => 'tiktok',
                'icono' => 'fa-tiktok',
                'url' => 'https://www.tiktok.com/'
            ],

        ]);
    }
}
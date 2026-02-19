<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Pagina;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\DataTables;


class HomeController extends Controller
{
    public function __invoke(){
        return view ('hello');
    }

    public function inicio(){
        $datos["nombre_empresa"] = "La Ruta del Sabor";
        $datos["eslogan_empresa"] = "Siempre visible, Siempre a tiempo.";
        $datos["logo_empresa"] = "Imagenes/La Ruta Del Sabor_Logo.ico";
        $datos["ruta_pagina_principal"] = route('inicio');
        $datos["descripcion_empresa"] = "Plataforma digital que conecta clientes 
        con comerciantes ambulantes de comida mediante geolocalización y tecnología segura.";

        $datos["enlace_ayuda"] = [
        "icono" => "bi-question-circle",
        "texto" => "Ayuda",
        "url" => route('inicio')
    ];

    $datos["enlace_registro"] = [
        "icono" => "bi-person-plus",
        "texto" => "Registrarse",
        "url" => route('vista_inicio')
    ];

    $datos["enlace_carrito"] = [
        "icono" => "bi-cart",
        "texto" => "Carrito",
        "url" => route('vista_inicio') 
    ];

    $datos['menu'] = [
        'inicio' => [
            'texto' => 'Inicio',
            'url' => route('vista_inicio'),
        ],
        
        'categorias' => [
            'titulo' => 'Categorías',
            'items' => [
                ['texto' => 'Comidas', 'url' => route('vista_inicio'), 'icono' => 'bi-basket'],
                ['texto' => 'Snack’s', 'url' => route('vista_inicio'), 'icono' => 'bi-egg-fried'],
                ['texto' => 'Postres', 'url' => route('vista_inicio'), 'icono' => 'bi-cup-straw'],
                ['texto' => 'Panadería', 'url' => route('vista_inicio'), 'icono' => 'bi-bag'],
                ['texto' => 'Productos de temporada', 'url' => route('vista_inicio'), 'icono' => 'bi-calendar-check'],
                ['texto' => 'Bebidas', 'url' => route('vista_inicio'), 'icono' => 'bi-cup']
            ]
        ],

        'comerciantes' => [
            'titulo' => 'Nuestros Comerciantes',
            'items' => [
                ['texto' => 'Cerca de mí', 'url' => route('vista_inicio'), 'icono' => 'bi-geo-alt'],
                ['texto' => 'Mejor calificados', 'url' => route('vista_inicio'), 'icono' => 'bi-star'],
                ['texto' => 'Nuevos', 'url' => route('vista_inicio'), 'icono' => 'bi-plus-circle'],
            ]
        ],
        'como_funciona' => [
            'titulo' => 'Aprende a usar',
            'items' => [
                ['texto' => 'Clientes', 'url' => route('vista_inicio'), 'icono' => 'bi-person-lines-fill'],
                ['texto' => 'Comerciantes', 'url' => route('vista_inicio'), 'icono' => 'bi-shop'],
                ['texto' => 'Pagos', 'url' => route('vista_inicio'), 'icono' => 'bi-credit-card'],
            ]
        ],
        'contacto' => [
            'texto' => 'Contacto',
            'url' => route('vista_inicio'),
            'icono' => 'bi-envelope'
        ],
    ];

    $datos["facebook"] = [
        "icono" => "fa-facebook",
        "url" => route('inicio')
    ];

    $datos["instagram"] = [
        "icono" => "fa-instagram",
        "url" => route('inicio')
    ];

    $datos["twitter"] = [
        "icono" => "fa-twitter",
        "url" => route('inicio')
    ];

    $datos["whatsapp"] = [
        "icono" => "fa-whatsapp",
        "url" => route('inicio')
    ];

    $datos["linkedin"] = [
        "icono" => "fa-linkedin",
        "url" => route('inicio')
    ];

    $datos["github"] = [
        "icono" => "fa-github",
        "url" => route('inicio')
    ];

    $datos["telegram"] = [
        "icono" => "fa-telegram",
        "url" => route('inicio')
    ];

    $datos["youtube"] = [
        "icono" => "fa-youtube",
        "url" => route('inicio')
    ];

    $datos["twitch"] = [
        "icono" => "fa-twitch",
        "url" => route('inicio')
    ];

    $datos["discord"] = [
        "icono" => "fa-discord",
        "url" => route('inicio')
    ];

    $datos["snapchat"] = [
        "icono" => "fa-snapchat",
        "url" => route('inicio')
    ];

    $datos["pinterest"] = [
        "icono" => "fa-pinterest",
        "url" => route('inicio')
    ];

    $datos["reddit"] = [
        "icono" => "fa-reddit",
        "url" => route('inicio')
    ];

    $datos["tiktok"] = [
        "icono" => "fa-tiktok",
        "url" => route('inicio')
    ];

        return view('inicio', $datos);
    }
}

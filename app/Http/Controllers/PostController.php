<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

private function DatosGeneralesDeLaEmpresa()
{
        $datos["nombre_empresa"] = "La Ruta del Sabor";
        $datos["eslogan_empresa"] = "Siempre visible, Siempre a tiempo.";
        $datos["logo_empresa"] = "Imagenes/La Ruta Del Sabor_Logo.ico";
        $datos["descripcion_empresa"] = "Plataforma digital que conecta clientes 
        con comerciantes ambulantes de comida mediante geolocalización y tecnología segura.";
        $datos['derechos_reservados_empresa'] = [
                'icono' => 'bi bi-c-circle',
                'anio' => date('Y'),
                'texto' => 'Todos los derechos reservados.'
];

        return $datos;
}

private function DatosConoceMas()
{
        $datos["enlace_inicio"] = [
            "icono" => 'bi bi-house me-1',
            "texto" => 'Inicio',
            "url" => route('inicio')
        ];

        $datos["enlace_registro"] = [
            "icono" => "bi-person-plus",
            "texto" => "Registrarse",
            "url" => route('registro')
        ];

        $datos["enlace_carrito"] = [
            "icono" => "bi-cart",
            "texto" => "Carrito",
            "url" => route('carrito') 
        ];

        $datos["enlace_ayuda"] = [
        "icono" => "bi-question-circle",
        "texto" => "Ayuda",
        "url" => route('ayuda')
        ];

        $datos["enlace_contacto"] = [
        "icono" => "bi-envelope",
        "texto" => "Contacto",
        "url" => route('contacto')
        ];
        return $datos;
}

private function DatosCategorias()
{
        $datos = [
                'titulo' => 'Categorías',
                'items' => [
                    ['texto' => 'Comidas', 'url' => route('comida'), 'icono' => 'bi-basket'],
                    ['texto' => 'Snack’s', 'url' => route('snack'), 'icono' => 'bi-egg-fried'],
                    ['texto' => 'Postres', 'url' => route('postre'), 'icono' => 'bi-cup-straw'],
                    ['texto' => 'Panadería', 'url' => route('panaderia'), 'icono' => 'bi-bag'],
                    ['texto' => 'Productos de temporada', 'url' => route('producto_temporada'), 'icono' => 'bi-calendar-check'],
                    ['texto' => 'Bebidas', 'url' => route('bebida'), 'icono' => 'bi-cup']
                ]
];
return $datos;
}

private function DatosNuestrosComerciantes()
{
        $datos = [
                'titulo' => 'Nuestros Comerciantes',
                'items' => [
                    ['texto' => 'Cerca de mí', 'url' => route('cerca_mi'), 'icono' => 'bi-geo-alt'],
                    ['texto' => 'Mejor calificados', 'url' => route('mejor_calificados'), 'icono' => 'bi-star'],
                    ['texto' => 'Nuevos', 'url' => route('nuevos_comerciantes'), 'icono' => 'bi-plus-circle'],
                ]
        ];
return $datos;
}

private function DatosAprendeAUsar()
{
        $datos = [
                'titulo' => 'Aprende a usar',
                'items' => [
                    ['texto' => 'Clientes', 'url' => route('clientes'), 'icono' => 'bi-person-lines-fill'],
                    ['texto' => 'Comerciantes', 'url' => route('comerciantes'), 'icono' => 'bi-shop'],
                    ['texto' => 'Pagos', 'url' => route('pagos'), 'icono' => 'bi-credit-card'],
                ]
        ];   
return $datos;     
}

private function DatosRedesSociales()
{

        $datos["facebook"] = [
            "icono" => "fa-facebook",
            "url" => "https://www.facebook.com/?locale=es_LA"
        ];

        $datos["instagram"] = [
            "icono" => "fa-instagram",
            "url" => "https://www.instagram.com/"
        ];

        $datos["x"] = [
            "icono" => "fa-x-twitter",
            "url" => "https://x.com/?lang=es"
        ];

        $datos["whatsapp"] = [
            "icono" => "fa-whatsapp",
            "url" => "https://www.whatsapp.com/?lang=es"
        ];

        $datos["youtube"] = [
            "icono" => "fa-youtube",
            "url" => "https://www.youtube.com/"
        ];

        $datos["tiktok"] = [
            "icono" => "fa-tiktok",
            "url" => "https://www.tiktok.com/"
        ];

        return $datos;
}

 private function DatosBuscador()
{
    // Trae productos con categoría, subcategoría y slug para URL
    $productos = \App\Models\Producto::with(['categoria', 'subcategoria'])
        ->get(['id', 'nombre', 'slug', 'categoria_id', 'subcategoria_id']);

    $datos = [];

    foreach ($productos as $prod) {
        $categoria = $prod->categoria->nombre ?? 'Otros';
        $datos[$categoria][] = [
            'texto' => $prod->nombre,
            'icono' => 'bi-box', // puedes poner un icono genérico o según categoría
            'url' => route('producto', $prod->slug) // ruta a la página del producto
        ];
    }

    return ['DatosBuscador' => $datos];
}


    public function Contacto(){
        $datos = [];

    $datos['generales']    = $this->DatosGeneralesDeLaEmpresa();
    $datos['conoceMas']    = $this->DatosConoceMas();
    $datos['categorias']   = $this->DatosCategorias();
    $datos['comerciantes'] = $this->DatosNuestrosComerciantes();
    $datos['aprende']      = $this->DatosAprendeAUsar();
    $datos['redes']        = $this->DatosRedesSociales();
    $datos['buscador']     = $this->DatosBuscador();
    $datos['titulopagina'] = 'Contacto';

    return view('contacto', $datos);
    }    

}
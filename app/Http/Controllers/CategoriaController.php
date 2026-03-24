<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Subcategoria;

class CategoriaController extends Controller
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
        return [
            "enlace_inicio" => ["icono"=>"bi bi-house me-1","texto"=>"Inicio","url"=>route('inicio')],
            "enlace_registro"=> ["icono"=>"bi-person-plus","texto"=>"Registrarse","url"=>route('registro')],
            "enlace_carrito"=> ["icono"=>"bi-cart","texto"=>"Carrito","url"=>route('carrito')],
            "enlace_contacto"=> ["icono"=>"bi-envelope","texto"=>"Contacto","url"=>route('contacto')]
        ];
    }

    private function DatosCategorias()
    {
        return [
            'titulo'=>'Categorías',
            'items'=>[
                ['texto'=>'Comidas','url'=>route('productos', ['categoria'=>'comida']),'icono'=>'bi-basket'],
                ['texto'=>'Snack’s','url'=>route('productos', ['categoria'=>'snack']),'icono'=>'bi-egg-fried'],
                ['texto'=>'Postres','url'=>route('productos', ['categoria'=>'postres']),'icono'=>'bi-cup-straw'],
                ['texto'=>'Panadería','url'=>route('productos', ['categoria'=>'panaderia']),'icono'=>'bi-bag'],
                ['texto'=>'Bebidas','url'=>route('productos', ['categoria'=>'bebidas']),'icono'=>'bi-cup'],
                ['texto'=>'Productos de temporada','url'=>route('productos', ['categoria'=>'producto_temporada']),'icono'=>'bi-calendar-check']
            ]
        ];
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

    private function cargarDatosBase(&$datos)
    {
        $datos['conoceMas'] = $this->DatosConoceMas();
        $datos['categorias'] = $this->DatosCategorias();
        $datos['generales'] = $this->DatosGeneralesDeLaEmpresa();
    }

    private function cargarProductos(Request $request)
    {
        $categoria_slug = $request->categoria ?? null;

        // Subcategorías según la categoría seleccionada
        $subcategoriaModel = new Subcategoria();
        $subcategorias = $categoria_slug
            ? $subcategoriaModel->ObtenerPorCategoria($categoria_slug)
            : collect(); // vacío si no hay categoría

        // Productos filtrados
        $productoModel = new Producto();
        $productos = $productoModel->ObtenerProductosFiltrados(
            $categoria_slug,
            $request->subcategoria,
            $request->precio_min,
            $request->precio_max,
            $request->rating,
            $request->cp
        )->paginate(12);

        // Precios min y max reales
        $precio_min = Producto::min('precio');
        $precio_max = Producto::max('precio');

        return [
            "subcategorias" => $subcategorias,
            "productos" => $productos,
            "precio_min" => $precio_min,
            "precio_max" => $precio_max,
            "categoria_selected" => $categoria_slug
        ];
    }

private function DatosBuscador()
{
    $productos = \App\Models\Producto::with(['subcategoria.categoria'])->get();

    $datos = [];

    foreach ($productos as $prod) {

        // 🔥 acceder correctamente a la categoría
        $categoria = optional($prod->subcategoria->categoria)->nombre ?? 'Otros';

        if (!isset($datos[$categoria])) {
            $datos[$categoria] = [];
        }

        if (count($datos[$categoria]) < 5) {

            $datos[$categoria][] = [

                'texto' => ($prod->subcategoria->nombre ?? '') . ' > ' . $prod->nombre,

                'icono' => $prod->icono,

                'url' => route('producto', $prod->slug)

            ];
        }
    }

    return ['DatosBuscador' => $datos];
}

public function Productos(Request $request)
{
    $datos = [];
    $this->cargarDatosBase($datos);

    $filtro = $this->cargarProductos($request);

    $datos["subcategorias"] = $filtro["subcategorias"];
    $datos["productos"] = $filtro["productos"];
    $datos["precio_min"] = $filtro["precio_min"];
    $datos["precio_max"] = $filtro["precio_max"];
    $datos["categoria_selected"] = $filtro["categoria_selected"];
    $datos["titulopagina"] = $filtro["categoria_selected"]
        ? ucfirst($filtro["categoria_selected"])
        : "Todos los productos";

    $datos["buscador"] = $this->DatosBuscador();
    

    // Agregar los datos faltantes para menú y footer
    $datos['comerciantes'] = $this->DatosNuestrosComerciantes();
    $datos['aprende']      = $this->DatosAprendeAUsar();
    $datos['redes']        = $this->DatosRedesSociales();
    

    return view("productos", $datos);
}

public function SubcategoriasAjax($categoria_slug)
{
    $subcategorias = \App\Models\Subcategoria::whereHas('categoria', function($q) use ($categoria_slug){
        $q->where('slug', $categoria_slug);
    })->select('id','nombre')->get();

    return response()->json($subcategorias);
}



}
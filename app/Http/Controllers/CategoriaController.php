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
    $categorias = \App\Models\Categoria::all();

    return [
        'titulo' => 'Categorías',
        'items' => $categorias->map(function($cat){
            return [
                'texto' => $cat->nombre,
                'url'   => route('productos', ['categoria' => $cat->slug]),
                'icono' => $cat->icono ?? 'bi-tag'
            ];
        })->toArray() // <- importante convertir a array
    ];
}

 private function DatosMenu()
{
    $tipoUsuario = session('tipo_usuario');

    $query = \App\Models\OpcionMenu::with(['subopciones' => function ($q) use ($tipoUsuario) {

        // Si es comerciante ocultar opciones exclusivas cliente
        if ($tipoUsuario === 'comerciante') {

            $q->whereNotIn('url', [
                '/clientes',
                '/comentarios'
            ]);
        }

    }]);

    // Ocultar menú comentarios al comerciante
    if ($tipoUsuario === 'comerciante') {

        $query->where('slug', '!=', 'aprende')
              ->where('slug', '!=', 'comentarios');
    }

    return $query->orderBy('orden')->get();
}

/*private function DatosNuestrosComerciantes()
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
} */

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
       $categoria_slug = $request->categoria ?? $request->route('categoria');
        $subcategoria   = $request->filled('subcategoria') ? $request->subcategoria : null;
    $precio_min     = $request->filled('precio_min') ? $request->precio_min : null;
    $precio_max     = $request->filled('precio_max') ? $request->precio_max : null;
    $rating         = $request->filled('rating') ? $request->rating : null;
    $cp             = $request->filled('cp') ? $request->cp : null;


        // Subcategorías según la categoría seleccionada
        $subcategoriaModel = new Subcategoria();
        $subcategorias = $categoria_slug
    ? $subcategoriaModel->ObtenerPorCategoria($categoria_slug) ?? collect()
    : collect();
        // Productos filtrados
        $productoModel = new Producto();
        $productos = $productoModel->ObtenerProductosFiltrados(
            $categoria_slug,
            $request->subcategoria,
            $request->precio_min,
            $request->precio_max,
            $request->rating,
            $request->cp
        )->paginate(12)->appends($request->query());

        // Precios min y max reales
        $precio_min = Producto::min('precio');
        $precio_max = Producto::max('precio');

       return [
    "subcategorias" => $subcategorias,
    "productos" => $productos,
    "precio_min" => $precio_min,
    "precio_max" => $precio_max,
    "categoria_selected" => $categoria_slug// <--- Agrega esto
];
    }

private function DatosBuscador()
{
    $productos = \App\Models\Producto::with(['subcategoria.categoria'])->get();

    $datos = [];

    foreach ($productos as $prod) {

        // acceder correctamente a la categoría
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
    
    $datos["categoria_actual"] = $filtro['categoria_selected'];

$datos["titulopagina"] = $datos["categoria_actual"]
        ? ucfirst(str_replace('_', ' ', $datos["categoria_actual"])) 
        : "Todos los productos";
    

    // Agregar los datos faltantes para menú y footer
    $datos['menu']         = $this->DatosMenu();
    $datos['redes']        = $this->DatosRedesSociales();

    $datos["request"] = $request->all();
    

    return view("productos", $datos);
}

public function SubcategoriasAjax($categoria_slug)
{
    $subcategorias = \App\Models\Subcategoria::whereHas('categoria', function($q) use ($categoria_slug){
        $q->where('slug', $categoria_slug);
    })->select('id','nombre')->get();

    return response()->json($subcategorias);
}

// NUEVA INFORMACIÓN EL 03 D EMAYO DEL 2025

public function show($slug)
{
    $datos = [];

    // 🔹 Datos base
    $this->cargarDatosBase($datos);
    $datos['menu']  = $this->DatosMenu();
    $datos['redes'] = $this->DatosRedesSociales();

    // 🔹 Producto con TODAS las relaciones
    $producto = \App\Models\Producto::with([
        'imagenes',
        'subcategoria.categoria',
        'caracteristicas',
        'detalles',
        'stock',
        'colonias' // 🔥 IMPORTANTE (te faltaba en el segundo)
    ])->where('slug', $slug)->firstOrFail();

    // 🔹 Enviar datos a la vista
    $datos['producto'] = $producto;
    $datos['titulopagina'] = $producto->nombre;

    return view('productos_detalle', $datos);
}

}
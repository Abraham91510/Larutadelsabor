<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Pagina;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\DataTables;
use App\Models\Producto;
use App\Models\Subcategoria;

use App\Models\Administrador\QuienesSomos;

use App\Models\Administrador\CarruselPaginaPrincipal;

use App\Models\Administrador\PorqueElegirnos;

use App\Models\Administrador\Beneficio;

use App\Models\Administrador\TipoDeServicio;

use App\Models\Administrador\DatosEmpresa;
use App\Models\Administrador\RedesSociales;
use App\Models\Administrador\EnlacesConoceMas;

class HomeController extends Controller
{
   




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

private function obtenerDestacados()
{
    $destacados = \App\Models\Producto::with(['subcategoria.categoria', 'imagenes'])
        ->where('is_active', 1)
        ->where('is_destacado', 1)
        ->inRandomOrder()
        ->take(4)
        ->get();

    // 🔥 SI NO HAY 4, COMPLETAR CON OTROS
    if ($destacados->count() < 4) {

        $faltantes = 4 - $destacados->count();

        $extra = \App\Models\Producto::with(['subcategoria.categoria', 'imagenes'])
            ->where('is_active', 1)
            ->whereNotIn('id', $destacados->pluck('id'))
            ->inRandomOrder()
            ->take($faltantes)
            ->get();

        $destacados = $destacados->merge($extra);
    }

    return $destacados;
}
    public function inicio(){
        
$datos = [];

    $this->cargarDatosBase($datos);


$datos['menu']         = $this->DatosMenu();
$datos['titulopagina'] = 'Inicio';


    $datos['empresa'] = QuienesSomos::where('is_active',1)->get();

    $datos['carrusel'] = CarruselPaginaPrincipal::where('is_active',1)
        ->orderBy('orden')
        ->get();

        $datos['beneficios'] = PorqueElegirnos::where('is_active', 1)
        ->orderBy('orden')
        ->get();

$datos['beneficios_bancarios'] = Beneficio::where('is_active', 1)
            ->orderBy('orden')
            ->get();

            $datos['tipos_servicios'] = TipoDeServicio::where('is_active', 1)->orderBy('orden')->get();

            $datos['destacados'] = $this->obtenerDestacados();


    return view('inicio', $datos);
    } 

    public function Registro(){
        $datos = [];

    $datos = [];

    $this->cargarDatosBase($datos);


$datos['menu']         = $this->DatosMenu();
$datos['titulopagina'] = 'Registro';

    return view('registro', $datos);
    } 

    public function Carrito(){
        $datos = [];

    $this->cargarDatosBase($datos);


$datos['menu']         = $this->DatosMenu();
$datos['titulopagina'] = 'Carrito';

    return view('carrito', $datos);
    } 

    public function Ayuda(){
        $datos = [];

    $datos = [];

    $this->cargarDatosBase($datos);


$datos['menu']         = $this->DatosMenu();
$datos['titulopagina'] = 'Ayuda';

    return view('ayuda', $datos);
    } 






    private function cargarDatosBase(&$datos)
{
    $empresa = \App\Models\Administrador\DatosEmpresa::first();

    if (!$empresa) {
        $empresa = new \stdClass();
        $empresa->nombre_empresa = '';
        $empresa->eslogan_empresa = '';
        $empresa->logo_empresa = '';
        $empresa->descripcion_empresa = '';
        $empresa->derechos_reservados_empresa = [
            "icono" => "bi bi-c-circle",
            "anio" => date('Y'),
            "texto" => "Todos los derechos reservados."
        ];
    }

    // ✅ GENERALES (IGUAL QUE TU FORMATO ORIGINAL)
    $datos['generales'] = [
        "nombre_empresa" => $empresa->nombre_empresa,
        "eslogan_empresa" => $empresa->eslogan_empresa,
        "logo_empresa" => $empresa->logo_empresa,
        "descripcion_empresa" => $empresa->descripcion_empresa,
        "derechos_reservados_empresa" => $empresa->derechos_reservados_empresa
    ];

    // 🔵 CONOCE MÁS (usa "clave" como índice)
    $datos['conoceMas'] = [];

    $enlaces = \App\Models\Administrador\EnlacesConoceMas::all();

    foreach ($enlaces as $item) {
        $datos['conoceMas'][$item->clave] = [
            "icono" => $item->icono,
            "texto" => $item->texto,
            "url"   => $item->url
        ];
    }

    // 🔵 REDES (usa "clave" como índice)
    $datos['redes'] = [];

    $redes = \App\Models\Administrador\RedesSociales::all();

    foreach ($redes as $item) {
        $datos['redes'][$item->clave] = [
            "icono" => $item->icono,
            "url"   => $item->url
        ];
    }
    
    $datos['categorias'] = $this->DatosCategorias();

    $datos['buscador'] = $this->DatosBuscador();
}





    private function cargarProductos($categoria_slug, Request $request)
    {
        $producto = new Producto();
        $subcategoria = new Subcategoria();

        $subcategorias = $subcategoria->ObtenerPorCategoria($categoria_slug);
        $productos = $producto->ObtenerProductosFiltrados(
            $categoria_slug,
            $request->subcategoria,
            $request->precio_min,
            $request->precio_max,
            $request->rating,
            $request->cp
        );

        return ["subcategorias"=>$subcategorias,"productos"=>$productos];
    }
}

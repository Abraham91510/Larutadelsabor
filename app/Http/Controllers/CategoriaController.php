<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Subcategoria;

class CategoriaController extends Controller
{
    private function DatosGeneralesDeLaEmpresa()
    {
        return [
            "nombre_empresa" => "La Ruta del Sabor",
            "eslogan_empresa" => "Siempre visible, Siempre a tiempo.",
            "logo_empresa" => "Imagenes/La Ruta Del Sabor_Logo.ico",
            "descripcion_empresa" => "Plataforma digital que conecta clientes con comerciantes ambulantes de comida mediante geolocalización y tecnología segura.",
            'derechos_reservados_empresa' => [
                'icono' => 'bi bi-c-circle',
                'anio' => date('Y'),
                'texto' => 'Todos los derechos reservados.'
            ]
        ];
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
                ['texto'=>'Comidas','url'=>route('comida'),'icono'=>'bi-basket'],
                ['texto'=>'Snack’s','url'=>route('snack'),'icono'=>'bi-egg-fried'],
                ['texto'=>'Postres','url'=>route('postre'),'icono'=>'bi-cup-straw'],
                ['texto'=>'Panadería','url'=>route('panaderia'),'icono'=>'bi-bag'],
                ['texto'=>'Productos de temporada','url'=>route('producto_temporada'),'icono'=>'bi-calendar-check'],
                ['texto'=>'Bebidas','url'=>route('bebida'),'icono'=>'bi-cup']
            ]
        ];
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

    private function cargarDatosBase(&$datos)
    {
        $datos['generales'] = $this->DatosGeneralesDeLaEmpresa();
        $datos['conoceMas'] = $this->DatosConoceMas();
        $datos['categorias'] = $this->DatosCategorias();
        $datos['buscador'] = $this->DatosBuscador();
    }

    private function cargarProductos($categoria_slug, Request $request)
{
    $subcategoriaModel = new Subcategoria();
    $subcategorias = $subcategoriaModel->ObtenerPorCategoria($categoria_slug);

    $productoModel = new Producto();
    $productos = $productoModel->ObtenerProductosFiltrados(
        $categoria_slug,
        $request->subcategoria,
        $request->precio_min,
        $request->precio_max,
        $request->rating,
        $request->cp
    );

    return ["subcategorias" => $subcategorias, "productos" => $productos];
}
    public function Comida(Request $request)
    {
        $datos = [];
        $this->cargarDatosBase($datos);

        $filtro = $this->cargarProductos("comida", $request);
        $datos["subcategorias"] = $filtro["subcategorias"];
        $datos["productos"] = $filtro["productos"];
        $datos["titulopagina"] = "Comidas";

        return view("comida", $datos);
    }

    public function Snack(Request $request)
    {
        $datos = [];
        $this->cargarDatosBase($datos);

        $filtro = $this->cargarProductos("snack", $request);
        $datos["subcategorias"] = $filtro["subcategorias"];
        $datos["productos"] = $filtro["productos"];
        $datos["titulopagina"] = "Snack’s";

        return view("snack", $datos);
    }

    public function Postre(Request $request)
    {
        $datos = [];
        $this->cargarDatosBase($datos);

        $filtro = $this->cargarProductos("postres", $request);
        $datos["subcategorias"] = $filtro["subcategorias"];
        $datos["productos"] = $filtro["productos"];
        $datos["titulopagina"] = "Postres";

        return view("postre", $datos);
    }

    public function Panaderia(Request $request)
    {
        $datos = [];
        $this->cargarDatosBase($datos);

        $filtro = $this->cargarProductos("panaderia", $request);
        $datos["subcategorias"] = $filtro["subcategorias"];
        $datos["productos"] = $filtro["productos"];
        $datos["titulopagina"] = "Panadería";

        return view("panaderia", $datos);
    }

    public function Producto_Temporada(Request $request)
    {
        $datos = [];
        $this->cargarDatosBase($datos);

        $filtro = $this->cargarProductos("producto_temporada", $request);
        $datos["subcategorias"] = $filtro["subcategorias"];
        $datos["productos"] = $filtro["productos"];
        $datos["titulopagina"] = "Productos de temporada";

        return view("producto_temporada", $datos);
    }

    public function Bebida(Request $request)
{
    $datos = [];
    $this->cargarDatosBase($datos);

    // Aquí va el slug correcto de la categoría
    $filtro = $this->cargarProductos("bebidas", $request); 
    $datos["subcategorias"] = $filtro["subcategorias"];
    $datos["productos"] = $filtro["productos"];
    $datos["titulopagina"] = "Bebidas";

    return view("bebida", $datos);
}
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComentarioController extends Controller
{

    /* =========================
        DATOS GENERALES
    ========================= */
    private function DatosGeneralesDeLaEmpresa()
    {
        return [
            "nombre_empresa" => "La Ruta del Sabor",
            "eslogan_empresa" => "Siempre visible, Siempre a tiempo.",
            "logo_empresa" => "Imagenes/La Ruta Del Sabor_Logo.ico",
            "descripcion_empresa" => "Plataforma digital que conecta clientes con comerciantes ambulantes.",
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
        $categorias = \App\Models\Categoria::all();

        return [
            'titulo' => 'Categorías',
            'items' => $categorias->map(function($cat){
                return [
                    'texto' => $cat->nombre,
                    'url'   => route('productos', ['categoria' => $cat->slug]),
                    'icono' => $cat->icono ?? 'bi-tag'
                ];
            })->toArray()
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

    private function DatosRedesSociales()
    {
        return [
            "facebook" => ["icono"=>"fa-facebook","url"=>"https://facebook.com"],
            "instagram" => ["icono"=>"fa-instagram","url"=>"https://instagram.com"],
            "x" => ["icono"=>"fa-x-twitter","url"=>"https://x.com"],
            "whatsapp" => ["icono"=>"fa-whatsapp","url"=>"https://whatsapp.com"],
            "youtube" => ["icono"=>"fa-youtube","url"=>"https://youtube.com"],
            "tiktok" => ["icono"=>"fa-tiktok","url"=>"https://tiktok.com"]
        ];
    }

    /* =========================
        BUSCADOR (🔥 CORREGIDO)
    ========================= */
    private function DatosBuscador()
    {
        $productos = \App\Models\Producto::with(['subcategoria.categoria'])->get();

        $datos = [];

        foreach ($productos as $prod) {

            $categoria = optional($prod->subcategoria->categoria)->nombre ?? 'Otros';

            if (!isset($datos[$categoria])) {
                $datos[$categoria] = [];
            }

            if (count($datos[$categoria]) < 5) {

                $datos[$categoria][] = [
                    'texto' => ($prod->subcategoria->nombre ?? '') . ' > ' . $prod->nombre,
                    'icono' => $prod->icono ?? 'bi-search', // 🔥 SOLUCION AL ERROR
                    'url' => route('producto', $prod->slug)
                ];
            }
        }

        return ['DatosBuscador' => $datos];
    }

    /* =========================
        INDEX
    ========================= */
    public function index()
    {
        $datos = [];

        // 🔥 MISMO FORMATO QUE TU CategoriaController
        $datos['generales'] = $this->DatosGeneralesDeLaEmpresa();
        $datos['conoceMas'] = $this->DatosConoceMas();
        $datos['categorias'] = $this->DatosCategorias();
        $datos['menu'] = $this->DatosMenu();
        $datos['redes'] = $this->DatosRedesSociales();
        $datos['buscador'] = $this->DatosBuscador();

        $datos['comentarios'] = []; // luego BD
        $datos['titulopagina'] = "Comentarios";

        return view('comentarios', $datos);
    }

    /* =========================
        GUARDAR
    ========================= */
    public function store(Request $request)
    {
        $request->validate([
            'producto' => 'required',
            'opinion' => 'required',
            'rating' => 'required'
        ]);

        // 🔥 Aquí luego guardas en BD

        return redirect()->route('comentarios')
            ->with('success', 'Comentario enviado correctamente');
    }
}
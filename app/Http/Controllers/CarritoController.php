<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\OpcionMenu;

class CarritoController extends Controller
{
    /* =========================
        DATOS DE APOYO (IDÉNTICOS A CATEGORIACONTROLLER)
    ==========================*/

    private function DatosGeneralesDeLaEmpresa()
    {
        $datos["nombre_empresa"] = "La Ruta del Sabor";
        $datos["eslogan_empresa"] = "Siempre visible, Siempre a tiempo.";
        $datos["logo_empresa"] = "Imagenes/La Ruta Del Sabor_Logo.ico";
        $datos["descripcion_empresa"] = "Plataforma digital que conecta clientes con comerciantes ambulantes de comida mediante geolocalización y tecnología segura.";
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
            "enlace_inicio" => ["icono" => "bi bi-house me-1", "texto" => "Inicio", "url" => route('inicio')],
            "enlace_registro" => ["icono" => "bi bi-person-plus", "texto" => "Registrarse", "url" => route('registro')],
            "enlace_carrito" => ["icono" => "bi bi-cart", "texto" => "Carrito", "url" => route('carrito')],
            "enlace_contacto" => ["icono" => "bi bi-envelope", "texto" => "Contacto", "url" => route('contacto')]
        ];
    }

    private function DatosCategorias()
    {
        $categorias = Categoria::all();
        return [
            'titulo' => 'Categorías',
            'items' => $categorias->map(function ($cat) {
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
            "facebook"  => ["icono" => "fa-facebook", "url" => "https://www.facebook.com/"],
            "instagram" => ["icono" => "fa-instagram", "url" => "https://www.instagram.com/"],
            "x"         => ["icono" => "fa-x-twitter", "url" => "https://x.com/"],
            "whatsapp"  => ["icono" => "fa-whatsapp", "url" => "https://www.whatsapp.com/"],
            "youtube"   => ["icono" => "fa-youtube", "url" => "https://www.youtube.com/"],
            "tiktok"    => ["icono" => "fa-tiktok", "url" => "https://www.tiktok.com/"]
        ];
    }

    private function DatosBuscador()
    {
        // Puedes dejarlo vacío o copiar la lógica de CategoriaController si la necesitas en el carrito
        return ['DatosBuscador' => []];
    }

    private function cargarDatosBase(&$datos)
    {
        $datos['generales']   = $this->DatosGeneralesDeLaEmpresa();
        $datos['conoceMas']   = $this->DatosConoceMas();
        $datos['menu']        = $this->DatosMenu();
        $datos['redes']       = $this->DatosRedesSociales();
        $datos['buscador']    = $this->DatosBuscador();
        $datos['categorias']  = $this->DatosCategorias();
    }

    /* =========================
        VISTAS Y LÓGICA
    ==========================*/

    public function index()
    {
        $datos = [];
        $this->cargarDatosBase($datos);

        $datos['carrito'] = session()->get('carrito', []);
        $datos['titulopagina'] = "Tu Carrito de Compras";

        return view('carrito', $datos);
    }

    public function agregar(Request $request)
    {
        $producto = Producto::with('stock', 'imagenes')->findOrFail($request->producto_id);

        if ($request->cantidad > ($producto->stock->stock ?? 0)) {
            return back()->with('error', 'Stock insuficiente');
        }

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad'] += $request->cantidad;
        } else {
            $imagen = optional($producto->imagenes->first())->imagen;
            $carrito[$producto->id] = [
                "id" => $producto->id,
                "nombre" => $producto->nombre,
                "precio" => $producto->precio,
                "cantidad" => $request->cantidad,
                "imagen" => $imagen ? 'Imagenes/' . basename($imagen) : 'Imagenes/default.png'
            ];
        }

        session()->put('carrito', $carrito);
        return back()->with('success', 'Producto agregado con éxito');
    }

    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }
        return back();
    }

    public function sumar($id)
    {
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
            session()->put('carrito', $carrito);
        }
        return back();
    }

    public function restar($id)
    {
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$id])) {
            if ($carrito[$id]['cantidad'] > 1) {
                $carrito[$id]['cantidad']--;
            } else {
                unset($carrito[$id]);
            }
            session()->put('carrito', $carrito);
        }
        return back();
    }
}
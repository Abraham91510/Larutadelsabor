<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\OpcionMenu;
use App\Models\Cupon;

class CarritoController extends Controller
{

private function DatosConoceMas()
{
    return [
        "enlace_inicio" => [
            "icono" => "bi bi-house me-1",
            "texto" => "Inicio",
            "url" => route('inicio')
        ],
        "enlace_registro" => [
            "icono" => "bi bi-person-plus",
            "texto" => "Registrarse",
            "url" => route('registro')
        ],
        "enlace_carrito" => [
            "icono" => "bi bi-cart",
            "texto" => "Carrito",
            "url" => route('carrito')
        ],
        "enlace_contacto" => [
            "icono" => "bi bi-envelope",
            "texto" => "Contacto",
            "url" => route('contacto')
        ]
    ];
}

    /*
    |--------------------------------------------------------------------------
    | DATOS BASE (IMPORTANTES PARA LAYOUT)
    |--------------------------------------------------------------------------
    */

    private function DatosGeneralesDeLaEmpresa()
    {
        return [
            "nombre_empresa" => "La Ruta del Sabor",
            "eslogan_empresa" => "Siempre visible, Siempre a tiempo.",
            "logo_empresa" => "Imagenes/La Ruta Del Sabor_Logo.ico",
            "descripcion_empresa" => "Plataforma digital que conecta clientes con comerciantes ambulantes de comida.",
            'derechos_reservados_empresa' => [
                'icono' => 'bi bi-c-circle',
                'anio' => date('Y'),
                'texto' => 'Todos los derechos reservados.'
            ]
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

        $query = OpcionMenu::with(['subopciones' => function ($q) use ($tipoUsuario) {
            if ($tipoUsuario === 'comerciante') {
                $q->whereNotIn('url', ['/clientes', '/comentarios']);
            }
        }]);

        if ($tipoUsuario === 'comerciante') {
            $query->whereNotIn('slug', ['aprende', 'comentarios']);
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

    private function cargarDatosBase(&$datos)
    {
        $datos['generales']  = $this->DatosGeneralesDeLaEmpresa();
        $datos['conoceMas']  = $this->DatosConoceMas();
        $datos['menu']       = $this->DatosMenu();
        $datos['redes']      = $this->DatosRedesSociales();
        $datos['categorias'] = $this->DatosCategorias();
    }

    /*
    |--------------------------------------------------------------------------
    | VISTA CARRITO
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $datos = [];
        $this->cargarDatosBase($datos);

        $datos['carrito'] = session('carrito', []);
        $datos['cupon'] = session('cupon');
        $datos['descuento'] = session('descuento', 0);

        $datos['titulopagina'] = "Tu Carrito de Compras";

        return view('carrito', $datos);
    }

    /*
    |--------------------------------------------------------------------------
    | AGREGAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function agregar(Request $request)
    {
        $producto = Producto::with(['stock', 'imagenes', 'comerciantes'])
            ->findOrFail($request->producto_id);

        $stock = optional($producto->stock)->stock ?? 0;
        $cantidad = max(1, (int) $request->cantidad);

        if ($cantidad > $stock) {
            return back()->with('error', 'Stock insuficiente');
        }

        $carrito = session('carrito', []);

        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad'] += $cantidad;
        } else {
            $imagen = optional($producto->imagenes->first())->imagen;

            $carrito[$producto->id] = [
                "id" => $producto->id,
                "nombre" => $producto->nombre,
                "precio" => $producto->precio,
                "cantidad" => $cantidad,
                "negocio" => optional($producto->comerciantes->first())->nombre ?? 'Sin comerciante',
                "imagen" => $imagen ? 'Imagenes/' . basename($imagen) : 'Imagenes/default.png'
            ];
        }

        session()->put('carrito', $carrito);

        session()->save();

        return back()->with('success', 'Producto agregado correctamente');
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function eliminar($id)
    {
        $carrito = session('carrito', []);
        unset($carrito[$id]);
        session()->put('carrito', $carrito);

        return back();
    }

    public function sumar($id)
    {
        $carrito = session('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
            session()->put('carrito', $carrito);
        }

        return back();
    }

    public function restar($id)
    {
        $carrito = session('carrito', []);

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

    /*
    |--------------------------------------------------------------------------
    | CUPONES
    |--------------------------------------------------------------------------
    */

    public function aplicarCupon(Request $request)
    {
        $codigo = strtoupper(trim($request->cupon));

        $cupon = Cupon::where('codigo', $codigo)->first();

        if (!$cupon) {
            return back()->with('error', 'Cupón inválido');
        }

        if (!$cupon->esValido()) {
            return back()->with('error', 'Cupón inválido o expirado');
        }

        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return back()->with('error', 'Carrito vacío');
        }

        $subtotal = 0;

        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }

        $descuento = ($cupon->tipo === 'porcentaje')
            ? ($subtotal * $cupon->descuento / 100)
            : $cupon->descuento;

        session([
            'cupon' => [
                'id' => $cupon->id,
                'codigo' => $cupon->codigo,
                'descuento' => $descuento
            ],
            'descuento' => $descuento
        ]);

        return back()->with('success', 'Cupón aplicado correctamente');
    }
}
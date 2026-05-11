<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TarjetaCliente;

use App\Models\Pedido;
use App\Models\PedidoDetalle;;
use App\Models\Usuario\Cliente;
use App\Models\OpcionMenu;
use App\Models\Cupon;

use Illuminate\Support\Facades\Mail;

use App\Mail\PedidoRealizadoMail;
use App\Mail\PedidoEntregadoMail;

class TarjetaClienteController extends Controller
{

 /*
    |--------------------------------------------------------------------------
    | DATOS BASE (LAYOUT)
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

    private function DatosMenu()
    {
        return OpcionMenu::with('subopciones')
            ->orderBy('orden')
            ->get();
    }

    private function DatosRedesSociales()
    {
        return [
            "facebook" => ["icono" => "fa-facebook", "url" => "#"],
            "instagram" => ["icono" => "fa-instagram", "url" => "#"]
        ];
    }

    private function DatosCategorias()
    {
        return [
            'titulo' => 'Categorías',
            'items' => []
        ];
    }

    private function cargarDatosBase(&$datos)
    {
        $datos['generales'] = $this->DatosGeneralesDeLaEmpresa();
        $datos['conoceMas'] = $this->DatosConoceMas();
        $datos['menu'] = $this->DatosMenu();
        $datos['redes'] = $this->DatosRedesSociales();
        $datos['categorias'] = $this->DatosCategorias();
    }

    /*
    |--------------------------------------------------------------------------
    | MIS PEDIDOS
    |--------------------------------------------------------------------------
    */

    public function misPedidos()
    {
        $cliente = session('usuario');

        if (!$cliente) {
            return redirect('/login/usuario')
                ->with('error', 'Debes iniciar sesión');
        }

        $pedidos = Pedido::where('cliente_id', $cliente->id)
            ->latest()
            ->get();

        $datos = [];
        $this->cargarDatosBase($datos);

        $datos['pedidos'] = $pedidos;
        $datos['titulopagina'] = 'Mis pedidos';

        return view('usuario.vistas.pedidos_usuario', $datos);
    }

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
    /**
     * VISTA PRINCIPAL DE LA TARJETA
     */
    public function index()
    {
        $cliente = session('usuario');
        if (!$cliente) return redirect('/login/usuario');

        $tarjeta = TarjetaCliente::where('cliente_id', $cliente->id)->first();

        $datos = [];
        $this->cargarDatosBase($datos); // 🔥 Esto carga Menú, Logo y Redes Sociales
        
        $datos['tarjeta'] = $tarjeta;
        $datos['titulopagina'] = "Mi Tarjeta de Saldo";

        return view('usuario.vistas.tarjeta', $datos);
    }

    /**
     * FORMULARIO DE REGISTRO
     */
    public function create()
    {
        $datos = [];
        $this->cargarDatosBase($datos);
        $datos['titulopagina'] = "Registrar Nueva Tarjeta";

        return view('usuario.vistas.tarjeta.create', $datos);
    }

    /**
     * GUARDAR EN BASE DE DATOS
     */
    public function store(Request $request)
    {
        $cliente = session('usuario');
        
        $request->validate([
            'titular' => 'required|string|max:100',
            'numero' => 'required|numeric|digits:16',
            'cvv' => 'required|digits:3',
            'expiracion' => 'required|string|max:5', // Formato MM/YY
        ]);

        TarjetaCliente::create([
            'cliente_id' => $cliente->id,
            'titular' => $request->titular,
            'numero' => $request->numero,
            'cvv' => $request->cvv,
            'expiracion' => $request->expiracion,
            'saldo' => 500.00 // Saldo de regalo inicial
        ]);

        return redirect()->route('tarjeta.index')->with('success', '¡Tarjeta vinculada con éxito!');
    }

    /**
     * RECARGAR SALDO
     */
    public function recargar(Request $request)
    {
        $cliente = session('usuario');
        $tarjeta = TarjetaCliente::where('cliente_id', $cliente->id)->first();

        if (!$tarjeta) return back()->with('error', 'No tienes una tarjeta activa.');

        $request->validate(['monto' => 'required|numeric|min:1']);

        $tarjeta->saldo += $request->monto;
        $tarjeta->save();

        return back()->with('success', 'Recarga exitosa. Tu nuevo saldo es: $' . number_format($tarjeta->saldo, 2));
    }
}
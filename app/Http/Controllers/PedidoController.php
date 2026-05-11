<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\TarjetaCliente;
use App\Models\Usuario\Cliente;
use App\Models\OpcionMenu;
use App\Models\Cupon;

use Illuminate\Support\Facades\Mail;

use App\Mail\PedidoRealizadoMail;
use App\Mail\PedidoEntregadoMail;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PedidoController extends Controller
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

    /*
    |--------------------------------------------------------------------------
    | CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function checkout(Request $request)
    {
        $cliente = session('usuario');

        if (!$cliente) {
            return redirect('/login/usuario')
                ->with('error', 'Tu sesión ha expirado');
        }

        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return back()->with('error', 'Carrito vacío');
        }

        $subtotal = 0;

        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }

        $cupon = session('cupon');
        $descuento = $cupon['descuento'] ?? 0;

        $totalFinal = max(0, $subtotal - $descuento);

        $tarjeta = TarjetaCliente::where('cliente_id', $cliente->id)->first();

        if (!$tarjeta) {
            return back()->with('error', 'No tienes tarjeta registrada');
        }

        if ($tarjeta->saldo < $totalFinal) {
            return back()->with('error', 'Saldo insuficiente');
        }

        $tarjeta->saldo -= $totalFinal;
        $tarjeta->save();

        $pedido = Pedido::create([
            'cliente_id' => $cliente->id,
            'folio'      => 'PED-' . time(),
            'subtotal'   => $subtotal,
            'descuento'  => $descuento,
            'total'      => $totalFinal,
            'estado'     => 'pendiente',
            'nota'       => $request->nota ?? null,
        ]);

        foreach ($carrito as $item) {
            PedidoDetalle::create([
                'pedido_id'   => $pedido->id,
                'producto_id' => $item['id'],
                'cantidad'    => $item['cantidad'],
                'precio'      => $item['precio'],
            ]);
        }

        $generales = $this->DatosGeneralesDeLaEmpresa();

        if (!empty($cliente->email)) {
            Mail::to($cliente->email)->send(
                new PedidoRealizadoMail($pedido, $generales)
            );
        }

        session()->forget(['carrito', 'cupon']);

        return redirect()->route('mis.pedidos')
            ->with('success', 'Pedido realizado correctamente');
    }

    /*
    |--------------------------------------------------------------------------
    | QR PEDIDO (CORREGIDO)
    |--------------------------------------------------------------------------
    */

  public function qrPedido($id)
{
    $pedido = Pedido::findOrFail($id);
    $cliente = session('usuario');

    $datos = [];
    $this->cargarDatosBase($datos);

    $datos['pedido'] = $pedido;

    // 🔥 QR DE TEXTO: Esto no requiere internet para leerse.
    // Al escanearlo, el celular mostrará este resumen de texto.
    $texto = "--- DETALLES DEL PEDIDO ---\n";
    $texto .= "Folio: " . $pedido->folio . "\n";
    $texto .= "Cliente: " . ($cliente->nombre ?? 'Cliente') . "\n";
    $texto .= "Total a Pagar: $" . number_format($pedido->total, 2) . "\n";
    $texto .= "Estado: " . strtoupper($pedido->estado) . "\n";
    $texto .= "---------------------------";

    $datos['textoQr'] = $texto;
    $datos['titulopagina'] = "QR del Pedido #" . $pedido->id;

    return view('usuario.vistas.qr_pedido', $datos);
}
    /*
    |--------------------------------------------------------------------------
    | ENTREGAR PEDIDO
    |--------------------------------------------------------------------------
    */

    public function entregar($id)
    {
        $pedido = Pedido::findOrFail($id);

        $pedido->estado = "entregado";
        $pedido->save();

        $cliente = Cliente::find($pedido->cliente_id);

        $generales = $this->DatosGeneralesDeLaEmpresa();

        if ($cliente && $cliente->email) {
            Mail::to($cliente->email)->send(
                new PedidoEntregadoMail($pedido, $generales)
            );
        }

        return back()->with('success', 'Pedido entregado correctamente');
    }
}
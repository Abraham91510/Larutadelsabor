<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class PedidoEntregadoMail extends Mailable
{
    public $pedido;
    public $generales;

    public function __construct($pedido,$generales)
    {
        $this->pedido = $pedido;

        $this->generales = $generales;
    }

    public function build()
    {
        return $this->subject('Pedido entregado')
            ->view('usuario.emails.pedido_entregado');
    }
}
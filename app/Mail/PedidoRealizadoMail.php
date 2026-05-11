<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class PedidoRealizadoMail extends Mailable
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
        return $this->subject('Pedido realizado')
            ->view('usuario.emails.pedido_realizado');
    }
}
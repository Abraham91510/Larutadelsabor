<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistroExitosoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $generales;
    public $tipo;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $generales, $tipo = 'usuario')
    {
        $this->user = $user;

        $this->generales = $generales;

        $this->tipo = $tipo;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): \Illuminate\Mail\Mailables\Envelope
    {
        return new \Illuminate\Mail\Mailables\Envelope(
            subject: 'Bienvenido a ' . $this->generales['nombre_empresa']
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): \Illuminate\Mail\Mailables\Content
    {

        /*
        |--------------------------------------------------------------------------
        | ADMINISTRADOR
        |--------------------------------------------------------------------------
        */

        if ($this->tipo == "admin") {

            return new \Illuminate\Mail\Mailables\Content(
                view: 'administrador.emails.registro_exitoso'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CLIENTE / COMERCIANTE
        |--------------------------------------------------------------------------
        */

        return new \Illuminate\Mail\Mailables\Content(
            view: 'usuario.emails.registro_exitoso'
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
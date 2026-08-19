<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MensagemUsuarioMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $assunto;
    public string $mensagem;

    public function __construct(string $assunto, string $mensagem)
    {
        $this->assunto = $assunto;
        $this->mensagem = $mensagem;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->assunto,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.mensagem_usuario',
            with: [
                'mensagem' => $this->mensagem,
            ],
        );
    }
}
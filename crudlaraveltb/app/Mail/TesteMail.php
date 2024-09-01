<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TesteMail extends Mailable
{
    use Queueable, SerializesModels;

    // Variável pública para armazenar os dados a serem passados para a visão
    public $mailData;

    /**
     * Create a new message instance.
     *
     * @param array $dadosEmail 
     * @return void
     */
    public function __construct($dadosEmail)
    {
        $this->mailData = $dadosEmail;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Teste Mail', // Define o assunto do e-mail
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.emailteste', // Define a visão a ser usada como conteúdo do e-mail
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        // Retorna um array vazio, pois não há anexos para este e-mail
        return [];
    }
}

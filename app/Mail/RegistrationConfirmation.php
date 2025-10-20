<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class RegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    // --- (1) DEKLARASIKAN PROPERTI PUBLIK DI SINI ---
    public $verificationUrl;
    public $userName;

    public function __construct($url, $name)
    {
        $this->verificationUrl = $url;
        $this->userName = $name;
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.register',
            // Data $verificationUrl dan $userName akan tersedia di view
        );
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Selamat Datang di Kpop Mart! Konfirmasi Akun Anda',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

<?php

namespace App\Mail;

use App\Models\Demande;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class DemandeContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $nom_service;

    /**
     * Create a new message instance.
     */
    public function __construct(Demande $demande)
    {
        $this->demande = $demande;
        $this->nom_service = $demande->service->nom_service;
    }

    /**
     * Build the message.
     */
    public function build(): void
    {
        $this->subject('Demande Contact Mail')
            ->from('admin@gmail.com')
            ->markdown('emails.demande.contact', ['demande' => $this->demande, 'nomService' => $this->nom_service]);
    }
}

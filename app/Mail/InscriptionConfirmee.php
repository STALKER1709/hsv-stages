<?php

namespace App\Mail;

use App\Models\Stagiaire;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InscriptionConfirmee extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Stagiaire $stagiaire)
    {
    }

    public function build()
    {
        return $this->subject('Confirmation de votre inscription - HSV Stages')
            ->view('emails.inscription-confirmee');
    }
}

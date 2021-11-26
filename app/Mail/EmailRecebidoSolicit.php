<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class EmailRecebidoSolicit extends Mailable
{
    use Queueable, SerializesModels;

    // public $user, $idSolicitEmail, $typeSolicitFimEmail, $namePctEmail;


    // public function __construct($idSolicit, $typeSolicitFim, $namePct)
    public function __construct()
    {

        // $this->idSolicitEmail = $idSolicit;
        // $this->namePctEmail = $namePct;
        // $this->typeSolicitFimEmail = $typeSolicitFim;
    }


    public function build()
    {

        return $this->subject('Solicitação Recebida')
                    ->view('emails.emailRecebidoSolicit');
                    // ->attach('storage/guias/'.$this->idsolfimEmail.'.jpg');


    }
}

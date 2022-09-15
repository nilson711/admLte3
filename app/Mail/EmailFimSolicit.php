<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class EmailFimSolicit extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $idsolfimEmail, $typeSolicitFimEmail, $obsAtendfimEmail, $pctSolFimEmail, $equipsSolicFimEmail;


    public function __construct($idsolfim, $typeSolicitFim, $obsAtendfim, $pctSolFim, $equipsSolicFim)
    {

        $this->idsolfimEmail = $idsolfim;
        $this->obsAtendfimEmail = $obsAtendfim;
        $this->pctSolFimEmail = $pctSolFim;
        $this->equipsSolicFimEmail = $equipsSolicFim;
        $this->typeSolicitFimEmail = $typeSolicitFim;
    }


    public function build()
    {

        return $this->subject('Solicitação Concluída - nº: '.$this->idsolfimEmail. ' - PCT: '.$this->pctSolFimEmail)
                    ->view('emails.emailFimSolicit');
                    // ->attach('storage/guias/'.$this->idsolfimEmail.'.jpg');


    }
}

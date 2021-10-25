<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class EmailFimSolicit extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $idsolfimEmail, $obsAtendfimEmail, $pctSolFimEmail, $equipsSolicFimEmail;


    public function __construct($idsolfim, $obsAtendfim, $pctSolFim, $equipsSolicFim)
    {
        $this->idsolfimEmail = $idsolfim;
        $this->obsAtendfimEmail = $obsAtendfim;
        $this->pctSolFimEmail = $pctSolFim;
        $this->equipsSolicFimEmail = $equipsSolicFim;
    }


    public function build()
    {

        return $this->subject('Solicitação Concluída')
                    ->view('emails.emailFimSolicit')
                    ->attach('storage/guias/'.$this->idsolfimEmail.'.jpg');

    }
}

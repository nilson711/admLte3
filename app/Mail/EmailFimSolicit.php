<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailFimSolicit extends Mailable
{
    use Queueable, SerializesModels;

    public $idsolfimEmail, $obsAtendfimEmail, $pctSolFimEmail, $idForGuia;

    public function __construct($idsolfim, $obsAtendfim, $pctSolFim)
    {
        $this->idsolfimEmail = $idsolfim;
        $this->obsAtendfimEmail = $obsAtendfim;
        $this->pctSolFimEmail = $pctSolFim;
    }


    public function build()
    {

        // return $this->view('view.name');
        // return $this->view('emailFimSolicit');
        return $this->subject('Solicitação Concluída')
                    ->view('emails.emailFimSolicit')
                    // ->attach('storage/guias/'.$solicFim->id.'.jpg');
                    ->attach('storage/guias/48.jpg');






    }
}

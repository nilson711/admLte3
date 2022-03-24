<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class EmailFimSolicit extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $idsolfimEmail, $typeSolicitFimEmail, $obsAtendfimEmail, $pctSolFimEmail, $equipRentSolicitEmail, $strEndPctFimEmail, $cityPctFimEmail, $celContatoPctFimEmail, $respPctFimEmail;


    public function __construct($idsolfim, $typeSolicitFim, $obsAtendfim, $pctSolFim, $equipRentSolicit, $strEndPct, $cityPct, $celContatoPct, $respPct)
    {

        $this->idsolfimEmail = $idsolfim;
        $this->obsAtendfimEmail = $obsAtendfim;
        $this->pctSolFimEmail = $pctSolFim;
        $this->strEndPctFimEmail = $strEndPct;
        $this->cityPctFimEmail = $cityPct;
        $this->celContatoPctFimEmail = $celContatoPct;
        $this->respPctFimEmail = $respPct;
        $this->equipRentSolicitEmail = $equipRentSolicit;
        $this->typeSolicitFimEmail = $typeSolicitFim;
    }


    public function build()
    {

        return $this->subject('Implantação de O2 - nº: '.$this->idsolfimEmail. ' - PCT: '.$this->pctSolFimEmail)
                    ->view('emails.EmailO2Implantado');
                    // ->attach('storage/guias/'.$this->idsolfimEmail.'.jpg');


    }
}

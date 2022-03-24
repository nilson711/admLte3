<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class EmailFimSolicit extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $idsolfimEmail, $pctSolFimEmail, $equipRentSolicitEmail, $strEndPctFimEmail, $cityPctFimEmail, $celContatoPctFimEmail, $respPctFimEmail, $hsatualEmail;


    public function __construct($idsolfim, $pctSolFim, $equipRentSolicit, $strEndPct, $cityPct, $celContatoPct, $respPct, $hsAtual)
    {

        $this->idsolfimEmail = $idsolfim;
       
        $this->pctSolFimEmail = $pctSolFim;
        $this->strEndPctFimEmail = $strEndPct;
        $this->cityPctFimEmail = $cityPct;
        $this->celContatoPctFimEmail = $celContatoPct;
        $this->respPctFimEmail = $respPct;
        $this->equipRentSolicitEmail = $equipRentSolicit;
        $this->hsatualEmail = $hsAtual;
    
    }


    public function build()
    {

        return $this->subject('kkkkkkk - nº: '.$this->idsolfimEmail. ' - PCT: '.$this->pctSolFimEmail)
                    ->view('emails.EmailO2Recarga');
                    // ->attach('storage/guias/'.$this->idsolfimEmail.'.jpg');


    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Solicitacao;
use App\Models\Pct;
use App\Models\Equipamento;
use App\Models\Cliente;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // verifica se o usuário está logado e busca as informações dele
        if(auth()->check()) {
            $idUser = auth()->user()->id;
            $nameUser = auth()->user()->name;
            $emailUser = auth()->user()->email;
        }

        $solicitacoes = Solicitacao::wherein('status_solicit', [0, 1])->get();

        $allPcts = Pct::all();

        $equips = Equipamento::where('pct_equip', '0')->get();

        $hc = Cliente::all();

        return view('home', ['solicitacoes'=>$solicitacoes] + ['allPcts'=> $allPcts] + ['equips'=> $equips] + ['hc' => $hc] + ['idUser' => $idUser] + ['nameUser'=> $nameUser] + ['emailUser'=>$emailUser]);
    }
}

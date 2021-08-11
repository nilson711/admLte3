<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Solicitacao;

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
        $tasks = DB::SELECT("SELECT * FROM tarefas WHERE visible = 1 ");

        $solicitacoes = new Solicitacao();
        $solicitacoes = DB::SELECT("SELECT S.id, P.name_pct, P.id_hc, S.type_solicit, C.cliente
                        FROM solicitacaos AS S
                        INNER JOIN pcts AS P ON S.pct_solicit = P.id
                        INNER JOIN clientes AS C ON C.id = P.id_hc
                        WHERE s.status_solicit=0");

        return view('home', ['tasks'=> $tasks] + ['solicitacoes'=>$solicitacoes]);
    }
}

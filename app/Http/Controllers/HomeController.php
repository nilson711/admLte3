<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Solicitacao;
use App\Models\Pct;
use App\Models\Equipamento;
use App\Models\Cliente;
use App\Models\Lancamento;

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

        /**
         * No primeiro dia do mês duplicar todos os registros da tb_lançamentos que não tenham sido recolhidos
         * atribuir a dt_inicio como o primeiro dia do mês atual
         * atribuir a dt_fatura como o último dia do mês atual
         */
        
         // Seleciona o dia de hoje
        $hoje = date('d');
        $mes_atual = (date('m'));
        $ano_atual = (date('Y'));
        $mes_ano = $ano_atual."-". $mes_atual;

        $dt_full = date('Y-m-d H:i:s');
        
        
        // duplica os lançamentos que não foram recolhidos para o mês atual
        $lanc_mes_atual = DB::SELECT("
                                SELECT * FROM lancamentos
                                WHERE YEAR(dt_inicio) = $ano_atual 
                                AND MONTH(dt_inicio) = $mes_atual;
                                    ") != null ; //verifica se tem registro do mês e ano atual

        // dd($lanc_mes_atual);
        if ($lanc_mes_atual == false) {
            
            $id_lanc = Lancamento::where('dt_retirada', null)->pluck('id');

            foreach ($id_lanc as $sel_lanc) {
                $sel_lanc = Lancamento::find($sel_lanc);
                $new_lanc = $sel_lanc->replicate()
                                        ->save();
                                        
            }   
                // Lancamento::where('created_at', date('Y-m-d H:i:s'))
              $l =  Lancamento::where('created_at', '>=', $dt_full )
                            ->update(['dt_inicio' => date('Y-m-01'), 'dt_fatura' => date('Y-m-t') ]);
        
        }
         
        

        return view('home', ['solicitacoes'=>$solicitacoes] + ['allPcts'=> $allPcts] + ['equips'=> $equips] + ['hc' => $hc] + ['idUser' => $idUser] + ['nameUser'=> $nameUser] + ['emailUser'=>$emailUser]);
    }
}

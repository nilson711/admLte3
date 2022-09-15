<?php

namespace App\Http\Controllers;

use App\Models\Pct;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\Cliente;
use App\Models\Equipamento;
use App\Models\Fornecedor;
use App\Models\Solicitacao;
use App\Models\Lancamento;
use Carbon\Carbon;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class PctController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listaPcs()
    {
        // $allPcts = new Pct;
        // $allPcts = DB::SELECT("SELECT * FROM pcts  id DESC");
        $allPcts = Pct::all()->reverse();

        $allCities = new Cidade;
        $allCities = DB::SELECT("SELECT * from cidades ORDER BY nome");

        $clientes = new Cliente;
        $clientes = DB::SELECT("SELECT * FROM clientes");


        // seleciona o home care correspondente de cada paciente
        $hcPct = DB::SELECT("SELECT C.cliente, C.id
                            FROM clientes AS C
                            INNER JOIN pcts AS P ON C.id = P.id_hc
                            GROUP BY C.id
                            ");

        return view('pct_list2', ['allPcts'=>$allPcts] + ['allCities'=>$allCities] + ['clientes'=>$clientes] +['hcPct' => $hcPct]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     //ADICIONA NOVO PACIENTE

     public function new_Pct_submit(Request $request){
        //BUSCA OS DADOS OS INPUTS
        $new_Pct = $request->input('Pct');
        $new_peso = $request->input('peso');
        $new_altura = $request->input('altura');
        $new_hc = $request->input('hc');
        $new_responsavel = $request->input('responsavel');
        $new_tel_resp = $request->input('tel_resp');
        $new_resp2 = $request->input('resp2');
        $new_tel_resp2 = $request->input('tel_resp2');

        $new_cep = $request->input('cep');
        $new_rua = $request->input('rua');
        $new_nr = $request->input('nr');
        $new_compl = $request->input('compl');
        $new_bairro = $request->input('bairro');
        $new_city = $request->input('city');
        // $new_uf = $request->input('uf');
        $new_obs = $request->input('obs');

        //SALVA DOS DADOS DOS INPUTS NO BANCO DE DADOS
        $pctNew = new Pct();
        $pctNew->name_pct =  $new_Pct;
        $pctNew->peso =  $new_peso;
        $pctNew->altura =  $new_altura;
        $pctNew->id_hc =  $new_hc;
        $pctNew->resp =  $new_responsavel;
        $pctNew->tel_resp=  $new_tel_resp;
        $pctNew->resp2 =  $new_resp2;
        $pctNew->tel_resp2 =  $new_tel_resp2;

        $pctNew->cep =  $new_cep;
        $pctNew->rua =  $new_rua;
        $pctNew->nr =  $new_nr;
        $pctNew->compl =  $new_compl;
        $pctNew->bairro =  $new_bairro;
        $pctNew->city =  $new_city;
        // $pctNew->uf_pct =  $new_uf;
        $pctNew->obs =  $new_obs;

        $pctNew->save();

        return redirect()->route('listaPcs');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function funcRetornar(){
        return back();
     }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pct  $pct
     * @return \Illuminate\Http\Response
     */
    public function show(Pct $pct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pct  $pct
     * @return \Illuminate\Http\Response
     */


    /////////////////SELECIONA O PACIENTE ATUAL E EXIBE SUAS INFORMAÇÕES PARA EDIÇÃO /////////////////////

    public function editPct($id)
    {

        $allPcts = new Pct;
        $allPcts = DB::SELECT("SELECT * FROM pcts ORDER BY name_pct");

        $allCities = new Cidade;
        $allCities = DB::SELECT("SELECT * from cidades ORDER BY nome");

        $clientes = new Cliente;
        $clientes = DB::SELECT("SELECT * FROM clientes");

        
        $equipsPct = new Equipamento();
        $equipsPct = DB::SELECT("SELECT * FROM equipamentos AS E  WHERE E.pct_equip = $id ");
        
        $mes_atual = (date('m'));
        $ano_atual = (date('Y'));
        $mes_ano = $ano_atual."-". $mes_atual;
        // dd($mes_ano);

        
        $mes_lanc = Lancamento::where('dt_inicio',  $mes_atual)->pluck('dt_inicio', 'id_equip');
        // dd($mes_lanc);

        $equipsLancados = DB::SELECT("SELECT E.patr, E.name_equip, L.id, L.id_equip, L.id_pct, L.id_solicit, L.dt_implantacao, L.dt_inicio, L.dt_retirada, L.dt_fatura, L.dias, L.valor_mes, L.valor_dia, L.valor_cobrado, L.created_at FROM lancamentos AS L  
                                INNER JOIN equipamentos AS E
                                ON L.id_equip = E.id
                                WHERE L.id_pct = $id AND  L.dt_inicio LIKE '$mes_ano%'") //exibe apenas os lancamentos do mês atual
                                ;
                                // WHERE L.id_pct = $id ") //exibe todos os lancamentos

        // Qtd dias do mês atual
        $diasDoMes = date("t");


        // $totalEquips =  DB:: SELECT("SELECT SUM((L.valor_mes/30)*L.dias) 
        $totalEquips =  DB:: SELECT("SELECT SUM((L.valor_mes/$diasDoMes)*L.dias)
                        FROM lancamentos AS L
                        WHERE L.id_pct = $id AND L.dt_inicio LIKE '$mes_ano%' "); //soma apenas os lançamento do mês atual

       
        //CONVERTE O ARRAY $totalEquips EM STRING
        $vlTotalEquip = value($totalEquips[0]); 
        $collectionTotal = collect($vlTotalEquip);           //transforma o array em uma collection
        $strTotal = $collectionTotal->implode(',');    //transforma a collecttion em string



        $equipsCount = Count($equipsPct);


        $equipsEstoque = DB::SELECT("SELECT name_equip FROM equipamentos WHERE pct_equip = 0 AND status_equip = 0 GROUP BY name_equip ORDER BY name_equip");
        $equipsEstoqueCount = Count($equipsEstoque);

        $allEquipsEstoque = DB::SELECT("SELECT name_equip, count(*) AS qtdName FROM equipamentos WHERE pct_equip = 0 AND status_equip = 0 GROUP BY name_equip ORDER BY name_equip");
        //O count(*) faz a contagem em cada tipo de equipamento pelo group e atribui a qtdName e este pode ser buscado na view
        $allEquipsEstoqueCount = Count($allEquipsEstoque);

        $fornecedores =  new Fornecedor();
        $fornecedores = DB::SELECT("SELECT id, name_fornec FROM fornecedors");

        $solicitacoes = new Solicitacao();
        $solicitacoes = DB::SELECT("SELECT id, status_solicit, motivo, equips_solicit, type_solicit, obs_solicit FROM solicitacaos WHERE pct_solicit = $id AND status_solicit < 2");
        $solicitacoesPend = DB::SELECT("SELECT S.id, S.pct_solicit, S.status_solicit, S.motivo, S.equips_solicit, S.type_solicit, S.obs_solicit, S.date_agenda, S.hour_agenda, P.bairro, P.city, Y.nome
                                        FROM solicitacaos AS S
                                        INNER JOIN pcts AS P ON S.pct_solicit = P.id
                                        INNER JOIN cidades AS Y ON Y.id = P.city
                                        WHERE status_solicit < 2 
                                        ORDER BY date_agenda ,  hour_agenda");
        $solicitacoesFim = DB::SELECT("SELECT id, status_solicit, type_solicit, date_solicit, equips_solicit, obs_solicit, obs_atend FROM solicitacaos WHERE pct_solicit = $id AND status_solicit > 1");

        $pctSel = Pct::find($id);

        $cityPct = Cidade::where('id', $pctSel->city)->pluck('id_estado')[0];
        $ufPct = Estado:: where('id', $cityPct)->pluck('uf')[0];

    //    dd($cityPct);
    //    dd($ufPct);
        // $idEquipRecolhe = Equipamento:: where('solicit_equip', $id)->pluck('id');


        

        $recargas = DB::SELECT ("SELECT REC.id AS idrec, REC.id_equip AS rec_id_equip, REC.id_pct, REC.id_fornec, REC.id_hc, REC.preco_recarga, REC.status, REC.created_at FROM recargas as REC
                                WHERE REC.id_pct = $id
                                ");


        $qtdrecargas = (Count($recargas));
        $somarecargas = DB::SELECT ("SELECT SUM(REC.preco_recarga) AS somaRecargas
                                    FROM recargas as REC
                                    WHERE REC.id_pct = $id
                                    ");

    //CONVERTE O ARRAY $somarecargas EM STRING
    $vlSomarecargas = value($somarecargas[0]); 
    $collectionSomarecargas = collect($vlSomarecargas);           //transforma o array em uma collection
    $strvlrecargas = $collectionSomarecargas->implode(',');    //transforma a collecttion em string

    // $totalPct =  ;
    $totalPct = (($strTotal != null) ? $strTotal : 0) + (($strvlrecargas != null) ? $strvlrecargas : 0) ;


        // return view('edit_pct', ['pctSel'=>$pctSel] + ['allPcts'=>$allPcts] + ['allCities'=>$allCities] + ['clientes'=>$clientes]);
        return view('prontuario_pct', ['pctSel'=>$pctSel] + ['recargas' => $recargas] + ['somarecargas' => $somarecargas] + ['qtdrecargas' => $qtdrecargas] + 
        ['diasDoMes'=>$diasDoMes] + ['strTotal'=>$strTotal] + ['equipsLancados'=>$equipsLancados] + ['solicitacoesPend'=>$solicitacoesPend] + ['solicitacoes'=>$solicitacoes] + 
        ['solicitacoesFim'=>$solicitacoesFim] + ['allEquipsEstoqueCount'=>$allEquipsEstoqueCount] + ['allEquipsEstoque'=>$allEquipsEstoque] + ['equipsEstoque'=>$equipsEstoque] + 
        ['equipsEstoqueCount'=>$equipsEstoqueCount] + ['allPcts'=>$allPcts] + ['allCities'=>$allCities] + ['clientes'=>$clientes] + ['equipsPct'=>$equipsPct] + 
        ['fornecedores'=>$fornecedores] + ['equipsCount'=>$equipsCount] + ['totalPct' => $totalPct] + ['ufPct' => $ufPct]);
        // return view('edit_pct', compact('pctSel'));

    }

    /////////////////FAZ UM SUBMIT COM OS DADOS EDITADOS /////////////////////
    public function edit_Pct_submit(Request $request, $id){
         //BUSCA OS DADOS OS INPUTS
         $edit_Pct = $request->input('Pct');
         $edit_peso = $request->input('peso');
         $edit_altura = $request->input('altura');
         $edit_hc = $request->input('hc');
         $edit_responsavel = $request->input('responsavel');
         $edit_tel_resp = $request->input('tel_resp');
         $edit_resp2 = $request->input('resp2');
         $edit_tel_resp2 = $request->input('tel_resp2');

         $edit_cep = $request->input('cep');
         $edit_rua = $request->input('rua');
         $edit_nr = $request->input('nr');
         $edit_compl = $request->input('compl');
         $edit_bairro = $request->input('bairro');
         $edit_city = $request->input('city');
         // $new_uf = $request->input('uf');
         $edit_obs = $request->input('obs');

         //SALVA DOS DADOS DOS INPUTS NO BANCO DE DADOS
        $pctEdit = Pct::find($id);
        $pctEdit->name_pct =  $edit_Pct;
        $pctEdit->peso =  $edit_peso;
        $pctEdit->altura =  $edit_altura;
        $pctEdit->id_hc =  $edit_hc;
        $pctEdit->resp =  $edit_responsavel;
        $pctEdit->tel_resp=  $edit_tel_resp;
        $pctEdit->resp2 =  $edit_resp2;
        $pctEdit->tel_resp2 =  $edit_tel_resp2;

        $pctEdit->cep =  $edit_cep;
        $pctEdit->rua =  $edit_rua;
        $pctEdit->nr =  $edit_nr;
        $pctEdit->compl =  $edit_compl;
        $pctEdit->bairro =  $edit_bairro;
        $pctEdit->city =  $edit_city;
        // $pctNew->uf_pct =  $edit_uf;
        $pctEdit->obs =  $edit_obs;

        $pctEdit->save();

        return back()->withInput();


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pct  $pct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pct $pct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pct  $pct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pct $pct)
    {
        //
    }
}

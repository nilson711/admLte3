<?php

namespace App\Http\Controllers;

use App\Models\Solicitacao;
use App\Models\Equipamento;
use App\Models\Fornecedor;
use App\Models\Pct;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class SolicitacaoController extends Controller
{

    //ADICIONA NOVA SOLICITAÇÃO

    public function new_solicita(Request $request){
        //BUSCA OS DADOS OS INPUTS
        $listEquipSel = $request->input('textEquips');
        $obsSolicitacao = $request->input('obsSolicitacao');
        $idPct = $request->input('idPct');
        $checkUrgente = $request->input('checkUrgente');

        //SALVA DOS DADOS DOS INPUTS NO BANCO DE DADOS
        $solicitacao = new Solicitacao();
        $solicitacao->pct_solicit =  $idPct;
        $solicitacao->type_solicit =  1;                // 1 = implantação
        $solicitacao->equips_solicit =  $listEquipSel;
        $solicitacao->obs_solicit =  $obsSolicitacao;
        $solicitacao->priority =  (isset($checkUrgente))? 1 : 0; //verifica se o check está  marcado. se tiver retorna 1, se não retorna 2

        $solicitacao->save();


        return back()->withInput();
        // return redirect()->route('editPct');
        // echo($listEquipSel);

    }

///========================================================================================================================

////ROTA PARA INICIAR O ATENDIMENTO DA SOLICITAÇÃO ///////
/* coloca o valor do status para 1 para que informe que a solicitação está em andamento */
public function iniciar_solicit(Request $request, $id){
    

    switch ($request->submitbutton) {
        case '0':
            //BUSCA O DADO
            $status1 = $request->input('status');
            //SALVA
            $solicit = Solicitacao::find($id);
            $solicit->status_solicit = 0;
            $solicit->save();
            return back()->withInput();
        break;
        case '1':
            //BUSCA O DADO
            $status1 = $request->input('status');
            //SALVA
            $solicit = Solicitacao::find($id);
            $solicit->status_solicit = 1;
            $solicit->save();
            return back()->withInput();
        break;
        case '2':
            //BUSCA O DADO
            $status1 = $request->input('status');
            //SALVA
            $solicit = Solicitacao::find($id);
            $solicit->status_solicit = 2;
            $solicit->save();
            return back()->withInput();
        break;
        case '3':
            //BUSCA O DADO
            $status1 = $request->input('status');
            //SALVA
            $solicit = Solicitacao::find($id);
            $solicit->status_solicit = 3;
            $solicit->save();
            return back()->withInput();
        break;
            
        default:
            # code...
        break;
    }
}
///========================================================================================================================

    



///========================================================================================================================
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function solicitacoes()
    {
        $solicitacoes = new Solicitacao();
        $solicitacoes = DB::SELECT("SELECT S.id, S.priority, S.status_solicit, P.name_pct, P.id_hc, S.type_solicit, S.date_solicit, C.cliente, P.rua, P.nr, P.bairro, P.compl, S.equips_solicit, S.obs_solicit
                        FROM solicitacaos AS S
                        INNER JOIN pcts AS P ON S.pct_solicit = P.id
                        INNER JOIN clientes AS C ON C.id = P.id_hc
                        WHERE s.status_solicit= 0 OR s.status_solicit= 1
                        ORDER BY S.priority DESC, S.id ASC
                        ");


        return view('solicitacoes', ['solicitacoes'=>$solicitacoes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solicitacao  $solicitacao
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitacao $solicitacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitacao  $solicitacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitacao $solicitacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitacao  $solicitacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitacao $solicitacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitacao  $solicitacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitacao $solicitacao)
    {
        //
    }
}

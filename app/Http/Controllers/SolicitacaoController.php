<?php

namespace App\Http\Controllers;

use App\Models\Solicitacao;
use App\Models\Equipamento;
use App\Models\Fornecedor;
use App\Models\Pct;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SolicitacaoController extends Controller
{

    //ADICIONA NOVA SOLICITAÇÃO

    public function new_solicita(Request $request){
        //BUSCA OS DADOS OS INPUTS
        $listEquipSel = $request->input('textEquips');
        $obsSolicitacao = $request->input('obsSolicitacao');
        $idPct = $request->input('idPct');

        //SALVA DOS DADOS DOS INPUTS NO BANCO DE DADOS
        $solicitacao = new Solicitacao();
        $solicitacao->pct_solicit =  $idPct;
        $solicitacao->type_solicit =  1;                // 1 = implantação
        $solicitacao->equips_solicit =  $listEquipSel;
        $solicitacao->obs_solicit =  $obsSolicitacao;

        $solicitacao->save();

        return back()->withInput();
        // return redirect()->route('editPct');
        // echo($listEquipSel);

    }

///========================================================================================================================

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

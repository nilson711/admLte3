<?php

namespace App\Http\Controllers;

use App\Models\Pct;
use App\Models\Cidade;
use App\Models\Cliente;
use App\Models\Equipamento;
use App\Models\Fornecedor;
use App\Models\Solicitacao;
use Carbon\Carbon;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class PctController extends Controller
{

    public function listaPcs()
    {
        $allPcts = new Pct;
        $allPcts = DB::SELECT("SELECT * FROM pcts ORDER BY name_pct");

        $allCities = new Cidade;
        $allCities = DB::SELECT("SELECT * from cidades ORDER BY nome");

        $clientes = new Cliente;
        $clientes = DB::SELECT("SELECT * FROM clientes");

        return view('pct_list2', ['allPcts'=>$allPcts] + ['allCities'=>$allCities] + ['clientes'=>$clientes]);
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
        $equipsPct = DB::SELECT("SELECT * FROM equipamentos AS E  WHERE E.pct_equip = $id AND E.status_equip = 0 ");
        $equipsCount = Count($equipsPct);

        $equipsEstoque = DB::SELECT("SELECT name_equip FROM equipamentos WHERE pct_equip = 0 GROUP BY name_equip ORDER BY name_equip");
        $equipsEstoqueCount = Count($equipsEstoque);

        $allEquipsEstoque = DB::SELECT("SELECT name_equip, count(*) AS qtdName FROM equipamentos WHERE pct_equip = 0 GROUP BY name_equip ORDER BY name_equip");
        //O count(*) faz a contagem em cada tipo de equipamento pelo group e atribui a qtdName e este pode ser buscado na view
        $allEquipsEstoqueCount = Count($allEquipsEstoque);

        $fornecedores =  new Fornecedor();
        $fornecedores = DB::SELECT("SELECT id, name_fornec FROM fornecedors");

        $solicitacoes = new Solicitacao();
        $solicitacoes = DB::SELECT("SELECT id, status_solicit, equips_solicit, obs_solicit FROM solicitacaos WHERE pct_solicit = $id AND status_solicit < 2");
        $solicitacoesFim = DB::SELECT("SELECT id, status_solicit, type_solicit, date_solicit, equips_solicit, obs_solicit FROM solicitacaos WHERE pct_solicit = $id AND status_solicit > 1");

        $pctSel = Pct::find($id);

        

        // return view('edit_pct', ['pctSel'=>$pctSel] + ['allPcts'=>$allPcts] + ['allCities'=>$allCities] + ['clientes'=>$clientes]);
        return view('prontuario_pct', ['pctSel'=>$pctSel] + ['solicitacoes'=>$solicitacoes] + ['solicitacoesFim'=>$solicitacoesFim] + ['allEquipsEstoqueCount'=>$allEquipsEstoqueCount] + ['allEquipsEstoque'=>$allEquipsEstoque] + ['equipsEstoque'=>$equipsEstoque] + ['equipsEstoqueCount'=>$equipsEstoqueCount] + ['allPcts'=>$allPcts] + ['allCities'=>$allCities] + ['clientes'=>$clientes] + ['equipsPct'=>$equipsPct] + ['fornecedores'=>$fornecedores] + ['equipsCount'=>$equipsCount]);
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

        return redirect()->route('listaPcs');


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

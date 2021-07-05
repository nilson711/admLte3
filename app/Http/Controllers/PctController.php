<?php

namespace App\Http\Controllers;

use App\Models\Pct;
use App\Models\Cidade;
use App\Models\Cliente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PctController extends Controller
{

    public function listaPcs()
    {
        $allPcts = new Pct;
        $allPcts = DB::SELECT("SELECT pcts.id, pcts.name_pct, pcts.peso, pcts.altura, pcts.id_hc, pcts.resp, pcts.tel_resp, pcts.resp2, pcts.tel_resp2, pcts.cep_pct, pcts.rua_pct, pcts.nr_end_pct, pcts.compl_pct, pcts.bairro_pct, pcts.city_pct, pcts.obs_pct, clientes.cliente FROM pcts INNER JOIN clientes ON pcts.id_hc = clientes.id");
        // $allPcts = DB::SELECT("SELECT * FROM pcts ORDER BY name_pct");

        $allCities = new Cidade;
        $allCities = DB::SELECT("SELECT cidades.id, cidades.nome, cidades.id_estado, estados.uf from cidades INNER JOIN estados ON cidades.id_estado = estados.id ORDER BY cidades.nome");

        $clientes = new Cliente;
        $clientes = DB::SELECT("SELECT * FROM clientes");

        return view('pct_list', ['allPcts'=>$allPcts] + ['allCities'=>$allCities] + ['clientes'=>$clientes]);
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
        $pctNew->tel_resp =  $new_tel_resp;
        $pctNew->resp2 =  $new_resp2;
        $pctNew->tel_resp2 =  $new_tel_resp2;

        $pctNew->cep_pct =  $new_cep;
        $pctNew->rua_pct =  $new_rua;
        $pctNew->nr_end_pct =  $new_nr;
        $pctNew->compl_pct =  $new_compl;
        $pctNew->bairro_pct =  $new_bairro;
        $pctNew->city_pct =  $new_city;
        // $pctNew->uf_pct =  $new_uf;
        $pctNew->obs_pct =  $new_obs;

        $pctNew->save();

        return redirect()->route('listaPcs');

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
        // $pct = DB::SELECT("SELECT * FROM pcts WHERE id = $id");
        // return redirect()->route('editPct', ['editPct' => $pct]);
        $pctSel = new Pct;
        $pctSel = DB::SELECT("SELECT * FROM pcts WHERE id = $id");
        // echo '<pre>';
        // print_r($pctSel);
        // FAZER CONSULTA E EDIÇÃO PELO AJAX https://pt.stackoverflow.com/questions/261832/editar-dentro-de-um-modal

    }

    /////////////////FAZ UM SUBMIT COM OS DADOS EDITADOS /////////////////////
    public function edit_Pct_submit(Request $request, Pct $id){
        //BUSCA OS DADOS OS INPUTS
        $editId_pct = $request->input('editId_pct');

        $editId_pct = Pct::find($id);
        echo '<pre>';
        print_r($editId_pct);
        // $editId_pct = $request->input('editId_pct');
        // $edit_Pct = $request->input('editPct');
        // $edit_peso = $request->input('editpeso');
        // $edit_altura = $request->input('editaltura');
        // $edit_hc = $request->input('edithc');
        // $edit_responsavel = $request->input('editresponsavel');
        // $edit_tel_resp = $request->input('edittel_resp');
        // $edit_resp2 = $request->input('editresp2');
        // $edit_tel_resp2 = $request->input('edittel_resp2');

        // $edit_cep = $request->input('editcep');
        // $edit_rua = $request->input('editrua');
        // $edit_nr = $request->input('editnr');
        // $edit_compl = $request->input('editcompl');
        // $edit_bairro = $request->input('editbairro');
        // $edit_city = $request->input('editcity');

        // $edit_obs = $request->input('editobs');

        //SALVA DOS DADOS DOS INPUTS NO BANCO DE DADOS

        // $pctEdit = DB::UPDATE("UPDATE pcts WHERE id_pct = $editId_pct");
        // $pctSel = DB::SELECT("SELECT * FROM pcts WHERE id = $id");
        // $pctEdit = DB::update('update users set votes = 100 where name = ?', ['John']);
        // $pctEdit = DB::update('update pcts set votes = 100 where name = ?', ['John']);

        // $pctEdit->name_pct =  $edit_Pct;
        // $pctEdit->peso =  $edit_peso;
        // $pctEdit->altura =  $edit_altura;
        // $pctEdit->id_hc =  $edit_hc;
        // $pctEdit->resp =  $edit_responsavel;
        // $pctEdit->tel_resp =  $edit_tel_resp;
        // $pctEdit->resp2 =  $edit_resp2;
        // $pctEdit->tel_resp2 =  $edit_tel_resp2;

        // $pctEdit->cep_pct =  $edit_cep;
        // $pctEdit->rua_pct =  $edit_rua;
        // $pctEdit->nr_end_pct =  $edit_nr;
        // $pctEdit->compl_pct =  $edit_compl;
        // $pctEdit->bairro_pct =  $edit_bairro;
        // $pctEdit->city_pct =  $edit_city;
        // $pctNew->uf_pct =  $new_uf;
        // $pctEdit->obs_pct =  $edit_obs;

        // $pctEdit->save();
        // return redirect()->route('listaPcs');
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

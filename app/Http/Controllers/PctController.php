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
        $allPcts = DB::SELECT("SELECT * FROM pcts ORDER BY name_pct");

        $allCities = new Cidade;
        $allCities = DB::SELECT("SELECT * from cidades ORDER BY nome");

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

        $pctSel = Pct::find($id);
        // echo '<pre>';
        // print_r($pctSel);
        // return $pctSel;
        
        return view('edit_pct', ['pctSel'=>$pctSel] + ['allPcts'=>$allPcts] + ['allCities'=>$allCities] + ['clientes'=>$clientes]);
        // return view('edit_pct', compact('pctSel'));
        
        // FAZER CONSULTA E EDIÇÃO PELO AJAX https://pt.stackoverflow.com/questions/261832/editar-dentro-de-um-modal

    }

    /////////////////FAZ UM SUBMIT COM OS DADOS EDITADOS /////////////////////
    public function edit_Pct_submit(Request $request, $id){
        $pctSel = Pct::find($id);
        echo '<pre>';
        print_r($pctSel);
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

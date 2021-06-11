<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\Fornecedor;
use App\Models\Pct;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use \ DB;

class EquipamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
     ///========================================================================================================================

    //LISTA TODOS OS EQUIPAMENTOS DO BANCO DE DADOS
    public function listaEquips(){
        $equips = new Equipamento();
        $equips = DB::SELECT("SELECT * FROM equipamentos WHERE pct_equip = 0");
        // $equips = DB::SELECT("SELECT * FROM equipamentos");

        $equipsImplantados = new Equipamento();
        $equipsImplantados = DB::SELECT("SELECT * FROM equipamentos WHERE pct_equip > 0");

        $fornecedores =  new Fornecedor();
        $fornecedores = DB::SELECT("SELECT id, name_fornec FROM fornecedors");

        $allPcts = new Pct;
        $allPcts = DB::SELECT("SELECT id, name_pct FROM pcts ORDER BY name_pct");

        return view('equipament_list', ['equips'=>$equips] + ['fornecedores'=>$fornecedores] + ['allPcts'=>$allPcts] + ['equipsImplantados'=>$equipsImplantados]);
    }
    ///========================================================================================================================

    //ADICIONA NOVO EQUIPAMENTO

    public function newEquipSubmit(Request $request){
        //BUSCA OS DADOS OS INPUTS
        $newpatr = $request->input('patr');
        $newname_equip = $request->input('name_equip');
        $newmodelo_equip = $request->input('modelo_equip');
        $newmarca_equip = $request->input('marca_equip');

        $newrent_equip = $request->input('rent_equip','0');
        $newvalue_rent_empresa = $request->input('value_rent_empresa');
        $newdata_rent = $request->input('data_rent','0');

        $newvaluePct = $request->input('valuePct','0');

        $newdesc_equip = $request->input('desc_equip');
        // $newrepair_equip = $request->input('repair_equip','0');

        //SALVA DOS DADOS DOS INPUTS NO BANCO DE DADOS
        $equipForm = new Equipamento();
        $equipForm->patr =  $newpatr;
        $equipForm->name_equip =  $newname_equip;
        $equipForm->modelo_equip =  $newmodelo_equip;
        $equipForm->marca_equip =  $newmarca_equip;

        $equipForm->rent_empresa =  $newvalue_rent_empresa;
        $equipForm->rent_equip =  $newrent_equip;
        $equipForm->data_rent =  $newdata_rent;

        $equipForm->pct_equip = $newvaluePct;

        $equipForm->desc_equip =  $newdesc_equip;
        // $equipForm->repair_equip =  $newrepair_equip;

        $equipForm->save();

        return redirect()->route('listaEquips');

    }

///========================================================================================================================
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
     * @param  \App\Models\Equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function show(Equipamento $equipamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipamento $equipamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipamento $equipamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipamento $equipamento)
    {
        //
    }
}

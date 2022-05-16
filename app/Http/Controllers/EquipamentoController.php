<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\Fornecedor;
use App\Models\Lancamento;
use App\Models\Recarga;
use App\Models\Pct;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
// use \ DB;

class EquipamentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
     ///========================================================================================================================

    //LISTA TODOS OS EQUIPAMENTOS DO BANCO DE DADOS
    public function listaEquips(){
        $equips = new Equipamento();
        $equips = DB::SELECT("SELECT * FROM equipamentos WHERE pct_equip = 0 AND status_equip = 0");
        // $equips = DB::SELECT("SELECT * FROM equipamentos");

        $equipsImplantados = new Equipamento();
        $equipsImplantados = DB::SELECT("SELECT * FROM equipamentos WHERE pct_equip > 0 AND status_equip = 0");

        $equipsManutencao = new Equipamento();
        $equipsManutencao = DB::SELECT("SELECT * FROM equipamentos WHERE status_equip = 1");

        $fornecedores =  new Fornecedor();
        $fornecedores = DB::SELECT("SELECT id, name_fornec FROM fornecedors");

        $allPcts = new Pct;
        $allPcts = DB::SELECT("SELECT id, name_pct FROM pcts ORDER BY name_pct");

        return view('equipament_list', ['equips'=>$equips] + ['fornecedores'=>$fornecedores] + ['allPcts'=>$allPcts] + ['equipsImplantados'=>$equipsImplantados] + ['equipsManutencao'=>$equipsManutencao]);
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
    // RECARGA DE OXIGÊNIO
    public function recargaO2($id, $c){

            
        switch ($c) {
            case 'CILINDRO 7M(REGULADOR + BASE)':
                $tipoRecarga = 'RECARGA O2 7M';
                break;
            case 'CILINDRO 8M(REGULADOR + BASE)':
                $tipoRecarga = 'RECARGA O2 8M';
                break;
            case 'CILINDRO 10M(REGULADOR + BASE)':
                $tipoRecarga = 'RECARGA O2 10M';
                break;
            case 'CILINDRO 1M(REGULADOR + CARRINHO)':
                $tipoRecarga = 'RECARGA O2 1M';
                break;
            
            default:
                # code...
                break;
        }

       
        $PctO2recarga = DB::SELECT("SELECT  L.id, L.id_equip AS id_equip, L.id_pct AS id_pct, P.name_pct AS name_pct, P.id_hc AS id_hc, P.rua AS rua, 
        P.nr AS nr, P.compl AS compl, P.bairro AS bairro, P.cep AS cep, P.resp AS resp, P.tel_resp AS tel_resp, P.resp2, P.tel_resp2, C.nome AS cidade, 
        E.name_equip AS equip, E.rent_empresa AS rent_empresa, F.email_fornec AS emailO2, PR.id_hc, PR.preco AS preco   FROM lancamentos AS L

                                    INNER JOIN equipamentos AS E
                                    ON E.id = L.id_equip 
                                    INNER JOIN fornecedors AS F
                                    ON F.id = E.rent_empresa
                                    INNER JOIN pcts AS P
                                    ON P.id = L.id_pct
                                    INNER JOIN precos AS PR
                                    ON PR.id_hc = P.id_hc AND PR.name_equip = '$tipoRecarga'
                                    INNER JOIN cidades AS C
                                    ON C.id = P.city
                                    WHERE L.id = $id");
  

        $idEquip = $PctO2recarga[0]->id_equip;

        $r = Recarga::create(['id_equip' => $PctO2recarga[0]->id_equip, 'id_pct' => $PctO2recarga[0]->id_pct, 'id_fornec' => $PctO2recarga[0]->rent_empresa, 'id_hc' => $PctO2recarga[0]->id_hc, 'preco_recarga'=> $PctO2recarga[0]->preco ]);

        $r = DB::SELECT("SELECT id AS id FROM recargas 
                        WHERE id_equip = $idEquip
                        ORDER BY id DESC limit 1
                        ");

        // dd($r[0]->id);

        $emailEmpO2 = $PctO2recarga[0]->emailO2;
        $namePct = $PctO2recarga[0]->name_pct;
        $strEndPct = $PctO2recarga[0]->rua . " nº:".  $PctO2recarga[0]->nr . " ".  $PctO2recarga[0]->compl . " ". $PctO2recarga[0]->bairro . " - ". $PctO2recarga[0]->cidade;
        $cityPct = $PctO2recarga[0]->cidade;
        $celContatoPct = $PctO2recarga[0]->tel_resp;
        $respPct = $PctO2recarga[0]->resp;
        $equipRentSolicit = $PctO2recarga[0]->equip;

        // Seleciona o hora atual
        $hsAtual = date('H');

        // ENVIA O EMAIL A EMPRESA DE OXIGÊNIO SOLICITANDO A RECARGA
            Mail::send('emails.EmailO2Recarga',
            ['emailEmpO2' => $emailEmpO2,
            'namePct' => $namePct,
            'strEndPct' => $strEndPct,
            'cityPct' => $cityPct,
            'celContatoPct' => $celContatoPct,
            'respPct' => $respPct,
            'idSolicit' => $idSolicit = $r[0]->id,                 //id da recarga
            'equipRentSolicit'=> $equipRentSolicit,
            'hsAtual' => $hsAtual,
            
            ],
            function ($message)
            use ($emailEmpO2, $namePct, $strEndPct, $cityPct, $celContatoPct, $respPct, $idSolicit, $equipRentSolicit, $hsAtual ) {
                $message->from('nilson711@gmail.com', 'Atendimento');
                $message->to($emailEmpO2, 'Email da empresa de O2');
                $message->subject('Solicitação - nº: '.$idSolicit. ' - RECARGA DE O2 - PCT: ' . $namePct);
                
            });

            return back()->withInput();

    }
///========================================================================================================================
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nome = "Nilson";
        $framework = "Laravel";
        $email = "nilson711@gmail.com";
        $whatsapp = "61 99502-2652";
        
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

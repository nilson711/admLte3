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

use App\Mail\EmailFimSolicit;
use Illuminate\Support\Facades\Mail;

use App\Models\Cidade;
use App\Models\Cliente;

use Image;
use stdClass;

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
        $solicitacao->priority =  (isset($checkUrgente))? 1 : 0; //verifica se o check está  marcado. se tiver retorna 1, se não retorna 0

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
            //SE O VALUE DO SBMITBUTTON FOR 0 (RETORNA STATUS PARA 0 - PENDENTE)
            $status1 = $request->input('status');
            //SALVA
            $solicit = Solicitacao::find($id);
            $solicit->status_solicit = 0;
            $solicit->save();
            // return back()->withInput();
            return redirect()->to('/solicitacoes');
        break;
        case '1':
            //SE O VALUE DO SBMITBUTTON FOR 1 (RETORNA STATUS PARA 1 - EM ATENDIMENTO)
            // echo('entrou aqui');
            $status1 = $request->input('status');
            //SALVA
            $solicit = Solicitacao::find($id);
            $solicit->status_solicit = 1;
            $solicit->user_atend = auth()->user()->name;
            $solicit->save();
            // return back()->withInput();
            // return view('solicitacoes');
            return redirect()->to('/solicitacoes');
        break;
        case '2':
            //SE O VALUE DO SBMITBUTTON FOR 2 (RETORNA STATUS PARA 2 - FINALIZADA)
            $status1 = $request->input('status');
            $obs_atend = $request->input('obs_atend');

            // $image = $request->file;
            $nameFile = $request->id . '.' . $request->guia->extension();

            $guia = $request->file('guia')->storeAs('public/guias', $nameFile); // busca no input 'guia' o arquivo e armazena na pasta 'guias'
            $image_resize = $request->file('guia')->storeAs('public/guias', $nameFile); // busca no input 'guia' o arquivo e armazena na pasta 'guias'

            Equipamento::where('solicit_equip', $id)
                    ->update(['status_equip' => 0 ]);

            //SALVA
            $solicit = Solicitacao::find($id);
            $solicit->status_solicit = 2;
            $solicit->obs_atend = $obs_atend;
            $solicit->save();

            $PctAtual = new Pct;
            $PctAtual = Pct::where('id', $solicit->pct_solicit)->pluck('name_pct')->toArray();
            $hcPctAtual = Pct::where('id', $solicit->pct_solicit)->pluck('id_hc');

            // $PctAtual = DB::SELECT("SELECT name_pct FROM pcts WHERE id = 22");

            $pctSolFim = $PctAtual;
            $idsolfim = $id;
            $obsAtendfim = $solicit->obs_atend;
            $equipsSolicFim = Equipamento::where('solicit_equip', $id)->pluck('name_equip', 'patr')->toArray();
            $emailDestino = Cliente::where('id',  $hcPctAtual)->pluck('email');


            $idForGuia = $id;


            // Mail::to('nilson711@hotmail.com')->send(new EmailFimSolicit($nome));
            Mail::to($emailDestino)->cc('nilson711@gmail.com')
                    ->send(new EmailFimSolicit($idsolfim, $obsAtendfim, $pctSolFim, $equipsSolicFim, $idForGuia))
            ;


            // echo 'email enviado';

            // return back()->withInput();
            // return redirect()->to('/fim_solicitacao');
            return redirect()->to('/solicitacoes');
            // return view('emails.emailFimSolicit', ['solicit'=>$solicit]);


        break;
        case '3':
            //SE O VALUE DO SBMITBUTTON FOR 3 (RETORNA STATUS PARA 3 - CANCELADA)
            $status1 = $request->input('status');
            $txtCancel = $request->input('txtCancel');

            //SALVA
            $solicit = Solicitacao::find($id);
            $solicit->status_solicit = 3;
            $solicit->obs_atend =  $txtCancel;
            $solicit->user_atend = auth()->user()->name;
            $solicit->save();
            // return back()->withInput();
            return redirect()->to('/solicitacoes');
        break;

        default:
            # code...
        break;
    }
}
///========================================================================================================================

public function add_equip_pct(Request $request){

    //BUSCA OS DADOS OS INPUTS
    $enviarEquip = $request->input('enviarEquip');  //Este input contém o array separado por vírgula
    $pctForEquip = $request->input('pctForEquip');  //Este input busca o id do paciente
    $solicitForEquip = $request->input('solicitForEquip');  //Este input busca o id da solicitação

    //SELECIONA O EQUIPAMENTO E ATRIBUI O PACIENTE ATUAL A ELE
    foreach (explode(',', $enviarEquip) as $equip){     //separa o o conteúdo do input por vírgula
        if (empty($equip)) {
            //se for nulo não faz nada
        } else {
            $regEquipSelecionado = Equipamento::find($equip);       //busca no Bd o id do equipamento
            $regEquipSelecionado->pct_equip =  $pctForEquip;
            $regEquipSelecionado->solicit_equip = $solicitForEquip;  //atribui o id da solicitação ao equipamento
            $regEquipSelecionado->status_equip = 2;                 //status do equipamento para 2 = solicitado

            $regEquipSelecionado->save();
        }


        // (isset($pctForEquip))? 0 : $pctForEquip;
             //atribui o id do pct ao equipamento


        // echo '<pre>';
        // print_r($regEquipSelecionado);
    }
    // echo("Equipamentos implantados com sucesso!");

    return back()->withInput();

    // echo($pctForEquip);
    // echo($regEquipSelecionado);
}
///========================================================================================================================
 //EXCLUI TODOS OS EQUIPAMENTOS DA SOLICITAÇÃO
 public function cancelAllEquipsSolicit(Request $request, $s_equip){

        Equipamento::where('solicit_equip', $s_equip)
                    ->update(['pct_equip' => 0, 'solicit_equip' => 0, 'status_equip' => 0 ]);

        return back()->withInput();
}



//========================================================================================================================
public function atualizarEstoque($input)
{

$resultado = [];
        foreach ($input as $result) {
            $resultado = $result;
            //dd($resultado['id']);
            $teste = $this->produto
                ->where([['id', $resultado['id']]])
                ->update($resultado, 'estoque');
            }

            return $resultado;
}
///========================================================================================================================
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function solicitacoes()
    {
        $solicitacoes = new Solicitacao();
        $solicitacoes = DB::SELECT("SELECT S.id, S.priority, S.status_solicit, P.name_pct, P.id_hc, S.user_atend, S.type_solicit, S.date_solicit, C.cliente, P.rua, P.nr, P.bairro, P.compl, S.equips_solicit, S.obs_solicit
                        FROM solicitacaos AS S
                        INNER JOIN pcts AS P ON S.pct_solicit = P.id
                        INNER JOIN clientes AS C ON C.id = P.id_hc
                        WHERE s.status_solicit= 0 OR s.status_solicit= 1
                        ORDER BY S.priority DESC, S.id ASC
                        -- ORDER BY S.priority DESC, P.bairro ASC
                        ");

        $equips = new Equipamento();
        $equips = DB::SELECT("SELECT * FROM equipamentos WHERE pct_equip = 0");

        return view('solicitacoes', ['solicitacoes'=>$solicitacoes] + ['equips'=>$equips]);
    }

    /////////////////SELECIONA A SOLICITAÇÃO ATUAL E EXIBE SUAS INFORMAÇÕES PARA EDIÇÃO /////////////////////

    public function edit_solicit($id)
    {


        $pct_sel = new Pct;

        $allCities = new Cidade;
        $allCities = DB::SELECT("SELECT * from cidades ORDER BY nome");

        $clientes = new Cliente;
        $clientes = DB::SELECT("SELECT * FROM clientes");

        $allEquipsEstoque = DB::SELECT("SELECT name_equip, count(*) AS qtdName
                                        FROM equipamentos
                                        WHERE pct_equip = 0
                                        GROUP BY name_equip
                                        ORDER BY name_equip");
        //O count(*) faz a contagem em cada tipo de equipamento pelo group e atribui a qtdName e este pode ser buscado na view
        $allEquipsEstoqueCount = Count($allEquipsEstoque);

        $equips = new Equipamento();
        $equips = DB::SELECT("SELECT * FROM equipamentos WHERE pct_equip = 0");


        $fornecedores =  new Fornecedor();
        $fornecedores = DB::SELECT("SELECT id, name_fornec FROM fornecedors");

        $solicitacoes = new Solicitacao();
        $solicitacoes = DB::SELECT("SELECT equips_solicit, obs_solicit FROM solicitacaos WHERE pct_solicit = $id AND status_solicit=0");

        $solicitSel = Solicitacao::find($id);

        $solicitAtual = DB::SELECT("SELECT S.id AS SolicitId, S.priority, S.status_solicit, S.pct_solicit, P.name_pct, P.id, P.id_hc, S.type_solicit, S.user_atend, S.date_solicit, C.cliente, P.rua, P.nr, P.bairro, P.compl, S.equips_solicit, S.obs_solicit
                        FROM solicitacaos AS S
                        INNER JOIN pcts AS P ON S.pct_solicit = P.id
                        INNER JOIN clientes AS C ON C.id = P.id_hc
                        WHERE S.id = $id
                        ");
                        //Este select com INNER JOIN tem que ser recebido na view por num foeach

        //Seleciona o id do paciente da solicitação atual
        $pctSel = DB::SELECT("SELECT pct_solicit FROM solicitacaos WHERE id = $id");

        //Converte o Array $pctSel em String
        $collection = collect($pctSel);
        $idPctSel = $collection->implode('pct_solicit', ',');

        //Seleciona o nº de patrimônio e nome do equipamento selecionado da solicitação atual
        $equipsSel = DB::SELECT("SELECT patr, name_equip FROM equipamentos WHERE pct_equip = $idPctSel AND solicit_equip = $id;


                        -- INNER JOIN pcts AS PCT ON SOLICIT.pct_solicit = PCT.id
                        -- INNER JOIN equipamentos AS E ON E.id = PCT.id
                        -- WHERE SOLICIT.id = $id
                        ");

        return view('edit_solicit', ['solicitSel'=>$solicitSel] + ['idPctSel'=>$idPctSel] + ['equipsSel'=>$equipsSel] + ['equips'=>$equips] +  compact('solicitAtual'));

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

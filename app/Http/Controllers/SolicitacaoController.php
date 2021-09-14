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

use App\Models\Cidade;
use App\Models\Cliente;


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
            //SE O VALUE DO SBMITBUTTON FOR 0 (RETORNA STATUS PARA 0 - PENDENTE)
            $status1 = $request->input('status');
            //SALVA
            $solicit = Solicitacao::find($id);
            $solicit->status_solicit = 0;
            $solicit->save();
            return back()->withInput();
        break;
        case '1':
            //SE O VALUE DO SBMITBUTTON FOR 1 (RETORNA STATUS PARA 1 - EM ATENDIMENTO)
            $status1 = $request->input('status');
            //SALVA
            $solicit = Solicitacao::find($id);
            $solicit->status_solicit = 1;
            $solicit->save();
            return back()->withInput();
        break;
        case '2':
            //SE O VALUE DO SBMITBUTTON FOR 2 (RETORNA STATUS PARA 2 - FINALIZADA)
            $status1 = $request->input('status');
            //SALVA
            $solicit = Solicitacao::find($id);
            $solicit->status_solicit = 2;

            $solicit->save();
            return back()->withInput();
        break;
        case '3':
            //SE O VALUE DO SBMITBUTTON FOR 3 (RETORNA STATUS PARA 3 - CANCELADA)
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

public function add_equip_pct(Request $request){
    
    //BUSCA OS DADOS OS INPUTS
    $enviarEquip = $request->input('enviarEquip');  //Este input contém o array separado por vírgula
    $pctForEquip = $request->input('pctForEquip');  //Este input busca o id do paciente

    //SELECIONA O EQUIPAMENTO E ATRIBUI O PACIENTE ATUAL A ELE
    foreach (explode(',', $enviarEquip) as $equip){     //separa o o conteúdo do input por vírgula
        $regEquipSelecionado = Equipamento::find($equip);   //busca no Bd o id do equipamento
        $regEquipSelecionado->pct_equip = $pctForEquip;     //atribui o id do pct ao equipamento
       
        $regEquipSelecionado->save();
        // echo '<pre>'; 
        // print_r($regEquipSelecionado);
    }
    echo("Equipamentos implantados com sucesso!");

    // return back()->withInput();

// echo($pctForEquip);
// echo($regEquipSelecionado);
}

///========================================================================================================================
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
        $solicitacoes = DB::SELECT("SELECT S.id, S.priority, S.status_solicit, P.name_pct, P.id_hc, S.type_solicit, S.date_solicit, C.cliente, P.rua, P.nr, P.bairro, P.compl, S.equips_solicit, S.obs_solicit
                        FROM solicitacaos AS S
                        INNER JOIN pcts AS P ON S.pct_solicit = P.id
                        INNER JOIN clientes AS C ON C.id = P.id_hc
                        WHERE s.status_solicit= 0 OR s.status_solicit= 1
                        ORDER BY S.priority DESC, S.id ASC
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

        $solicitAtual = DB::SELECT("SELECT S.id, S.priority, S.status_solicit, P.name_pct, P.id, P.id_hc, S.type_solicit, S.date_solicit, C.cliente, P.rua, P.nr, P.bairro, P.compl, S.equips_solicit, S.obs_solicit
                        FROM solicitacaos AS S
                        INNER JOIN pcts AS P ON S.pct_solicit = P.id
                        INNER JOIN clientes AS C ON C.id = P.id_hc
                        WHERE S.id = $id
                        ");
                        //Este select com INNER JOIN tem que ser recebido na view por num foeach

        return view('edit_solicit', ['solicitSel'=>$solicitSel] + ['pct_sel'=>$pct_sel] + ['equips'=>$equips] +  compact('solicitAtual'));

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

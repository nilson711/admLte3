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
use App\Models\Recarga;

use App\Mail\EmailFimSolicit;
use App\Mail\EmailRecebidoSolicit;

use Illuminate\Support\Facades\Mail;

use App\Models\Cidade;
use App\Models\Cliente;
use App\Models\Lancamento;
// use Image;
use stdClass;

// use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;

class SolicitacaoController extends Controller
{

    // Acesso as rotas de Solicitação retrito a usuários autenticados.
    public function __construct()
    {
        $this->middleware('auth');
    }

    //ADICIONA NOVA SOLICITAÇÃO
    // echo '<pre>';
    // print_r ($namePct);
    // print_r ($emailDestino);
    // print_r ($idSolicit);
    // echo '</pre>';

    public function new_solicita(Request $request){
        switch ($request->submitbuttonSolicit) {
            case '1': //// 1 = implantação


                //BUSCA OS DADOS OS INPUTS
                $listEquipSel = $request->input('textEquips');
                $obsSolicitacao = $request->input('obsSolicitacao');
                $idPct = $request->input('idPct');
                $checkUrgente = $request->input('checkUrgente');
                $dtAgendamento = $request->input('dtAgendamento');
                $hsAgenda = $request->input('horarios');
                $notEmail = $request->input('notEmail');

                //SALVA DOS DADOS DOS INPUTS NO BANCO DE DADOS
                $solicitacao = new Solicitacao();
                // $solicitacao->date_agenda = date('Y-m-d');
                $solicitacao->date_agenda = $dtAgendamento;
                $solicitacao->hour_agenda = $hsAgenda;
                $solicitacao->pct_solicit =  $idPct;
                $solicitacao->type_solicit =  1;                // 1 = implantação
                $solicitacao->equips_solicit =  $listEquipSel;
                $solicitacao->obs_solicit =  $obsSolicitacao;
                $solicitacao->priority =  (isset($checkUrgente))? 1 : 0; //verifica se o check está  marcado. se tiver retorna 1, se não retorna 0
                $solicitacao->save();

                //BUSCA NO BD AS INFORMAÇÕES REFERENTE A SOLICITAÇÃO
                $hcPctAtual = Pct::where('id', $idPct)->pluck('id_hc');
                $emailDestino = Cliente::find($hcPctAtual)->pluck('email')->toArray()[0];
                $emailDestino2 = Cliente::find($hcPctAtual)->pluck('email2')->toArray()[0];

                $namePct = Pct::where('id', $idPct)->pluck('name_pct')->get(0);
                $idSolicit = Solicitacao::where('pct_solicit', $idPct)->pluck('id')->last();
                $itensSolicit = Solicitacao::where('pct_solicit', $idPct)->pluck('equips_solicit')->last();
                $obsSolicit = Solicitacao::where('pct_solicit', $idPct)->pluck('obs_solicit')->last();

                $typeSolicitFim = "Implantação";
                $solicitante = auth()->user()->name;
                // dd($emailDestino);

                if ($notEmail == null) {
                    
                    //ENVIA EMAIL DE RECEBIDO PARA O HOME CARE
                    Mail::send('emails.emailRecebidoSolicit',
                    ['emailDestino' => $emailDestino,
                    'emailDestino2' => $emailDestino2,
                    'namePct' => $namePct,
                    'typeSolicitFim' => $typeSolicitFim,
                    'idSolicit' => $idSolicit,
                    'itensSolicit'=> $itensSolicit,
                    'obsSolicit' =>  $obsSolicit,
                    'solicitante' => $solicitante
                    ],
                    function ($message)
                    use ($emailDestino, $emailDestino2, $namePct, $typeSolicitFim, $idSolicit, $itensSolicit,  $obsSolicit, $solicitante ) {
                        $message->from('atendimento@requestcare.online', 'Atendimento'); //este email tem que ser o mesmo que está no arquivo .ENV
                        $message->to([$emailDestino, $emailDestino2]);
                        // $message->cc(['mhsuprimentos.atendimento@gmail.com']);
                        $message->cc(['mhsuprimentos.atendimento@gmail.com', 'atendimento@mhsuprimentos.com']);
                        $message->subject($typeSolicitFim . ' nº: '.$idSolicit. ' - PCT: '. $namePct);
                    });
                }

                return back()->withInput();

            break;
            case '2': case '3': //// 2 = recolhimento 3=troca / manutenção

                if ($request->submitbuttonSolicit == 2) {
                    $listEquipSel = $request->input('EquipRecolhe');
                    $obsSolicitacao = $request->input('obsSolicitacaoRecolhe');
                    $idPct = $request->input('idPctRecolhe');
                    $motivo = $request->input('motivo');
                    $dtAgendamento = $request->input('dtAgendamentoRecolhe');
                    $horarios = $request->input('horariosRecolhe');
                    $enviarEquip = $request->input('enviarEquipRecolhe');  //Este input contém o array separado por vírgula
                    $notEmailRecolhe = $request-> input('notEmailRecolhe');
                    
                } else {
                    $listEquipSel = $request->input('textEquipsTroca');
                    $obsSolicitacao = $request->input('obsSolicitacaoTroca');
                    $idPct = $request->input('idPctTroca');
                    $motivo = null;
                    $dtAgendamento = $request->input('dtAgendamentoRecolhe');
                    $horarios = $request->input('horariosTroca');
                    $enviarEquip = $request->input('enviarEquipTroca');  //Este input contém o array separado por vírgula
                    $notEmailRecolhe = $request-> input('notEmailTroca');
                }
                
                
                // dd($request->all());
                //SALVA DOS DADOS DOS INPUTS NO BANCO DE DADOS
                $solicitacao = new Solicitacao();
                $solicitacao->pct_solicit =  $idPct;
                $solicitacao->motivo = $motivo;
                $solicitacao->date_agenda = $dtAgendamento;
                $solicitacao->hour_agenda = $horarios;
                $solicitacao->type_solicit =  $request->submitbuttonSolicit;    
                $solicitacao->equips_solicit =  $listEquipSel;
                $solicitacao->obs_solicit =  $obsSolicitacao;
                $solicitacao->save();

                //BUSCA NO BD AS INFORMAÇÕES REFERENTE A SOLICITAÇÃO
                $hcPctAtual = Pct::where('id', $idPct)->pluck('id_hc');
                $emailDestino = Cliente::find($hcPctAtual)->pluck('email')->toArray()[0];
                $emailDestino2 = Cliente::find($hcPctAtual)->pluck('email2')->toArray()[0];

                $namePct = Pct::where('id', $idPct)->pluck('name_pct')->get(0);
                $idSolicit = Solicitacao::where('pct_solicit', $idPct)->pluck('id')->last();
                $itensSolicit = Solicitacao::where('pct_solicit', $idPct)->pluck('equips_solicit')->last();
                $obsSolicit = Solicitacao::where('pct_solicit', $idPct)->pluck('obs_solicit')->last();

                $solicitacao->where('pct_solicit', $idPct)->get();  //Busca no BD a Solicitação deste paciente

                
                
                //SELECIONA OS EQUIPAMENTOS E ATRIBUI STATUS COMO RECOLHER
                foreach (explode(',', $enviarEquip) as $equip){                 //separa o o conteúdo do input por vírgula
                    if (empty($equip)) {
                        //se for nulo não faz nada
                    } else {
                            $recolheEquipSelecionado = Equipamento::find($equip);       //busca no Bd o id do equipamento
                            // $recolheEquipSelecionado->pct_equip =  $pctForEquip;
                            $recolheEquipSelecionado->solicit_equip = $solicitacao->id;  //atribui o id da solicitação ao equipamento
                            $motivo == 7? $recolheEquipSelecionado->status_equip = 1 : $recolheEquipSelecionado->status_equip = 3;
                            ;                 //status do equipamento para 1 = reparo /3 = recolher
                            $recolheEquipSelecionado->save();
                            }
                    }

                    if ($request->submitbuttonSolicit == 3 ) {
                        $typeSolicitFim = "Troca / Manutenção";
                    } else {
                        $typeSolicitFim = "Recolhimento";
                    }
                    $solicitante = auth()->user()->name;
                    // $itensSolicit = Equipamento::where('solicit_equip', $solicitacao->id)->pluck('equips_solicit');

                    
                    if ($notEmailRecolhe == null) {
                        # code...
                    
                        // ENVIA EMAIL DE RECEBIDO PARA O HOME CARE
                        Mail::send('emails.emailRecebidoSolicit',
                        ['emailDestino' => $emailDestino,
                        'emailDestino2' => $emailDestino2,
                        'namePct' => $namePct,
                        'typeSolicitFim' => $typeSolicitFim,
                        'idSolicit' => $idSolicit,
                        'itensSolicit'=> $itensSolicit,
                        'obsSolicit' =>  $obsSolicit,
                        'solicitante' => $solicitante
                        ],
                        function ($message)
                        use ($emailDestino, $emailDestino2, $namePct, $typeSolicitFim, $idSolicit, $itensSolicit,  $obsSolicit, $solicitante ) {
                            $message->from('atendimento@requestcare.online', 'Atendimento'); //este email tem que ser o mesmo que está no arquivo .ENV
                            $message->to([$emailDestino, $emailDestino2]);
                            // $message->cc(['mhsuprimentos.atendimento@gmail.com']);
                            $message->cc(['mhsuprimentos.atendimento@gmail.com', 'atendimento@mhsuprimentos.com', 'atendimento@mhsuprimentos.com']);
                            $message->subject($typeSolicitFim . ' nº: '.$idSolicit. ' - PCT: '. $namePct);
                        });
                    }
                return back()->withInput();

                // dd($request->all());
            break;
           
        }

    }

///========================================================================================================================

////ROTA PARA INICIAR O ATENDIMENTO DA SOLICITAÇÃO ///////
/* coloca o valor do status para 1 para que informe que a solicitação está em andamento */
public function iniciar_solicit(Request $request, $id){

    // dd($request->all());
    
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
            
            $status1 = $request->input('status');
            //SALVA
            $solicit = Solicitacao::find($id);
            $solicit->status_solicit = 1;
            $solicit->user_atend = auth()->user()->name;
            $idPct = $solicit->pct_solicit;
            $solicit->save();

            $hcPctAtual = Pct::where('id', $idPct)->pluck('id_hc');
            $emailDestino = Cliente::find($hcPctAtual)->pluck('email')->toArray()[0];
            $emailDestino2 = Cliente::find($hcPctAtual)->pluck('email2')->toArray()[0];
            

            $namePct = Pct::where('id', $idPct)->pluck('name_pct')->get(0);
            $idSolicit = Solicitacao::where('id', $id)->pluck('id')->get(0);
            $itensSolicit = Solicitacao::where('id', $id)->pluck('equips_solicit')->get(0);
            $obsSolicit = Solicitacao::where('id', $id)->pluck('obs_solicit')->get(0);

            return redirect()->to('/solicitacoes');
        break;
        case '2':
            //SE O VALUE DO SBMITBUTTON FOR 2 (RETORNA STATUS PARA 2 - FINALIZADA)
            $status1 = $request->input('status');
            $obs_atend = $request->input('obs_atend');

                        
            // se a solicitação for diferente de troca ele habilita o input para inserir a guia


            // Equipamento::where('solicit_equip', $id)
            //         ->update(['status_equip' => 0 ]);

            //SALVA
            $solicit = Solicitacao::find($id);
            // $solicit->status_solicit = 2;
            
            $trocaMant = $request->rTM;
            
            // ANEXA A GUIA
            if ($solicit->type_solicit < 6 AND $request->rTM != "M" ) {
                
                // o arquivo será o nº da solicitação em formato JPG
                $nameFile = $request->id . '.' . 'jpg'; 
               
                // local onde o arquivo será salvo, na pasta pública do storage
                $local = storage_path() . '\app\public\guias/' . $nameFile ;
                
                // busca no input guia o arquivo imagem, redimenciona e salva no $local 
                Image::make($request->file('guia'))
                        ->resize(800, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })
                        ->save($local);
            }

            $solicit->obs_atend = $obs_atend;
            $solicit->save();
            $idPct = $solicit->pct_solicit;


            $PctAtual = new Pct;
            $PctAtual = Pct::where('id', $solicit->pct_solicit)->pluck('name_pct')->get(0);
            $hcPctAtual = Pct::where('id', $solicit->pct_solicit)->pluck('id_hc');

            $pctSolFim = $PctAtual;
            $idsolfim = $id;
            $obsAtendfim = $solicit->obs_atend;

            $equipsSolicFim = Equipamento::get(['patr', 'name_equip', 'solicit_equip'])->where('solicit_equip', $id);

            $emailDestino = Cliente::where('id',  $hcPctAtual)->pluck('email');
            $emailDestino2 = Cliente::where('id',  $hcPctAtual)->pluck('email2');
            $nameHc = Cliente::find($hcPctAtual)->pluck('cliente')->get(0);

            $idForGuia = $id;

            $hcPctAtual = Pct::where('id', $idPct)->pluck('id_hc');
            $emailDestino = Cliente::find($hcPctAtual)->pluck('email')->toArray()[0];
            $emailDestino2 = Cliente::find($hcPctAtual)->pluck('email2')->toArray()[0];

            $namePct = Pct::where('id', $idPct)->pluck('name_pct')->get(0);
            $telPct = Pct::where('id', $idPct)->pluck('tel_resp')->get(0);

            //Busca o Endereço do paciente
            $endPct =  DB::SELECT("SELECT CONCAT(rua, ' Nº ', nr, compl, bairro ) AS endereco FROM pcts
                                    WHERE id = $idPct 
                                    ;");
            
             //CONVERTE O ARRAY $totalEquips EM STRING
            $vlendPct = value($endPct[0]); 
            $collectionEndPct = collect($vlendPct);           //transforma o array em uma collection
            $strEndPct = $collectionEndPct->implode(',');    //transforma a collecttion em string
            
            //Busca o nome da cidade do paciente
            $nrCity = Pct::where('id', $idPct)->pluck('city')->get(0);
            $cityPct = Cidade::where('id', $nrCity)->pluck('nome')->get(0);

            //Busca o contato do paciente
            $celContatoPct = Pct::where('id', $idPct)->pluck('tel_resp')->get(0);
            $respPct = Pct::where('id', $idPct)->pluck('resp')->get(0);

            $idSolicit = Solicitacao::where('id', $id)->pluck('id')->get(0);
            // $itensSolicit = Solicitacao::where('pct_solicit', $idPct)->pluck('equips_solicit')->last();
            // $obsSolicit = Solicitacao::where('pct_solicit', $idPct)->pluck('obs_solicit')->last();
            $itensSolicit = Solicitacao::where('id', $id)->pluck('equips_solicit')->get(0);
            $obsSolicit = Solicitacao::where('id', $id)->pluck('obs_solicit')->get(0);

            
            switch ( $solicit->type_solicit) {
                case 1: case 3:
                    
                    $a = 0;
                    
                        //BUSCA OS DADOS OS INPUTS
                        //    $enviarEquip = $request->input('enviarEquip');  //Este input contém o array separado por vírgula
                        $enviarEquip = Equipamento::where('solicit_equip', $id)->pluck('id'); /// Busca os Equipamentos solicitados na solicitação atual
                        
                        if ($solicit->type_solicit == 1) {
                            $typeSolicitFim = "Implantação";
                        } else {
                            if ($request->rTM == "M") {
                                $typeSolicitFim = "Manutenção";
                            } else {
                                $typeSolicitFim = "Troca";
                                $equipTroca = Equipamento::where('solicit_equip', $id)->where('status_equip', 0)->pluck('id');
                                // converte o Array $equipTroca em String
                                $collectionTroca = collect($equipTroca);
                                $retiraEquip = $collectionTroca->implode(','); //lista de equips para retirar separados por vírgula
                                // dd($retiraEquip);

                                //SELECIONA O EQUIPAMENTO E RETIRA ELE DO PACIENTE (RETORNA PRO ESTOQUE)
                                foreach (explode(',', $retiraEquip) as $equipRetirado) {
                                    if (empty($equipRetirado)) {
                                        # se for nulo não faz nada
                                    } else {
                                        $tiraEquip = Equipamento::find($equipRetirado);     //busca no Bd o id do equipamento
                                        $tiraEquip->pct_equip =  0;                         //coloca pct zero (retorna equipamento pro estoque)
                                        $tiraEquip->save();
                                        dd($tiraEquip);
                                    }
                                    
                                }
                            }
                        }
                        

                        //Converte o Array $enviarEquip em String
                        $collection = collect($enviarEquip);
                        $addEquipLancamento = $collection->implode(',');    //adicionar cada elemento numa collection separada por vírgula
                        
                        // dd($addEquipLancamento);

                        //SELECIONA O EQUIPAMENTO E ATRIBUI O PACIENTE ATUAL A ELE
                        foreach (explode(',', $addEquipLancamento) as $equip){                 //separa o o conteúdo do array por vírgula
                            if (empty($equip)) {
                                //se for nulo não faz nada
                            } else {

                                //diferença entre o último dia do mês e a data atual
                                $diasRestaMes = (date("t") - date("d"))+1;

                                //id_hc do paciente
                                $nrHcPct = $hcPctAtual->get(0);
                                
                                //BUSCA O PREÇO DO EQUIPAMENTO NA TABELA PREÇO
                                $preco = DB::SELECT("SELECT P.preco FROM equipamentos AS E
                                                    INNER JOIN precos AS P
                                                    ON P.name_equip = E.name_equip
                                                    WHERE E.id = $equip AND P.id_hc = $nrHcPct
                                                    ;");
                                    
                                    //CONVERTE O ARRAY $PREÇO EM STRING
                                    $vlpreco = value($preco[0]); 
                                    $collectionpreco = collect($vlpreco);           //transforma o array em uma collection
                                    $addEpreco = $collectionpreco->implode(',');    //transforma a collecttion em string

                                    // dd($addEpreco);

                                    //INSERE OS REGISTROS DOS EQUIPAMENTOS IMPLANTADOS NA TABELA DE LANÇAMENTOS PARA COBRANÇA
                                    //o formato date("Y-m-t") com o "t" no final, determina o último dia do mês
                                    Lancamento::create(['id_equip' => $equip, 'id_pct' => $idPct, 'id_hc' => $nrHcPct, 'id_solicit' => $idSolicit, 'dt_implantacao' => date(now()),  'dt_inicio' => date(now()), 'dt_fatura' => date("Y-m-t"), 'dias'=> $diasRestaMes, 'valor_mes'=> $addEpreco ]);

                                    // Busca se o equip é terceirizado
                                    $rentEquip = Equipamento::where('id', $equip)->pluck('rent_equip');
                                    $vlrentEquip = value($rentEquip[0]);
                                    
                                    //SE O EQUIPAMENTO FOR TERCEIRIZADO ENVIA EMAIL INFORMANDO A IMPLANTAÇÃO
                                    if ($vlrentEquip == 1) {
                                        # code...
                                        // dd('é terceirizado');
                                        // Buscar o id do fornecedor do oxigenio
                                        $idFornecEquip = Equipamento::where('id', $equip)->pluck('rent_empresa');
                                        $vlidFornecEquip = value($idFornecEquip[0]);

                                        $old = Equipamento::get(['patr', 'name_equip', 'solicit_equip'])->where('solicit_equip', $id && 'rent_empresa', "5" );

                                        $equipRentSolicit = DB::SELECT("SELECT E.patr, E.name_equip FROM equipamentos AS E
                                                                        WHERE E.solicit_equip = $id AND E.rent_empresa = $vlidFornecEquip
                                                                        ;");

                                        // BUSCAR O EMAIL DO FORNECEDOR DE O2
                                        $emailEmpO2 = Fornecedor::where('id', $vlidFornecEquip )->pluck('email_fornec')->toArray()[0];
                                        
                                        
                                        // $vlemailEmpO2 = value($emailEmpO2[0]);
                                        
                                        // SE FOR CILINDRO LANÇA A RECARGA INICIAL NA TABELA RECARGAS
                                        if (strpos($equipRentSolicit[0]->name_equip, 'REGULADOR')) {    //VERIFICA SE EXISTE A PALAVRA 
                                            switch ($equipRentSolicit[0]->name_equip) {
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
                                                    WHERE L.id_equip = $equip");
                                    
                                                // dd($PctO2recarga);

                                            $r = Recarga::create(['id_equip' => $equip, 'id_pct' => $idPct, 'id_fornec' => $vlidFornecEquip, 'id_hc' => $nrHcPct, 'preco_recarga'=> $PctO2recarga[0]->preco ]);
                                        }
                                        // ENVIA EMAIL PARA EMPRESA TERCEIRIZADA
                                        // Mail::send('emails.EmailO2Implantado',
                                        // ['emailEmpO2' => $emailEmpO2,
                                        // 'namePct' => $namePct,
                                        // 'strEndPct' => $strEndPct,
                                        // 'cityPct' => $cityPct,
                                        // 'celContatoPct' => $celContatoPct,
                                        // 'respPct' => $respPct,
                                        // 'typeSolicitFim' => $typeSolicitFim,
                                        // 'idSolicit' => $idSolicit,
                                        // 'equipRentSolicit'=> $equipRentSolicit,
                                        // 'obsSolicit' =>  $obsSolicit,
                                        // 'obsAtendfim' => $obsAtendfim
                                        // ],
                                        // function ($message)
                                        // use ($emailEmpO2, $namePct, $strEndPct, $cityPct, $celContatoPct, $respPct, $typeSolicitFim, $idSolicit, $equipRentSolicit,  $obsSolicit, $obsAtendfim ) {
                                        //     $message->from('atendimento@requestcare.online', 'Atendimento'); //este email tem que ser o mesmo que está no arquivo .ENV
                                        //     $message->to($emailEmpO2);
                                        //     // $message->cc(['mhsuprimentos.atendimento@gmail.com']);
                                        //     $message->cc(['mhsuprimentos.atendimento@gmail.com', 'atendimento@mhsuprimentos.com']);
                                        //     $message->subject('IMPLANTAÇÃO - Solicitação - nº: '.$idSolicit. ' - PCT: ' . $namePct);
                                        //     // $message->attach('pathToFile');
                                        //     // $message->attach('storage/guias/'.$idSolicit.'.jpg');
                                        // });
                                    } 

                            }
                        }

                    break;
                case 2:
                    
                   $typeSolicitFim = "Recolhimento";
                                   
                    $idEquipRecolhe = Equipamento:: where('solicit_equip', $id)->pluck('id');
                    $emailDestino = Cliente::find($hcPctAtual)->pluck('email')->toArray()[0];
                    $emailDestino2 = Cliente::find($hcPctAtual)->pluck('email2')->toArray()[0];
                   
                   //Converte o Array $idEquipRecolhe em String
                   $collectionRec = collect($idEquipRecolhe);
                   $recEquipLancamento = $collectionRec->implode(',');

                   foreach (explode(',', $recEquipLancamento) as $equipLancamento) {
                    // busca a data de inicio da cobrança   
                        $dataInicio = Lancamento::where('id_equip', $equipLancamento)->pluck('dt_inicio');
                        
                        // Converte a data dt_inicio em String
                        $collect_dt_ini = collect($dataInicio);
                        $str_dt_ini = $collect_dt_ini -> implode(',');
                        
                        // Seleciona somente o dia da data de inicio
                        $diaInicio = (date('d', strtotime($str_dt_ini)));

                        // Seleciona o dia de hoje
                        $hoje = date('d');

                        // Subtrai a data de hoje - dt_inicio para calcular os dias a serem cobrados.
                       $diasCobrar = ($hoje - $diaInicio)+1;

                        // Atualiza a tabela lançamentos com as datas e dias
                        Lancamento::where('id_equip', $equipLancamento)
                       ->update(['dt_retirada' => date('Y-m-d'), 'dt_fatura' => date('Y-m-d'), 'dias' => $diasCobrar]);
                       
                    }
                    // Retorna o equipamento para o estoque
                    Equipamento::where('solicit_equip', $id)
                    ->update(['pct_equip' => 0, 'solicit_equip' => 0, 'status_equip' => 0 ]);

                    

                    break;
                case 33:
                    // TROCA
                    if ($request->rTM == "M") {
                        $typeSolicitFim = "Manutenção";
                    } else {
                        $typeSolicitFim = "Troca";
                    }
                    
                    // dd($request->rTM .' '. $typeSolicitFim);

                    // só vai dar baixa no equipamento se for necessário
                    //    Equipamento::where('solicit_equip', $id)
                    //     ->update(['pct_equip' => 0, 'solicit_equip' => 0, 'status_equip' => 0 ]);

                    //BUSCA OS DADOS OS INPUTS
                    $enviarEquipTroca = $request->input('enviarEquipTroca');  //Este input contém o array separado por vírgula
                    $pctForEquip = $idPct;  //Este input busca o id do paciente
                    $solicitForEquip = $id;  //Este input busca o id da solicitação
                    
                    // dd($enviarEquipTroca);
                    //SELECIONA O EQUIPAMENTO E ATRIBUI O PACIENTE ATUAL A ELE
                    foreach (explode(',', $enviarEquipTroca) as $equip){                 //separa o o conteúdo do input por vírgula
                        if (empty($equip)) {
                            //se for nulo não faz nada
                        } else {
                            $regEquipSelecionado = Equipamento::find($equip);       //busca no Bd o id do equipamento
                            $regEquipSelecionado->pct_equip =  $pctForEquip;        //atribui o id do pctatual ao equipamento
                            $regEquipSelecionado->solicit_equip = $solicitForEquip;  //atribui o id da solicitação ao equipamento
                            $regEquipSelecionado->status_equip = 2;                 //status do equipamento para 2 = solicitado
                            $regEquipSelecionado->save();
                            
                        }
                    }

                    // A TROCA FOI FEITA?

                    // SIM FOI FEITA
                        // atribui o equip ao pct 

                    // NÃO FOI FEITA
                        // retorna os equips selecionados (status=2) p/ estoque

                    return back()->withInput();

                    break;
                case 4:
                   $typeSolicitFim = "Mudança de Localidade";
                    break;
                case 5:
                    $typeSolicitFim = "Recolhimento Total";
                    break;
                case 6:
                    $typeSolicitFim = "Cilindro de O2";
                    break;

                default:
                    # code...
                    break;
            }

           sleep(5);
        
            
            // ENVIA O EMAIL DE SOLICITAÇÃO CONCLUÍDA COM A GUIA EM ANEXO
            Mail::send('emails.EmailFimSolicit',
            ['emailDestino' => $emailDestino,
            'emailDestino2' => $emailDestino2,
            'namePct' => $namePct,
            'typeSolicitFim' => $typeSolicitFim,
            'idSolicit' => $idSolicit,
            'equipsSolicFim'=> $equipsSolicFim,
            'obsSolicit' =>  $obsSolicit,
            'obsAtendfim' => $obsAtendfim,
            'trocaManut' => $trocaMant
            ],
            function ($message)
            use ($emailDestino, $emailDestino2, $namePct, $typeSolicitFim, $idSolicit, $equipsSolicFim,  $obsSolicit, $obsAtendfim, $trocaMant ) {
                $message->from('atendimento@requestcare.online', 'Atendimento'); //este email tem que ser o mesmo que está no arquivo .ENV
                $message->to([$emailDestino, $emailDestino2]);
                // $message->cc(['mhsuprimentos.atendimento@gmail.com', 'atendimento@requestcare.online']);
                $message->cc(['mhsuprimentos.atendimento@gmail.com', 'atendimento@mhsuprimentos.com']);
                $message->subject('Solicitação Concluída - nº: '.$idSolicit. ' - PCT: ' . $namePct);
                // $message->attach('pathToFile');
                if ($trocaMant == "M") {
                    // se for Manutenção não anexa guia
                }else {
                    $message->attach('storage/guias/'.$idSolicit.'.jpg');
                }
            });

            $solicit->status_solicit = 2;
            $solicit->save();

            $strId =  strval ($idSolicit) ;
            // dd($strId);
            // dd("/msg/$strId/$namePct/$nameHc");
            return redirect()->to('/solicitacoes');
            
           
                    
                    //Converte o Array $equipsSolicFim em String
                    // $collectionEqMsg = $equipsSolicFim->get();
                    // $equipmsgStr = $collectionEqMsg->implode(',');    //adicionar cada elemento numa collection separada por vírgula
                    
            $jEquips = $equipsSolicFim->toJson();
            $contatoClient = $telPct;
            // dd($contatoClient);


            // // abre a view finalizada e aciona o robo para enviar mensagem pelo whatsapp
            // if ($obsAtendfim == null) {
            //     $obsmsg = "N";
            //     // abre a página para envio de mensagem do Whatsapp
            //     return redirect()->to("http://localhost:8001/msg/$strId/$namePct/$nameHc/$obsmsg/$typeSolicitFim/$jEquips");
            //     // dd("http://localhost:8001/msg/$strId/$namePct/$nameHc/$obsmsg/$typeSolicitFim");
            // } else {
            //     $obsmsg = $obsAtendfim;
            //     // abre a página para envio de mensagem do Whatsapp
            //     return redirect()->to("http://localhost:8001/msg/$strId/$namePct/$nameHc/$obsmsg/$typeSolicitFim/$jEquips");
            //     // dd("http://localhost:8001/msg/$strId/$namePct/$nameHc/$obsmsg/$typeSolicitFim");
            // }
            


            



        break;
        case '3':
            //SE O VALUE DO SBMITBUTTON FOR 3 (RETORNA STATUS PARA 3 - CANCELADA)
            $status1 = $request->input('status');
            $txtCancel = $request->input('txtCancel');

            // VALIDAÇÃO DO CANCELAMENTO 
            // Rules (regras de validação do campos)
            $request->validate([
                'txtCancel' => 'required|min:10'
            ],
            // Mensagem de retorno das regras
            [
                'txtCancel.required' => 'Cancelamento não enviado. Tente novamente. Especifique o motivo do Cancelamento',
                'txtCancel.min' => 'Cancelamento não enviado. Tente novamente. O texto informado é inválido.'
                
            ]
        );
            // dd($txtCancel);

            //SALVA
            $solicit = Solicitacao::find($id);
            $solicit->status_solicit = 3;
            $solicit->obs_atend =  $txtCancel;
            $solicit->user_atend = auth()->user()->name;
            $solicit->save();
            return back()->withInput();
            // return redirect()->to('/solicitacoes');
            
            // APÓS SALVAR ENVIAR EMAIL INFORMANDO O CANCELAMENTO 

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
    foreach (explode(',', $enviarEquip) as $equip){                 //separa o o conteúdo do input por vírgula
        if (empty($equip)) {
            //se for nulo não faz nada
        } else {
            $regEquipSelecionado = Equipamento::find($equip);       //busca no Bd o id do equipamento
            $regEquipSelecionado->pct_equip =  $pctForEquip;
            $regEquipSelecionado->solicit_equip = $solicitForEquip;  //atribui o id da solicitação ao equipamento
            $regEquipSelecionado->status_equip = 2;                 //status do equipamento para 2 = solicitado
            $regEquipSelecionado->save();

        }
    }

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

///========================================================================================================================
 //CANCELA A SOLICITAÇÃO 
public function cancelar_solicit($id){
    // $solicitCancel = Solicitacao::find($id);
   dd($id);
}


///========================================================================================================================
 //EXCLUI APENAS O EQUIPAMENTO ATUAL DA SOLICITAÇÃO
public function cancelOneEquipSolicit (Request $request, $idEquip, $solicit_equip){
    // echo 'cancelar apenas este' . $idEquip ;

    // dd($solicit_equip);
    $solicitAtual = Solicitacao::find($solicit_equip);

    switch ($solicitAtual->type_solicit) {
        case '1': case '3':     // se for IMPLANTAÇÃO OU TROCA retira o equipamento do paciente e da solicitação e retorna ele para o estoque
                Equipamento::where('id', $idEquip)
                        ->update(['pct_equip' => 0, 'solicit_equip' => 0, 'status_equip' => 0 ]);
                        return back()->withInput();
            break;
        case '2':     //se for RECOLHIMENTO retira o equipamento da solicitação e ele continua no paciente
            Equipamento::where('id', $idEquip)
                        ->update(['solicit_equip' => 0 ]);
                        return back()->withInput();
            break;

        default:
            # code...
            break;
    }


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
        $solicitacoes = DB::SELECT("SELECT S.id, Y.nome, S.priority, S.status_solicit, S.motivo, P.name_pct, P.id_hc, S.user_atend, S.type_solicit, S.date_solicit, S.date_agenda, S.hour_agenda, C.cliente, P.rua, P.nr, P.bairro, P.city, P.compl, S.equips_solicit, S.obs_solicit
                        FROM solicitacaos AS S
                        INNER JOIN pcts AS P ON S.pct_solicit = P.id
                        INNER JOIN clientes AS C ON C.id = P.id_hc
                        INNER JOIN cidades AS Y ON Y.id = P.city
                        WHERE s.status_solicit= 0 OR s.status_solicit= 1 
                        ORDER BY S.priority ASC, S.id ASC
                        -- ORDER BY P.bairro ASC
                        ");

        $solicitCanceladas = DB::SELECT("SELECT CONCAT(P.rua, ' Nº ', P.nr, P.compl, P.bairro ) AS endereco, S.id, Y.nome, S.priority, S.status_solicit, S.motivo, P.name_pct, P.id_hc, S.user_atend, 
                            S.type_solicit, S.date_solicit, C.cliente, P.rua, P.nr, P.bairro, P.city, P.compl, S.equips_solicit, S.obs_solicit, S.obs_atend
                            FROM solicitacaos AS S
                            INNER JOIN pcts AS P ON S.pct_solicit = P.id
                            INNER JOIN clientes AS C ON C.id = P.id_hc
                            INNER JOIN cidades AS Y ON Y.id = P.city
                            WHERE s.status_solicit = 3 AND DATE_FORMAT(S.updated_at, '%Y-%m-%d') = CURDATE()
                            ORDER BY S.priority DESC, S.id ASC
                            -- ORDER BY S.priority DESC, P.bairro ASC
                            ");


        // dd($solicitCanceladas);
        $equips = new Equipamento();
        $equips = DB::SELECT("SELECT * FROM equipamentos WHERE pct_equip = 0 AND status_equip = 0");

        // dd($nrCityStr);
        return view('solicitacoes', ['solicitacoes'=>$solicitacoes] + ['equips'=>$equips] + ['solicitCanceladas' => $solicitCanceladas]);
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
        $equips = DB::SELECT("SELECT * FROM equipamentos WHERE pct_equip = 0 AND status_equip = 0");


        $fornecedores =  new Fornecedor();
        $fornecedores = DB::SELECT("SELECT id, name_fornec FROM fornecedors");

        $solicitacoes = new Solicitacao();
        $solicitacoes = DB::SELECT("SELECT equips_solicit, obs_solicit FROM solicitacaos WHERE pct_solicit = $id AND status_solicit=0");

        $solicitSel = Solicitacao::find($id);

        $solicitAtual = DB::SELECT("SELECT S.id AS SolicitId, S.date_agenda, S.hour_agenda, S.priority, S.status_solicit, S.pct_solicit, P.name_pct, P.tel_resp, P.tel_resp2, P.resp, P.resp2, P.id, P.id_hc, 
                                    S.type_solicit, S.user_atend, S.date_solicit, C.cliente, P.rua, P.nr, P.bairro, P.city, P.compl, S.equips_solicit, S.obs_solicit
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

        //Busca o nome da cidade do paciente
        $nrCity = Pct::where('id', $idPctSel)->pluck('city')->get(0);
        $cityPct = Cidade::where('id', $nrCity)->pluck('nome')->get(0);


        //Seleciona o nº de patrimônio e nome do equipamento selecionado da solicitação atual
        $equipsSel = DB::SELECT("SELECT id, patr, name_equip, solicit_equip, status_equip FROM equipamentos WHERE pct_equip = $idPctSel AND solicit_equip = $id;


                        -- INNER JOIN pcts AS PCT ON SOLICIT.pct_solicit = PCT.id
                        -- INNER JOIN equipamentos AS E ON E.id = PCT.id
                        -- WHERE SOLICIT.id = $id
                        ");
        // dd($equipsSel);

        return view('edit_solicit', ['solicitSel'=>$solicitSel] + ['cityPct'=>$cityPct] + ['idPctSel'=>$idPctSel] + ['equipsSel'=>$equipsSel] + ['equips'=>$equips] +  compact('solicitAtual'));

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
            // Mail::send('emails.EmailO2Recarga',
            // ['emailEmpO2' => $emailEmpO2,
            // 'namePct' => $namePct,
            // 'strEndPct' => $strEndPct,
            // 'cityPct' => $cityPct,
            // 'celContatoPct' => $celContatoPct,
            // 'respPct' => $respPct,
            // 'idSolicit' => $idSolicit = $r[0]->id,                 //id da recarga
            // 'equipRentSolicit'=> $equipRentSolicit,
            // 'hsAtual' => $hsAtual,
            
            // ],
            // function ($message)
            // use ($emailEmpO2, $namePct, $strEndPct, $cityPct, $celContatoPct, $respPct, $idSolicit, $equipRentSolicit, $hsAtual ) {
            //     $message->from('atendimento@requestcare.online', 'Atendimento'); //este email tem que ser o mesmo que está no arquivo .ENV
            //     $message->to($emailEmpO2, 'Email da empresa de O2');
            //     $message->subject('Solicitação - nº: '.$idSolicit. ' - RECARGA DE O2 - PCT: ' . $namePct);
                
            // });


            return back()->withInput();

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

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
use App\Mail\EmailRecebidoSolicit;

use Illuminate\Support\Facades\Mail;

use App\Models\Cidade;
use App\Models\Cliente;
use App\Models\Lancamento;
use Image;
use stdClass;

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

                //SALVA DOS DADOS DOS INPUTS NO BANCO DE DADOS
                $solicitacao = new Solicitacao();
                $solicitacao->pct_solicit =  $idPct;
                $solicitacao->type_solicit =  1;                // 1 = implantação
                $solicitacao->equips_solicit =  $listEquipSel;
                $solicitacao->obs_solicit =  $obsSolicitacao;
                $solicitacao->priority =  (isset($checkUrgente))? 1 : 0; //verifica se o check está  marcado. se tiver retorna 1, se não retorna 0
                $solicitacao->save();

                //BUSCA NO BD AS INFORMAÇÕES REFERENTE A SOLICITAÇÃO
                $hcPctAtual = Pct::where('id', $idPct)->pluck('id_hc');
                $emailDestino = Cliente::find($hcPctAtual)->pluck('email')->toArray();
                $emailDestino2 = Cliente::find($hcPctAtual)->pluck('email2')->toArray();

                $namePct = Pct::where('id', $idPct)->pluck('name_pct')->get(0);
                $idSolicit = Solicitacao::where('pct_solicit', $idPct)->pluck('id')->last();
                $itensSolicit = Solicitacao::where('pct_solicit', $idPct)->pluck('equips_solicit')->last();
                $obsSolicit = Solicitacao::where('pct_solicit', $idPct)->pluck('obs_solicit')->last();

                $typeSolicitFim = "Implantação";
                $solicitante = auth()->user()->name;

                // //ENVIA EMAIL DE RECEBIDO PARA O HOME CARE
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
                    $message->from('nilson711@gmail.com', 'Atendimento');
                    $message->to($emailDestino, 'Email do Home Care');
                    $message->cc($emailDestino2, 'Email do Home Care');
                    $message->subject($typeSolicitFim . ' nº: '.$idSolicit. ' - PCT: '. $namePct);
                });

                return back()->withInput();

            break;
            case '2': //// 2 = recolhimento
                $listEquipSel = $request->input('textEquipsRecolhe');
                $obsSolicitacao = $request->input('obsSolicitacaoRecolhe');
                $idPct = $request->input('idPctRecolhe');
                $motivo = $request->input('motivo');
                $dtAgendamento = $request->input('dtAgendamento');
                $horarios = $request->input('horarios');

                //SALVA DOS DADOS DOS INPUTS NO BANCO DE DADOS
                $solicitacao = new Solicitacao();
                $solicitacao->pct_solicit =  $idPct;
                $solicitacao->motivo = $motivo;
                $solicitacao->date_agenda = $dtAgendamento;
                $solicitacao->hour_agenda = $horarios;

                if ($motivo == 7 ) {
                    $solicitacao->type_solicit =  3;    // 3 = troca de equipamento
                } else {
                    $solicitacao->type_solicit =  2;    // 2 = recolhimento
                }

                $solicitacao->equips_solicit =  $listEquipSel;
                $solicitacao->obs_solicit =  $obsSolicitacao;
                $solicitacao->save();

                //BUSCA NO BD AS INFORMAÇÕES REFERENTE A SOLICITAÇÃO
                $hcPctAtual = Pct::where('id', $idPct)->pluck('id_hc');
                $emailDestino = Cliente::find($hcPctAtual)->pluck('email')->toArray();
                $emailDestino2 = Cliente::find($hcPctAtual)->pluck('email2')->toArray();

                $namePct = Pct::where('id', $idPct)->pluck('name_pct')->get(0);
                $idSolicit = Solicitacao::where('pct_solicit', $idPct)->pluck('id')->last();
                $itensSolicit = Solicitacao::where('pct_solicit', $idPct)->pluck('equips_solicit')->last();
                $obsSolicit = Solicitacao::where('pct_solicit', $idPct)->pluck('obs_solicit')->last();

                $solicitacao->where('pct_solicit', $idPct)->get();  //Busca no BD a Solicitação deste paciente

                //BUSCA OS DADOS OS INPUTS
                $enviarEquip = $request->input('enviarEquipRecolhe');  //Este input contém o array separado por vírgula

                //SELECIONA OS EQUIPAMENTOS E ATRIBUI STATUS COMO RECOLHER
                foreach (explode(',', $enviarEquip) as $equip){                 //separa o o conteúdo do input por vírgula
                    if (empty($equip)) {
                        //se for nulo não faz nada
                    } else {
                            $recolheEquipSelecionado = Equipamento::find($equip);       //busca no Bd o id do equipamento
                            // $recolheEquipSelecionado->pct_equip =  $pctForEquip;
                            $recolheEquipSelecionado->solicit_equip = $solicitacao->id;  //atribui o id da solicitação ao equipamento
                            $recolheEquipSelecionado->status_equip = 3;                 //status do equipamento para 3 = recolher
                            $recolheEquipSelecionado->save();
                            }
                    }

                    if ($motivo == 7 ) {
                        $typeSolicitFim = "Troca / Manutenção";
                    } else {
                        $typeSolicitFim = "Recolhimento";
                    }
                    $solicitante = auth()->user()->name;
                    // $itensSolicit = Equipamento::where('solicit_equip', $solicitacao->id)->pluck('equips_solicit');

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
                        $message->from('nilson711@gmail.com', 'Atendimento');
                        $message->to($emailDestino, 'Email do Home Care');
                        $message->cc($emailDestino2, 'Email do Home Care');
                        $message->subject($typeSolicitFim . ' nº: '.$idSolicit. ' - PCT: '. $namePct);
                    });

                return back()->withInput();

                // dd($request->all());
            break;

        }

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
            $idPct = $solicit->pct_solicit;
            $solicit->save();

            $hcPctAtual = Pct::where('id', $idPct)->pluck('id_hc');
            $emailDestino = Cliente::find($hcPctAtual)->pluck('email')->toArray();
            $emailDestino2 = Cliente::find($hcPctAtual)->pluck('email2')->toArray();

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


            Equipamento::where('solicit_equip', $id)
                    ->update(['status_equip' => 0 ]);

            //SALVA
            $solicit = Solicitacao::find($id);
            // $solicit->status_solicit = 2;
            if ($solicit->type_solicit != 3) {
                $nameFile = $request->id . '.' . $request->guia->extension();
                $guia = $request->file('guia')->storeAs('public/guias', $nameFile); // busca no input 'guia' o arquivo e armazena na pasta 'guias'
                $image_resize = $request->file('guia')->storeAs('public/guias', $nameFile); // busca no input 'guia' o arquivo e armazena na pasta 'guias'
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

            $idForGuia = $id;

            $hcPctAtual = Pct::where('id', $idPct)->pluck('id_hc');
            $emailDestino = Cliente::find($hcPctAtual)->pluck('email')->toArray();
            $emailDestino2 = Cliente::find($hcPctAtual)->pluck('email2')->toArray();

            $namePct = Pct::where('id', $idPct)->pluck('name_pct')->get(0);
            $idSolicit = Solicitacao::where('id', $id)->pluck('id')->get(0);
            // $itensSolicit = Solicitacao::where('pct_solicit', $idPct)->pluck('equips_solicit')->last();
            // $obsSolicit = Solicitacao::where('pct_solicit', $idPct)->pluck('obs_solicit')->last();
            $itensSolicit = Solicitacao::where('id', $id)->pluck('equips_solicit')->get(0);
            $obsSolicit = Solicitacao::where('id', $id)->pluck('obs_solicit')->get(0);

            switch ( $solicit->type_solicit) {
                case 1:
                    $typeSolicitFim = "Implantação";
                    $a = 0;
                    
                   //BUSCA OS DADOS OS INPUTS
                //    $enviarEquip = $request->input('enviarEquip');  //Este input contém o array separado por vírgula
                $enviarEquip = Equipamento::where('solicit_equip', $id)->pluck('id'); /// Busca os Equipamentos solicitados na solicitação atual
                
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

                                // BUSCAR O EMAIL DO FORNECEDOR DE O2
                                $emailEmpO2 = Fornecedor::where('id', $vlidFornecEquip )->pluck('email_fornec')->toArray();
                                
                                // $vlemailEmpO2 = value($emailEmpO2[0]);
                                // dd($emailEmpO2);

                                Mail::send('emails.EmailO2Implantado',
                                ['emailEmpO2' => $emailEmpO2,
                                'namePct' => $namePct,
                                'typeSolicitFim' => $typeSolicitFim,
                                'idSolicit' => $idSolicit,
                                'equipsSolicFim'=> $equipsSolicFim,
                                'obsSolicit' =>  $obsSolicit,
                                'obsAtendfim' => $obsAtendfim
                                ],
                                function ($message)
                                use ($emailEmpO2, $namePct, $typeSolicitFim, $idSolicit, $equipsSolicFim,  $obsSolicit, $obsAtendfim ) {
                                    $message->from('nilson711@gmail.com', 'Atendimento');
                                    $message->to($emailEmpO2, 'Email da empresa de O2');
                                    $message->subject('O2 Implantado - Solicitação - nº: '.$idSolicit. ' - PCT: ' . $namePct);
                                    // $message->attach('pathToFile');
                                    // $message->attach('storage/guias/'.$idSolicit.'.jpg');
                                });
                            } 

                       }
                   }

                    break;
                case 2:
                    //    AQUI
                   $typeSolicitFim = "Recolhimento";
                                   
                   $idEquipRecolhe = Equipamento:: where('solicit_equip', $id)->pluck('id');
                   //    $emailDestino = Cliente::find($hcPctAtual)->pluck('email')->toArray();
                   
                   //Converte o Array $idEquipRecolhe em String
                   $collectionRec = collect($idEquipRecolhe);
                   $recEquipLancamento = $collectionRec->implode(',');
                
                //    dd($recEquipLancamento);

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
                    //    ->update(['dt_retirada' => date('Y-m-d'), 'dt_fatura' => date('Y-m-d')]) 
                    
                    // dd($diasCobrar);
                    // dd(date('d', strtotime($str_dt_ini)));

                       
                    }
                   
                    Equipamento::where('solicit_equip', $id)
                    ->update(['pct_equip' => 0, 'solicit_equip' => 0, 'status_equip' => 0 ]);

                    

                    break;
                case 3:
                   $typeSolicitFim = "Troca / Manutenção";
                   Equipamento::where('solicit_equip', $id)
                    ->update(['pct_equip' => 0, 'solicit_equip' => 0, 'status_equip' => 0 ]);

                    $solicit->type_solicit = 1;
                    $solicit->save();
                    return back()->withInput();

                    //BUSCA OS DADOS OS INPUTS
                    $enviarEquip = $request->input('enviarEquip');  //Este input contém o array separado por vírgula
                    $pctForEquip = $idPct;  //Este input busca o id do paciente
                    $solicitForEquip = $id;  //Este input busca o id da solicitação

                    //SELECIONA O EQUIPAMENTO E ATRIBUI O PACIENTE ATUAL A ELE
                    foreach (explode(',', $enviarEquip) as $equip){                 //separa o o conteúdo do input por vírgula
                        if (empty($equip)) {
                            //se for nulo não faz nada
                        } else {
                            $regEquipSelecionado = Equipamento::find($equip);       //busca no Bd o id do equipamento
                            $regEquipSelecionado->pct_equip =  $pctForEquip;        //atribui o id do pctatual ao equipamento
                            $regEquipSelecionado->solicit_equip = $solicitForEquip;  //atribui o id da solicitação ao equipamento
                            $regEquipSelecionado->status_equip = 2;                 //status do equipamento para 2 = solicitado
                            $regEquipSelecionado->save();

                        //INSERE OS REGISTROS DOS EQUIPAMENTOS IMPLANTADOS NA TABELA DE LANÇAMENTOS PARA COBRANÇA
                        Lancamento::create(['id_equip' => $equip, 'id_pct' => $pctForEquip, 'id_solicit' => $solicitForEquip, 'dias'=> 25]);
                        
                        }
                    }

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

            // Mail::to($emailDestino)->cc($emailDestino2)
            //         ->send(new EmailFimSolicit($idsolfim, $typeSolicitFim, $obsAtendfim, $pctSolFim, $equipsSolicFim, $idForGuia));

            // ENVIA O EMAIL DE SOLICITAÇÃO CONCLUÍDA COM A GUIA EM ANEXO
            Mail::send('emails.EmailFimSolicit',
            ['emailDestino' => $emailDestino,
            'emailDestino2' => $emailDestino2,
            'namePct' => $namePct,
            'typeSolicitFim' => $typeSolicitFim,
            'idSolicit' => $idSolicit,
            'equipsSolicFim'=> $equipsSolicFim,
            'obsSolicit' =>  $obsSolicit,
            'obsAtendfim' => $obsAtendfim
            ],
            function ($message)
            use ($emailDestino, $emailDestino2, $namePct, $typeSolicitFim, $idSolicit, $equipsSolicFim,  $obsSolicit, $obsAtendfim ) {
                $message->from('nilson711@gmail.com', 'Atendimento');
                $message->to($emailDestino, 'Email do Home Care');
                $message->cc($emailDestino2, 'Email do Home Care');
                $message->subject('Solicitação Concluída - nº: '.$idSolicit. ' - PCT: ' . $namePct);
                // $message->attach('pathToFile');
                $message->attach('storage/guias/'.$idSolicit.'.jpg');
            });

            $solicit->status_solicit = 2;
            $solicit->save();
            return redirect()->to('/solicitacoes');



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
 //EXCLUI APENAS O EQUIPAMENTO ATUAL DA SOLICITAÇÃO
public function cancelOneEquipSolicit (Request $request, $idEquip, $solicit_equip){
    // echo 'cancelar apenas este' . $idEquip ;

    $solicitAtual = Solicitacao::find($solicit_equip);

    switch ($solicitAtual->type_solicit) {
        case '1':     // se for IMPLANTAÇÃO retira o equipamento do paciente e da solicitação e retorna ele para o estoque
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
        $solicitacoes = DB::SELECT("SELECT S.id, Y.nome, S.priority, S.status_solicit, S.motivo, P.name_pct, P.id_hc, S.user_atend, S.type_solicit, S.date_solicit, C.cliente, P.rua, P.nr, P.bairro, P.city, P.compl, S.equips_solicit, S.obs_solicit
                        FROM solicitacaos AS S
                        INNER JOIN pcts AS P ON S.pct_solicit = P.id
                        INNER JOIN clientes AS C ON C.id = P.id_hc
                        INNER JOIN cidades AS Y ON Y.id = P.city
                        WHERE s.status_solicit= 0 OR s.status_solicit= 1
                        ORDER BY S.priority DESC, S.id ASC
                        -- ORDER BY S.priority DESC, P.bairro ASC
                        ");



        $equips = new Equipamento();
        $equips = DB::SELECT("SELECT * FROM equipamentos WHERE pct_equip = 0");

        // dd($nrCityStr);
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

        $solicitAtual = DB::SELECT("SELECT S.id AS SolicitId, S.priority, S.status_solicit, S.pct_solicit, P.name_pct, P.id, P.id_hc, S.type_solicit, S.user_atend, S.date_solicit, C.cliente, P.rua, P.nr, P.bairro, P.city, P.compl, S.equips_solicit, S.obs_solicit
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
        $equipsSel = DB::SELECT("SELECT id, patr, name_equip, solicit_equip FROM equipamentos WHERE pct_equip = $idPctSel AND solicit_equip = $id;


                        -- INNER JOIN pcts AS PCT ON SOLICIT.pct_solicit = PCT.id
                        -- INNER JOIN equipamentos AS E ON E.id = PCT.id
                        -- WHERE SOLICIT.id = $id
                        ");



        return view('edit_solicit', ['solicitSel'=>$solicitSel] + ['cityPct'=>$cityPct] + ['idPctSel'=>$idPctSel] + ['equipsSel'=>$equipsSel] + ['equips'=>$equips] +  compact('solicitAtual'));

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

@extends('adminlte::page')

@section('title', 'Prontuário do Paciente')

@section('content_header')
   <h1>PCT: {{$pctSel->name_pct}}</h1>
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div>
    <!-- Content Header (Page header) -->
    {{-- <section class="content-header"> --}}
      {{-- <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Pacientes</a></li>
              <li class="breadcrumb-item active">{{$pctSel->name_pct}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid --> --}}
    {{-- </section> --}}

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="margin-top: -15px">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-2">
                  <label></label>
                  <div class="card-tools float-right" data-toggle="tooltip" title="Fechar">
                    <a href="{{ route('listaPcs') }}">
                      <button type="button" class="btn btn-block btn-danger">
                            <i class="fas fa-times" style="color: white" ></i>
                      </button>
                    </a>
                </div>
                <ul class="nav nav-tabs">
                  <li class="nav-item"><a class="nav-link" href="#tabDadosPct" data-toggle="tab">Dados</a></li>
                  <li class="nav-item"><a class="nav-link active" href="#tabEquipamentosPct" data-toggle="tab">Equipamentos</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tabHistorico" data-toggle="tab">Histórico</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="tabDadosPct">
<!---------------------------------------------------- FORMUÁRIO DADOS DO PACIENTE ------------------------------------------------>
                    <form action="{{route('edit_Pct_submit', $pctSel->id)}}" method="post" >

                        <div >
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card-primary">
                                    <div class="card-body box-profile">
                                      <div class="text-center">
                                          <i class="fas fa-user-injured fa-7x"></i>
                                      </div>
                                      <div class="profile-username">
                                        <input type="text" class="form-control" name="Pct" id="Pct" placeholder="Nome Completo do Paciente" maxlength="50" value="{{$pctSel->name_pct}}" style="text-align: center; font-weight: bold; color:blue">
                                      </div>
                                      <ul class="list-group list-group-unbordered mb-3">
                                          <li class="list-group-item">
                                              <b>Home:</b> <a class="float-right col-sm-9">
                                                  <select name="hc" id="hc" class="form-control select" style="width: 100%;" aria-hidden="true" required>]
                                                      @foreach ($clientes as $cliente)
                                                          <option value = "{{$cliente->id}}" {{$cliente->id == $pctSel->id_hc ? 'selected' : ''}}>{{$cliente->cliente}}</option>
                                                      @endforeach
                                                  </select>
                                              </a>
                                            </li>
                                        <li class="list-group-item">
                                          <b>Peso:</b> <a class="float-right col-sm-9">
                                              <select name="peso" id="peso" class="form-control select" aria-hidden="true" data-toggle="tooltip" title="Informar se o paciente precisa de equipamento para Obeso.">
                                                  <option value="0" >Selecione</option>
                                                  <option value="1"{{ $pctSel->peso == "1" ? 'selected' : ''}}>Até 90kg</option>
                                                  <option value="2"{{ $pctSel->peso == "2" ? 'selected' : ''}}>Entre 90kg e 180kg</option>
                                                  <option value="3"{{ $pctSel->peso == "3" ? 'selected' : ''}}>Acima de 180kg</option>
                                              </select>
                                          </a>
                                        </li>
                                        <li class="list-group-item" style="margin-bottom: -35px">
                                          <b>Altura:</b> <a class="float-right col-sm-9">
                                              <select name="altura" id="altura" class="form-control select" aria-hidden="true" data-toggle="tooltip" title="Informar se o paciente precisa de equipamento maior ou para Obeso.">
                                                  <option selected value = "{{$pctSel->altura}}" selected>Selecione</option>
                                                  <option value="1" {{ $pctSel->altura == "1" ? 'selected' : ''}}>- 1,90m</option>
                                                  <option value="2" {{ $pctSel->altura == "2" ? 'selected' : ''}}>+ 1,90m</option>
                                              </select>
                                          </a>
                                        </li>
                                      </ul>
                                      {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>

                        <div class="col-md-9">
                            <div class="card card-primary" style="padding: 10px">
                            <input type="hidden" name="id_pct" id="id_pct" value="{{$pctSel->id}}">
                            <div class="row form-group">
                                <div class="col-sm-4">
                                    <label for="responsavel">Responsável:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control"  title="Responsável pelo paciente. Ex: Maria da Silva (Esposa)" name="responsavel" id="responsavel" placeholder="Ex: Maria da Silva (Esposa)" maxlength="30" required value = "{{$pctSel->resp}}">
                                </div>
                                <div class="col-sm-2">
                                    <label for="tel_resp" style="color: white">.</label>
                                    <input type="text" class="form-control"  title="Celular Ex: (61) 99234-5678" name="tel_resp" id="tel_resp" onkeypress="mascara(this, telefone)" maxlength="16" placeholder="(__) _____-____" required value = "{{$pctSel->tel_resp}}">
                                </div>
                                <div class="col-sm-4">
                                    <label for="resp2" style="color: white">.</label>
                                    <input type="text"  title="Contato adicional. Ex: Tiago da Silva (Filho)" class="form-control" name="resp2" id="resp2" placeholder="Ex: Tiago da Silva (Filho)" maxlength="30" value="{{$pctSel->resp2}}">
                                </div>
                                <div class="col-sm-2">
                                    <label for="tel_resp2" style="color: white">.</label>
                                    <input type="text" class="form-control" title="Celular Ex: (61) 99234-5678" name="tel_resp2" id="tel_resp2" onkeypress="mascara(this, telefone)" maxlength="16" placeholder="(__) _____-____" inputmode="text" value="{{$pctSel->tel_resp2}}">
                                </div>
                            </div>

                            <hr>

                            <div class="row form-group">
                                      <div class="col-sm-2">
                                          <label for="cep">Cep:</label>
                                          <div class="input-group input-group-sm">
                                              <input type="text" class="form-control"  title="Digite o CEP para preencher o endereço automaticamente." name="cep" id="cep" size="10" maxlength="9" onkeypress="mascara(this, cep)" onblur="pesquisacep(this.value);" value="{{$pctSel->cep}}">
                                              <div class="input-group-append">
                                                  <span class="input-group-text"><a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="blank" data-toggle="tooltip" title="Consultar Cep"><i class="far fa-question-circle"></i></a></i></span>
                                                </div>
                                            </div>
                                        </div>

                                <div class="col-sm-9">
                                    <label for="logradouro">Endereço:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control"  title="Rua, Rodovia, Avenida, Quadra, Conjunto"  name="rua" id="rua" placeholder="Logradouro" maxlength="50" required value="{{$pctSel->rua}}">
                                </div>
                                <div class="col-sm-1">
                                    <label for="nr">Nº:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" title="Número da Casa, Lote, Apt, Sala" name="nr" id="nr" maxlength="10"required value="{{$pctSel->nr}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="compl" id="compl" placeholder="Complemento"  title="Complemento ou Ponto de referência" maxlength="30" value="{{$pctSel->compl}}">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro" required value="{{$pctSel->bairro}}">
                                </div>

                                <input type="text" class="form-control" name="cidade" id="cidade" style="display: none">
                                <div class="col-sm-3">
                                    <select name="city" id="city" class="form-control select" title="Selecione a cidade " aria-hidden="true" required>

                                {{-- Seleciona dentro do Foreach a cidade com  o id correspondente --}}
                                        @foreach ( $allCities as $city)
                                            <option value="{{$city->id}}" {{$city->id == $pctSel->city ? 'selected' : ''}} >{{$city->nome}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-1">
                                    <input type="text" class="form-control" name="uf" id="uf" placeholder="uf" >
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-12">
                                    <label for="obs">Observações:</label>
                                    <input type="text" class="form-control" name="obs" id="obs" placeholder="Observações sobre o paciente" maxlength="100" value="{{$pctSel->obs}}">
                                </div>
                            </div>
                            {{-- <div class="col-sm-1" style="visibility: hidden">
                                <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade" required>
                            </div> --}}

                        </div>
                        </div>
                    </div>
                    </div>

                        <div>
                            <div class=" float-right" >
                                {{-- <button type="button" class="btn btn-success swalDefaultSuccess">Launch Success Toast</button> --}}
                                {{-- Retornar para página anterior --}}
                                {{-- <a href="javascript:history.back()"><button type="button" class="btn btn-outline-secondary " data-dismiss="modal">Cancelar</button></a> --}}
                            <button type="submit" class="btn btn-outline-primary swalDefaultSuccess">Salvar</button>
                            </div>
                        </div>
                    </form>

<!---------------------------------------------------- EQUIPAMENTOS DO PACIENTE ------------------------------------------------>
                </div>
                  <!-- /.tab-pane -->
                  <div class="active tab-pane" id="tabEquipamentosPct">
                    <!-- The tabEquipamentosPct -->
                    <div>
                        <div>
                            <div id="implantados_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                <div class="col-sm-8 col-md-6" style="margin-bottom: -30px">
                                    <div class="dt-buttons btn-group flex-wrap"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">

                                    <table id="table_implantados" class="table table-sm table-striped dataTable dtr-inline" role="grid" aria-describedby="table_implantados_info">

                                    <thead>
                                        <div class="float-right">
                                            <span data-toggle="modal" data-target="#modalSolicit">
                                                <button data-toggle="tooltip" title="Solicitar Implantação" type="button" class="btn btn-sm btn-outline-primary float-left" style="margin-right: 10px" >
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </span>
                                            <span data-toggle="modal" data-target="#modalRecolhimento">
                                                <button data-toggle="tooltip" title="Solicitar Recolhimento" type="button" class="btn btn-sm btn-outline-primary float-left" style="color: red; margin-right: 10px">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </span>
                                            <button data-toggle="tooltip" title="Pausa nos Esquipamentos" type="button" class="btn btn-sm btn-outline-primary float-left" style="color: rgb(14, 121, 0)">
                                                <i class="far fa-pause-circle"></i>
                                            </button>
                                        </div>
                                        <tr role="row">
                                            {{-- <th>PCT</th> --}}
                                            <th style="text-align: center" class="col-sm-1" tabindex="0" aria-controls="table_implantados" rowspan="1" colspan="1" aria-sort="ascending" title="Classificar crescente / decrescente">Patr</th>
                                            <th class="col-sm-3" tabindex="0" aria-controls="table_implantados" rowspan="1" colspan="1">Equipamento</th>
                                            <th class="col-sm-1" style="text-align: left" tabindex="0" aria-controls="table_implantados" rowspan="1" colspan="1">Implantação</th>
                                            <th style="text-align: center" class="col-sm-2" tabindex="0" aria-controls="table_implantados" rowspan="1" colspan="1">Modelo</th>
                                            <th style="text-align: center" class="col-sm-2" tabindex="0" aria-controls="table_implantados" rowspan="1" colspan="1">Marca</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($equipsPct as $equipPct)
                                            <tr class="odd" style="text-align: center; vertical-align: middle; line-height: 100%">
                                                <td class="dtr-control sorting_1" tabindex="0">
                                                    <div class="row">
                                                        {{-- Patrímônio do Equipamento --}}
                                                        <div class="col-sm-8" style="text-align: right; vertical-align: middle">
                                                            {{$equipPct->patr}}
                                                        </div>
                                                        <div class="col-sm-2" style="text-align: center; vertical-align: middle">
                                                            @if ($equipPct->rent_equip == '0')

                                                            @else
                                                            {{-- Empresa que alugou o equipamento --}}
                                                                @foreach ($fornecedores as $fornecedor)
                                                                @if ($fornecedor->id == $equipPct->rent_empresa)
                                                                    {{-- <p style="color: rgb(247, 170, 3)"><i class="fa fa-exchange-alt"></i></p> --}}
                                                                    <p data-toggle="tooltip" data-placement="top" title="{{$fornecedor->name_fornec}}" style="color: rgb(247, 170, 3)">
                                                                        <i class="fa fa-exchange-alt"></i>
                                                                    </p>
                                                                @endif
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="text-align: left; vertical-align: middle">{{$equipPct->name_equip}}</td>

                                                <td style="text-align: center">
                                                    {{date('d/m/Y', strtotime($equipPct->updated_at))}}
                                                </td>
                                                <td>
                                                    {{$equipPct->modelo_equip}}
                                                </td>
                                                <td>
                                                    {{$equipPct->marca_equip}}
                                                </td>
                                                {{-- <td>
                                                    <span data-toggle="tooltip" title="Solicitação Pendente" style="text-align: center">
                                                        @if ($equipPct->status_equip > 0)
                                                        <a href="#" data-toggle="modal" style="color: rgb(200, 200, 0)"><i class="fas fa-exclamation-triangle"></i></a>
                                                        @else
                                                        <a href="#" data-toggle="modal" data-target="#" style="color: rgb(200, 200, 0); visibility: hidden"><i class="fas fa-exclamation-triangle"></i></a>

                                                        @endif
                                                    </span>
                                                </td> --}}

                                            </tr>
                                        @endforeach



                                    </tbody>
                                    <tfoot>
                                    {{-- <tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1" style="">CSS grade</th></tr> --}}
                                    </tfoot>
                                </table>

                                </div>
                            </div>
                            <div>
                                <p>Total de itens implantados: {{$equipsCount}}</p>
                            </div>

                        </div>
                    </div>
                    <hr>
                   <label for="">Solicitações pendentes:</label>
                    <div >
                        @foreach ($solicitacoes as $solicitacao )

                        <ul>
                          <li id="list_solicit_pend">
                            @switch($solicitacao->type_solicit)
                                @case(1)
                                    <i class="fas fa-plus-circle" data-toggle="tooltip"
                                        title="Implantação"
                                        style="color: rgb(12, 146, 0)"></i>
                                @break
                                @case(2)
                                    <i class="fas fa-minus-circle" data-toggle="tooltip"
                                        title="Recolhimento -
                                        @switch($solicitacao->motivo)
                                            @case(1)
                                                Alta
                                            @break
                                            @case(2)
                                                Óbito
                                            @break
                                            @case(3)
                                                Internado
                                            @break
                                            @case(4)
                                                Sem uso
                                            @break
                                            @case(5)
                                                Não atende a necessidade
                                            @break
                                            @case(6)
                                                Troca de Home Care
                                            @break
                                            @case(7)
                                                Outro
                                            @break
                                        @default

                                        @endswitch

                                        " style="color: rgb(255, 0, 0)"></i>
                                @break
                                @case(3)
                                    <i class="fas fa-tools" data-toggle="tooltip"
                                        title="Troca/Manutenção"
                                        style="color: rgb(233, 191, 6)"></i>
                                @break
                                @case(4)
                                    <i class="fas fa-dolly" data-toggle="tooltip"
                                        title="Mudança"></i>
                                @break
                                @case(5)
                                    <i class="fas fa-times-circle" data-toggle="tooltip"
                                        title="Recolhimento Total"
                                        style="color: rgb(255, 0, 0)"></i>
                                @break
                                @case(6)
                                    <i class="fas fa-battery-full" data-toggle="tooltip"
                                        title="Cilindro O2"
                                        style="color: rgb(252, 252, 252); transform: rotate(-90deg)"></i>
                                @break

                                @default
                                    <i class="fas fa-plus-circle" data-toggle="tooltip" title="nenhum"></i>
                            @endswitch

                             {{$solicitacao->id}} - {{$solicitacao->equips_solicit}} ({{$solicitacao->obs_solicit}})
                              @if ($solicitacao->status_solicit == 1)
                                  <i class="fas fa-ambulance" id="ambulancia" data-toggle="tooltip" title="Em atendimento" style="display: inline; color: rgb(255, 0, 55)"></i><br>
                              @else
                                  <i class="fas fa-ambulance" id="ambulancia" style="display: none"></i><br>
                              @endif
                          </li>
                        </ul>

                        @endforeach

                    </div>

                  </div>
                  <!-- /.HISTÓRICO -->

                  <div class="tab-pane" id="tabHistorico">

                      <table id="example1" class="table table-sm  table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                          <thead>
                              <tr role="row">
                                <th>!</th>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" title="Classificar crescente / decrescente">#</th>
                                {{-- <th class="sorting col-sm-4" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Endereço</th> --}}
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Data</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Solicitado</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Obs</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Guia</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Atendimento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($solicitacoesFim as $solicFim)
                                <tr>
                                    <td>
                                        @switch($solicFim->type_solicit)
                                            @case(1)
                                                <i class="fas fa-plus-circle" data-toggle="tooltip" title="Implantação"
                                                    style="color: rgb(2, 107, 19)"></i>
                                            @break
                                            @case(2)
                                                <i class="fas fa-minus-circle" data-toggle="tooltip" title=" Recolhimento"
                                                    style="color: black"></i>
                                            @break
                                            @case(3)
                                                <i class="fas fa-tools" data-toggle="tooltip" title="Troca/Manutenção"
                                                    style="color: rgb(230, 163, 40)"></i>
                                            @break
                                            @case(4)
                                                <i class="fas fa-dolly" data-toggle="tooltip" title="Mudança"></i>
                                            @break
                                            @case(5)
                                                <i class="fas fa-times-circle" data-toggle="tooltip" title="Recolhimento Total"
                                                    style="color: rgb(253, 0, 0)"></i>
                                            @break
                                            @case(6)
                                                <i class="fas fa-battery-empty" data-toggle="tooltip" title="Recarga de O2"
                                                    style="color: rgb(80, 104, 240); transform: rotate(-90deg)"></i>
                                            @break
                                            @case(7)
                                                <i class="fas fa-battery-empty" data-toggle="tooltip" title="Recolher O2"
                                                    style="color: rgb(255, 0, 0); transform: rotate(-90deg)"></i>
                                            @break
                                            @case(8)
                                                <i class="fas fa-battery-full" data-toggle="tooltip" title="Implantar O2"
                                                    style="color: rgb(14, 36, 238); transform: rotate(-90deg)"></i>
                                            @break

                                            @default
                                                <i class="fas fa-plus-circle" data-toggle="tooltip" title="nenhum"></i>
                                        @endswitch
                                    </td>
                                    <td>{{$solicFim->id}}</td>
                                    {{-- <td>{{}}</td> --}}
                                    {{-- <td>{{\Carbon\Carbon::createFromFormat('d/m/y', now())}}</td> --}}
                                    <td>{{date('d/m/Y', strtotime($solicFim->date_solicit))}}</td>
                                    <td>
                                        {{$solicFim->equips_solicit}}

                                        {{-- <div style="display: inline-block"> --}}
                                            {{-- @if ($solicFim->obs_solicit != null)
                                                <i class="fas fa-exclamation-circle" style="color: rgb(233, 166, 22)" data-toggle="tooltip" title='{{$solicFim->obs_solicit}}'>
                                                </i>
                                            @endif --}}
                                        {{-- </div> --}}
                                    </td>
                                    <td>
                                        {{$solicFim->obs_solicit}}
                                    </td>

                                    <td>
                                        <div style="display: inline-block">
                                            {{-- @if ($solicFim->obs_atend != null)
                                                <i class="fas fa-info" style="color: rgb(12, 63, 139)" data-toggle="tooltip" title='{{$solicFim->obs_atend}}'>
                                                </i>
                                            @endif --}}
                                        </div>&nbsp;&nbsp;&nbsp;
                                        <div style="display: inline-block">
                                            <a href="{{asset('storage/guias/'.$solicFim->id.'.jpg')}}" target="_blank" data-toggle="lightbox" data-title="sample 1 - white">
                                                <i class="far fa-file" data-toggle="tooltip" title="Guia"></i>
                                            </a>
                                          </div>
                                    </td>
                                    <td>
                                        {{$solicFim->obs_atend}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        {{-- <tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1" style="">CSS grade</th></tr> --}}
                        </tfoot>
                    </table>

                  </div>
                  <!-- /.tab-pane -->
                </div>
 <!--//////////////////////////////////////////////////// Modal SOLICITAÇÃO /////////////////////////////////////////////-->

  <div class="modal fade bd-example-modal-lg" id="modalSolicit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <ion-icon size="large" style="color: #0069d9"  name="add-circle-outline"></ion-icon>
            <h5 class="modal-title" id="exampleModalLabel"><span style="color: #0069d9"> Solicitar Equipamento</span><br>
            Paciente: {{$pctSel->name_pct}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('new_solicita')}}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                                <table class="table table-sm table-striped table-head-fixed text-nowrap dataTable dtr-inline" id= "tableEquips">

                                <thead>
                                    <tr>
                                    <th></th>
                                    <th>Equipamentos disponíveis <i class="fas fa-search" data-toggle="tooltip" title="Dica: Ctrl+F para pesquisar" style="color: green"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $allEquipsEstoque as $equipEstoque)
                                    <tr class="tr-row" style="vertical-align: middle; line-height: 100%">
                                    <td>
                                                <div style="margin-left: -40px" id="checkSelEquip" class="checkSelEquip form-check col-sm-6" onclick="ContarSelecionados()">
                                                    {{-- <input class="qtdDoItem" type="number" min="0" value="0" onchange="qtdSolicitada(this.value)" style="width: 50px"> --}}
                                                    {{-- <input type="number" onchange="cadastraNotaImportada(this.value)" class="form-control disciplina" name="" value="0"> --}}
                                                    <input class="checkbox" type="checkbox" id= " {{$equipEstoque->name_equip}}" name=" {{$equipEstoque->name_equip}}" onclick="coletaDados()" style="margin-left: 7px; transform: scale(1.2)">
                                                </div>
                                        </td>
                                        <td id="nomeEquip" class="nomeEquip">
                                            {{$equipEstoque->name_equip}}
                                            ({{$equipEstoque->qtdName}})
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="class col-sm-6">
                            <p>Solicito a implantação dos equipamentos abaixo:</p>
                            <input type="number" name="idPct" id="idPct" value="{{$pctSel->id}}" style="display: none">
                            <div id="foo"></div>
                            <textarea name="textEquips" id="textEquips" style="display: none"></textarea>
                            <hr style="margin-top: 3px; margin-botton: 0px">
                            <p id="QtdequipsSelecionados" style="margin-top: -10px"></p>
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label for="obsSolicitacao">Observações:</label>
                                            {{-- <input type="text" class="form-control" name="obsSolicitacao" id="obsSolicitacao" placeholder="Observações sobre a solicitação" maxlength="100"> --}}
                                            <textarea class="form-control" name="obsSolicitacao" id="obsSolicitacao" rows="3" placeholder="Observações sobre a solicitação" maxlength="150"></textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input custom-control-input-danger" data-toggle="tooltip" title="Só marque se for realmente Urgente!" type="checkbox" id="checkUrgente" name="checkUrgente" value="1" onclick="urgente()">
                                        <label for="checkUrgente" class="custom-control-label" data-toggle="tooltip" title="Só marque se for realmente Urgente!">Urgente!</label>
                                      </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="text" name="enviarEquip" id="enviarEquip" style="visibility: hidden">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" id="btnCancela">Cancelar</button>
                <button type="submit" name="submitbuttonSolicit" value="1" class="btn btn-outline-primary swalSolicitSuccess" id="btnSolicita" style="display: none">Solicitar</button>
                <button type="button" class="btn btn-success" style="display: none" id="spinnerFinalizando">
                    <span class="spinner-border spinner-border-sm"></span>
                    Enviando...
                </button>


            </div>
        </form>
      </div>
    </div>
  </div>

<!--//////////////////////////////////////////////////// FIM MODAL SOLICITAÇÃO ////////////////////////////////////////////////-->


<!--////////////////////////////////////////////////////  MODAL RECOLHIMENTO  ////////////////////////////////////////////////-->

<div class="modal fade bd-example-modal-lg" id="modalRecolhimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <ion-icon size="large" style="color: red"  name="remove-circle-outline"></ion-icon>
            <h5 class="modal-title" id="exampleModalLabel"><span style="color: red"> Recolher Equipamento >> </span>
            Paciente: {{$pctSel->name_pct}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="{{route('new_solicita')}}" method="POST">
                @csrf

                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-default" style="padding-bottom: 0px">
                      {{-- <div class="card-header">
                        <h3 class="card-title">bs-stepper</h3>
                      </div> --}}
                      <div class="card-body p-0">
                        <div class="bs-stepper linear">
                          <div class="bs-stepper-header" role="tablist">
                            <!-- your steps here -->
                            <div class="step active" data-target="#equip-parts">
                              <button type="button" class="step-trigger" role="tab" aria-controls="equip-parts" id="equip-parts-trigger" aria-selected="true">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Equipamentos</span>
                              </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#agendamento-parts">
                              <button type="button" class="step-trigger" role="tab" aria-controls="agendamento-parts" id="agendamento-parts-trigger" aria-selected="false" disabled="disabled">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Agendamento</span>
                                <input type="text" name="hsAtual" id="hsAtual" style="display: none">
                              </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#finalizar-parts">
                              <button type="button" class="step-trigger" role="tab" aria-controls="finalizar-parts" id="finalizar-parts-trigger" aria-selected="false" disabled="disabled">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Finalizar</span>
                              </button>
                            </div>
                          </div>
                          <div class="bs-stepper-content" style="padding-bottom: 0px">
                            <!-- your steps content here -->

                            <div id="equip-parts" class="content active dstepper-block" role="tabpanel" aria-labelledby="equip-parts-trigger">
                              <div>
                                
                                <div class="row">
                                    <div class="col-md-5">

                                      <div id="selectMotivo" class="form-group" >
                                        <label for="motivo">Motivo:</label>
                                        <select name="motivo" id="motivo" class="form-control select" style="width: 100%;" aria-hidden="true" required onchange="habilitarBtnSolicitar()">
                                            <option value = "9" selected>Selecione um motivo</option>
                                            <option value = "1" title="Paciente recebeu alta">Alta</option>
                                            <option value = "2" title="Paciente foi a óbito">Óbito</option>
                                            <option value = "3" title="Paciente não usa o equipamento">Sem uso</option>
                                            <option value = "4" title="Paciente internado sem previsão de alta">Paciente Internado</option>
                                            <option value = "5" title="Recolher - Equipamento não atende a necessidade do paciente">Não atende a necessidade</option>
                                            <option value = "6" title="Paciente migrou para outro home care">Troca de home care</option>
                                            <option value = "7" title="Equipamento não está funcionamento corretamente">Trocar Equipamento</option>
                                            {{-- <option value = "8">Outro</option> --}}
                                        </select>
                                      </div>
                                      <textarea name="txtMotivo" id="txtMotivo" cols="30" rows="1" style="display: none"></textarea>
                                      <div class="form-group">
                                        <label for="obsSolicitacaoRecolhe">Observações:</label>
                                        <textarea class="form-control" name="obsSolicitacaoRecolhe" id="obsSolicitacaoRecolhe" onkeyup="obsNotNull()" rows="2" placeholder="Observações sobre a solicitação" maxlength="150"></textarea>
                                      </div>

                                      <div class="form-group" id="fotoEquip" style="visibility: hidden">
                                        <label for="fotoEquip">Foto / Vídeo: <i class="fas fa-info-circle" style="color: blue" data-toggle="tooltip" title="Videos curtos de 30 segundos aproximadamente."></i></label>
                                        <input type="file" class="form-control-file" name="file_fotoEquip" id="file_fotoEquip" title="Anexar foto mostrando o defeito do equipamento.">
                                      </div>


                                    </div>

                                    <div class="col-sm-1">
                                      
                                    </div>

                                    <div class="form-group col-sm-6">
                                      <div class="card-body table-responsive p-0" >
                                          <table class="table table-sm table-striped table-head-fixed text-nowrap" id= "tableEquipsRecolhe" style="visibility: hidden">
                                              <thead>
                                                  <tr>
                                                  <th></th>
                                                  <th>Patr / Equipamento</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  @foreach ( $equipsPct as $equipImplant)
                                                  <tr class="tr-row" style="vertical-align: middle; line-height: 100%">
                                                      <td>
                                                          <div style="margin-left: -40px" id="checkSelEquipRecolhe" class="checkSelEquipRecolhe form-check col-sm-6" onclick="ContarSelecionadosRecolhe()">
                                                              {{-- <input class="qtdDoItem" type="number" min="0" value="0" onchange="qtdSolicitada(this.value)" style="width: 50px"> --}}
                                                              {{-- <input type="number" onchange="cadastraNotaImportada(this.value)" class="form-control disciplina" name="" value="0"> --}}
                                                              <input class="checkbox checkbox-recolhe"  type="checkbox" id= " {{$equipImplant->id}}" name=" {{$equipImplant->name_equip}}" onclick="coletaDadosRecolhe()" style="margin-left: 7px; transform: scale(1.2)">
                                                          </div>
                                                      </td>
                                                      <td id="nomeEquipRecolhe" class="nomeEquipRecolhe">
                                                          {{$equipImplant->patr}}-
                                                          {{$equipImplant->name_equip}}
                                                      </td>
                                                  </tr>
                                                  @endforeach
                                              </tbody>
                                          </table>
                                      </div>
                                      <p id="QtdequipsSelecionadosRecolhe" style="margin-left: 10px"></p>
                                      <textarea name="textEquipsRecolhe" id="textEquipsRecolhe" style="display: none" ></textarea>
                                      <input type="text" name="enviarEquipRecolhe" id="enviarEquipRecolhe" style="display: none">
                                      <p id="txtcama"></p>
                                  </div>
                                </div>
                              </div>
                              
                            </div>

                            <div id="agendamento-parts" class="content" role="tabpanel" aria-labelledby="agendamento-parts-trigger">
                              <div class=" row form-group">

                                <div class="col-sm-6">

                                  <div class="card-body table-responsive p-0" style="height: 200px;">
                                    <table class="table table-sm table-head-fixed text-nowrap" >
                                      <thead>
                                        <tr>
                                          <th style="width: 10px" colspan="3">Solicitações Pendentes</th>
                                          {{-- <th>Hora</th> --}}
                                          {{-- <th>Local</th> --}}
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <small>
                                        @foreach ($solicitacoesPend as $item)
                                        <tr>
                                          <td>{{date('d/m', strtotime($item->date_agenda))}}</td>
                                          <td>
                                            @switch($item->hour_agenda)
                                                @case(1)
                                                    Dia todo
                                                    @break
                                                @case(2)
                                                    Manhã
                                                    @break
                                                @case(3)
                                                    Tarde
                                                    @break
                                                @case(9)
                                                    09-10hs
                                                    @break
                                                @case(10)
                                                    10-11hs
                                                    @break
                                                @case(11)
                                                    11-12hs
                                                    @break
                                                @case(13)
                                                    13-14hs
                                                    @break
                                                @case(14)
                                                    14-15hs
                                                    @break
                                                @case(15)
                                                    15-16hs
                                                    @break
                                                @case(16)
                                                    16-17hs
                                                    @break
                                                @case(17)
                                                    17-18hs
                                                    @break
                                                @case(18)
                                                    +18hs
                                                    @break
                                                @default
                                                    
                                            @endswitch
                                          </td>
                                          <td>
                                            {{$item->bairro}}
                                            {{$item->nome}}
                                          </td>
                                        </tr>
                                        @endforeach
                                      </small>
                                      </tbody>
                                    </table>
                                  </div>
                                  
                                </div>

                                <div class="form-group">
                                  
                                  {{-- <textarea name="textEquipsRecolhe" id="textEquipsRecolhe"></textarea> --}}
                                  
                                  {{-- <div id="fooRecolhe"></div> --}}
                                </div>
                                

                                <div class="col-sm-5" id="dataAgendamento" >
                                  <label>Agendamento:</label>
                                  {{-- <button type="button" class="btn btn-sm btn-outline-primary float-left" style="margin-right: 10px" > --}}
                                    <i class="fas fa-info-circle" style="color: blue" data-toggle="tooltip" title="Agende com os familiares dia e horario aproximado"></i>
                                    {{-- </button> --}}
                                    <label class="float-right">Horário:
                                    <i class="fas fa-clock" style="color: blue" data-toggle="tooltip" title="Horário aproximado"></i>
                                    </label>
                                    <div class="input-group date" >
                                      <input type="date" class="col-sm-7" id="dtAgendamento" name="dtAgendamento" class="form-control datetimepicker-input" required onchange="selHora()">
                                      <!-- {{-- <select class="select select2" id="hours" data-toggle="tooltip" title="Hora aproximada da solicitação." onchange="msgHora()"></select> --}} -->
                                      

                                      <div id="selhorarios" style= "visibility: hidden; width: 40%" >
                                        <select id="horarios" class="form-control" name="horarios" required onchange="msgHora()">
                                          <option id="select_0" value="0" >Selecione</option>
                                          <option id="select_1" value="1" title="Qualquer horário do dia.">Dia todo</option>
                                          <option id="select_2" value="2" title="De 09hs às 12hs" disabled>Manhã</option>
                                          <option id="select_9" value="9" disabled> 09-10hs</option>
                                          <option id="select_10" value="10" disabled>10-11hs</option>
                                          <option id="select_11" value="11" disabled>11-12hs</option>
                                          <option id="select_3" value="3" title="De 13hs às 18hs" disabled>Tarde</option>
                                          <option id="select_13" value="13" disabled>13-14hs</option>
                                          <option id="select_14" value="14" disabled>14-15hs</option>
                                          <option id="select_15" value="15" disabled>15-16hs</option>
                                          <option id="select_16" value="16" disabled>16-17hs</option>
                                          <option id="select_17" value="17" disabled>17-18hs</option>
                                          <option id="select_18" value="18" disabled title="Apenas emergências">+18hs*</option>
                                        </select>
                                      </div>
                                    </div>
                                </div>

                              </div>

                              

                            

                            </div>

                            <div id="finalizar-parts" class="content" role="tabpanel" aria-labelledby="finalizar-parts-trigger">
                              <div class="form-group">
                                <label for="resumoSolicit">Para proseguir clique Solicitar. Para alterar clique em Voltar.</label> 
                                <textarea name="resumoSolicit" id="resumoSolicit" cols="95" rows="7" readonly onfocus="viewBtnSolicita()"></textarea>
                                
                                
                              </div>
                                  
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                      {{-- <div class="card-footer">
                           <small>
                            Preencha os campos solicitados em cada etapa para finalizar a solicitação.
                          </small> 
                      </div> --}}
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
          </form>

        </div>

               
            <div class="modal-footer" >
              <div class="col-sm-10">
                <button id="btnVoltar" class="btn btn-primary btn-sm" onclick="stepper.previous(); desativarBtnVoltar()" style="visibility: hidden"><i class="fas fa-arrow-left"></i> Voltar</button>
                <button id="btnVoltar2" class="btn btn-primary btn-sm" onclick="stepper.previous(); desativaBtns3()" style="visibility: hidden"><i class="fas fa-arrow-left"></i> Voltar</button>
                
                <button id="btnAvancar" class="btn btn-primary btn-sm" onclick="stepper.next()" style="visibility: hidden" onmouseup="ativaBtns2()">Avançar <i class="fas fa-arrow-right"></i></button>
                <button id="btnAvancar2" class="btn btn-primary btn-sm" onclick="stepper.next()" style="visibility: hidden" onmouseup="ativaBtns3()">Avançar <i class="fas fa-arrow-right"></i></button>
                
                <button type="button" name="submitbuttonSolicit" value="2" class="btn btn-sm btn-outline-primary swalSolicitSuccess" onclick="viewSpinner()" id="btnSolicitaRecolhe" style="visibility: hidden">Solicitar</button>
                <button type="button" class="btn btn-success" style="visibility: hidden" id="spinnerFinalizandoRecolhe">
                    <span class="spinner-border spinner-border-sm"></span>
                    Enviando...
                </button>
              </div>

              <div class="float-right">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal" id="btnCancela">Cancelar</button>
              </div>
                
            </div>
        
      </div>
    </div>
  </div>

<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


</div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    {{-- <div id="toastsContainerTopRight" class="toasts-top-right fixed">
      <div class="toast bg-danger fade show" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
              <strong class="mr-auto">Toast Title</strong>
              <small>Subtitle</small>
              <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="toast-body">Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</div>
        </div>
    </div> --}}

@stop

@section('css')
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
{{-- <link rel="stylesheet" href="{{asset('css/timeline.css')}}"> --}}



<!-- SweetAlert2 -->
<link rel="stylesheet" href={{ asset('css/bootstrap-4.min.css') }}>

<link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
<link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">

<!-- DataTables -->
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('css/buttons.bootstrap4.min.css')}}">
<!-- Theme style -->
{{-- <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}"> --}}

<!-- BS Stepper -->
<link rel="stylesheet" href="{{asset('css/bs-stepper.min.css')}}">

<!-- icheck -->
<link rel="stylesheet" href="{{asset('css/icheck-bootstrap.min.css')}}">

@stop

@section('js')

<!-- jQuery -->
<script src= {{asset('js/jquery.min.js')}}></script>
<!-- Bootstrap 4 -->
{{-- <script src= {{asset('js/bootstrap.bundle.min.js')}}></script> --}}
{{-- <script src= {{asset('js/timeline.js')}}></script> --}}
<!-- SweetAlert2 -->
<script src= {{asset('js/sweetalert2.min.js')}}></script>
<!-- Toastr -->
<script src= {{asset('js/toastr.min.js')}}></script>
<!-- AdminLTE App -->
<script src= {{asset('js/adminlte.min.js')}}></script>
<!-- AdminLTE for demo purposes -->
<script src= {{asset('js/demo.js')}}></script>
<!-- Page specific script -->

<script src= {{asset('js/select2.full.min.js')}}></script>
<script src= {{asset('js/bootstrap.bundle.min.js')}}></script>
<script src= {{asset('js/functions-equips.js')}} ></script>

<!-- DataTables  & Plugins -->
<script src= {{asset('js/jquery.dataTables.min.js')}}></script>
<script src= {{asset('js/dataTables.bootstrap4.min.js')}}></script>
<script src= {{asset('js/dataTables.responsive.min.js')}}></script>
<script src= {{asset('js/responsive.bootstrap4.min.js')}}></script>
<script src= {{asset('js/dataTables.buttons.min.js')}}></script>
<script src= {{asset('js/buttons.bootstrap4.min.js')}}></script>
<script src= {{asset('js/jszip.min.js')}}></script>
<script src= {{asset('js/pdfmake.min.js')}}></script>
<script src= {{asset('js/vfs_fonts.js')}}></script>
<script src= {{asset('js/buttons.html5.min.js')}}></script>
<script src= {{asset('js/buttons.print.min.js')}}></script>
<script src= {{asset('js/buttons.colVis.min.js')}}></script>

<!-- BS-Stepper -->
<script src= {{asset('js/bs-stepper.min.js')}}></script>

<script>
      // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })
</script>
<script>
    function findString() {
        window.find();
      }

</script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false
        // ,        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      $("#table_implantados").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false
        // ,        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#implantados_wrapper .col-md-6:eq(0)');

      $("#table_manutencao").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false
        // ,        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#manutencao_wrapper .col-md-6:eq(0)');



      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

<script>
  // $(document).ready(function() {
  //               document.getElementById('list_solicit_pend').click;

  //       });
</script>

<script>
    $(function() {
      var Toast = Swal.mixin({
        toast: false,
        position: 'center',
        showConfirmButton: false,
        timer: 3000
      });

      $('.swalDefaultSuccess').click(function() {
        Toast.fire({
          icon: 'success',
          title: 'Salvo com sucesso!'
        })
      });
      $('.swalSolicitSuccess').click(function() {
        Toast.fire({
          icon: 'success',
          title: 'Solicitação gravada com sucesso!'
        })
      });
      $('.swalDefaultInfo').click(function() {
        Toast.fire({
          icon: 'info',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultError').click(function() {
        Toast.fire({
          icon: 'error',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultWarning').click(function() {
        Toast.fire({
          icon: 'warning',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultQuestion').click(function() {
        Toast.fire({
          icon: 'question',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });

      $('.toastrDefaultSuccess').click(function() {
        toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
      $('.toastrDefaultInfo').click(function() {
        toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
      $('.toastrDefaultError').click(function() {
        toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
      $('.toastrDefaultWarning').click(function() {
        toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });

      $('.toastsDefaultDefault').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultTopLeft').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          position: 'topLeft',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultBottomRight').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          position: 'bottomRight',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultBottomLeft').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          position: 'bottomLeft',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultAutohide').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          autohide: true,
          delay: 750,
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultNotFixed').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          fixed: false,
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultFull').click(function() {
        $(document).Toasts('create', {
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          icon: 'fas fa-envelope',
        })
      });
      $('.toastsDefaultFullImage').click(function() {
        $(document).Toasts('create', {
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          image: '../../dist/img/user3-128x128.jpg',
          imageAlt: 'User Picture',
        })
      });
      $('.toastsDefaultSuccess').click(function() {
        $(document).Toasts('create', {
          class: 'bg-success',
          title: 'Solicitação',
          subtitle: 'Implantação',
          body: 'Sua solicitação foi encaminhada com sucesso!.'
        })
      });
      $('.toastsDefaultInfo').click(function() {
        $(document).Toasts('create', {
          class: 'bg-info',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultWarning').click(function() {
        $(document).Toasts('create', {
          class: 'bg-warning',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultDanger').click(function() {
        $(document).Toasts('create', {
          class: 'bg-danger',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultMaroon').click(function() {
        $(document).Toasts('create', {
          class: 'bg-maroon',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
    });
  </script>

{{-- <script>
    $('.btnSelector').on('click', function() {
    // var valores = document.querySelectorAll("table tr td");
    var valores = document.querySelectorAll("table tr td");

    for (i = 0; i < valores.length; i++) {
        console.log(valores[i].innerHTML);
    }
}) --}}

{{-- </script> --}}

<!-- Select2 -->



<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date picker
      // $('#reservationdate').datetimepicker({
      //     format: 'L'
      // });

      //Date and time picker
      // $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

      //Date range picker
    //   $('#reservation').daterangepicker()
      //Date range picker with time picker
    //   $('#reservationtime').daterangepicker({
    //     timePicker: true,
    //     timePickerIncrement: 30,
    //     locale: {
    //       format: 'DD/MM/YYYY hh:mm A'
    //     }
    //   })
      //Date range as a button
    //   $('#daterange-btn').daterangepicker(
    //     {
    //       ranges   : {
    //         'Today'       : [moment(), moment()],
    //         'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //         'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
    //         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //         'This Month'  : [moment().startOf('month'), moment().endOf('month')],
    //         'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //       },
    //       startDate: moment().subtract(29, 'days'),
    //       endDate  : moment()
    //     },
    //     function (start, end) {
    //       $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    //     }
    //   )

      //Timepicker
      // $('#timepicker').datetimepicker({
      //   format: 'LT'
      // })

      //Bootstrap Duallistbox
    //   $('.duallistbox').bootstrapDualListbox()

    //   $("input[data-bootstrap-switch]").each(function(){
    //     $(this).bootstrapSwitch('state', $(this).prop('checked'));
    //   })

    })
</script>

<script src= {{asset('js/jquery.inputmask.min.js')}}></script>
<script src= {{asset('js/functions-equips.js')}}></script>

<script>
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<script>
    function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function leech(v){
    v=v.replace(/o/gi,"0")
    v=v.replace(/i/gi,"1")
    v=v.replace(/z/gi,"2")
    v=v.replace(/e/gi,"3")
    v=v.replace(/a/gi,"4")
    v=v.replace(/s/gi,"5")
    v=v.replace(/t/gi,"7")
    return v
}
function soNumeros(v){
    return v.replace(/\D/g,"")
}

function cep(v){
    // v=v.replace(/D/g,"")                //Remove tudo o que não é dígito
    // v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/^(\d{5})(\d)/,"$1-$2") //Esse é tão fácil que não merece explicações

    +"-"
    return v
}function soNumeros(v){
    return v.replace(/\D/g,"")
}
function telefone(v){
    v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
    v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d)(\d{3})/,"$1 $2")    //Coloca um espaço no primeiro dígito do telefone
    v=v.replace(/(\d{4})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos

    return v
}
function cpf(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                             //de novo (para o segundo bloco de números)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
    return v
}
function mdata(v){
    v=v.replace(/\D/g,"");
    v=v.replace(/(\d{2})(\d)/,"$1/$2");
    v=v.replace(/(\d{2})(\d)/,"$1/$2");

    v=v.replace(/(\d{2})(\d{2})$/,"$1$2");
    return v;
}
function mcc(v){
    v=v.replace(/\D/g,"");
    v=v.replace(/^(\d{4})(\d)/g,"$1 $2");
    v=v.replace(/^(\d{4})\s(\d{4})(\d)/g,"$1 $2 $3");
    v=v.replace(/^(\d{4})\s(\d{4})\s(\d{4})(\d)/g,"$1 $2 $3 $4");
    return v;
}

//Datemask dd/mm/yyyy
$('#data_rent').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
</script>

<script>

    $("#btnSolicita").on('click', function() {
        // alert(this.files[0].name);
        document.getElementById('spinnerFinalizando').style.display = "block";
        document.getElementById('btnCancela').style.display = "none";
        document.getElementById('btnSolicita').style.display = "none";
        document.getElementById('tableEquips').style.visibility = "hidden";
    });
</script>

{{-- ICONES IONICONS --}}
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>

// implementa o select com as horas e minutos
       function createOption(value, text) {
              var option = document.createElement('option');
              option.text = text + ' hs';
              option.value = value;
              return option;
       }

      //  var hourSelect = document.getElementById('hours');
      //  for(var i = 10; i <= 18; i++){
      //         hourSelect.add(createOption(i, i));
      //  }

      //  var minutesSelect = document.getElementById('minutes');
      //  for(var i = 0; i < 60; i += 15) {
      //         minutesSelect.add(createOption(i, i));
      //  }
</script>


@stop

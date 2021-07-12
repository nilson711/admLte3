@extends('adminlte::page')

@section('title', 'Prontuário do Paciente')

@section('content_header')

@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div>
    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section> --}}

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
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
                        <select name="peso" id="peso" class="form-control select" aria-hidden="true">
                            <option value="0" >Selecione</option>
                            <option value="1"{{ $pctSel->peso == "1" ? 'selected' : ''}}>Até 90kg</option>
                            <option value="2"{{ $pctSel->peso == "2" ? 'selected' : ''}}>Entre 90kg e 180kg</option>
                            <option value="3"{{ $pctSel->peso == "3" ? 'selected' : ''}}>Acima de 180kg</option>
                        </select>
                    </a>
                  </li>
                  <li class="list-group-item">
                    <b>Altura:</b> <a class="float-right col-sm-9">
                        <select name="altura" id="altura" class="form-control select" aria-hidden="true">
                            <option selected value = "{{$pctSel->altura}}" selected>Selecione</option>
                            <option value="1" {{ $pctSel->altura == "1" ? 'selected' : ''}}>- 1,90m</option>
                            <option value="2" {{ $pctSel->altura == "2" ? 'selected' : ''}}>+ 1,90m</option>
                        </select>
                    </a>
                  </li>
                  <li class="list-group-item">
                    <b>Solicitações:</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            {{-- <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Informações</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Responsável<span style="color: red">*</span></strong>

                <p class="text-muted">
                    <input type="text" class="form-control" data-toggle="tooltip" title="Responsável pelo paciente. Ex: Maria da Silva (Esposa)" name="responsavel" id="responsavel" placeholder="Ex: Maria da Silva (Esposa)" maxlength="30" required value = "{{$pctSel->resp}}">
                    <input type="text" class="form-control" data-toggle="tooltip" title="Celular Ex: (61) 99234-5678" name="tel_resp" id="tel_resp" onkeypress="mascara(this, telefone)" maxlength="16" placeholder="(__) _____-____" required value = "{{$pctSel->tel_resp}}">
                </p>
                <div></div>
                <input type="text" data-toggle="tooltip" title="Contato adicional. Ex: Tiago da Silva (Filho)" class="form-control" name="resp2" id="resp2" placeholder="Ex: Tiago da Silva (Filho)" maxlength="30" value="{{$pctSel->resp2}}">
                <input type="text" class="form-control" data-toggle="tooltip" title="Celular Ex: (61) 99234-5678" name="tel_resp2" id="tel_resp2" onkeypress="mascara(this, telefone)" maxlength="16" placeholder="(__) _____-____" inputmode="text" value="{{$pctSel->tel_resp2}}">
                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Endereço<span style="color: red">*</span></strong>

                <div class="input-group col-sm-12">
                    <input type="text" class="form-control" data-toggle="tooltip" title="Digite o CEP para preencher o endereço automaticamente." name="cep" id="cep" size="10" maxlength="9" onkeypress="mascara(this, cep)" onblur="pesquisacep(this.value);" value="{{$pctSel->cep}}">
                    <div class="float-right">
                        <span class="input-group-text"><a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="blank" data-toggle="tooltip" title="Consultar Cep"><i class="far fa-question-circle"></i></a></i></span>
                    </div>
                </div>
                <div class="input-group col-sm-12">
                    <input type="text" class="form-control" data-toggle="tooltip" title="Rua, Rodovia, Avenida, Quadra, Conjunto"  name="rua" id="rua" placeholder="Logradouro" maxlength="50" required value="{{$pctSel->rua}}">
                </div>

                    <hr>

                    <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div> --}}
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-2">
                <ul class="nav nav-tabs">
                  <li class="nav-item"><a class="nav-link active" href="#tabDadosPct" data-toggle="tab">Dados</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tabEquipamentosPct" data-toggle="tab">Equipamentos</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Histórico</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="tabDadosPct">
<!---------------------------------------------------- FORMUÁRIO DADOS DO PACIENTE ------------------------------------------------>
                    <form action="{{route('edit_Pct_submit', $pctSel->id)}}" method="post" >

                        <div >
                        @csrf
                        <input type="hidden" name="id_pct" value="{{$pctSel->id}}">
                            <div class="row form-group">
                                <div class="col-sm-4">
                                    <label for="responsavel">Responsável:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" data-toggle="tooltip" title="Responsável pelo paciente. Ex: Maria da Silva (Esposa)" name="responsavel" id="responsavel" placeholder="Ex: Maria da Silva (Esposa)" maxlength="30" required value = "{{$pctSel->resp}}">
                                </div>
                                <div class="col-sm-2">
                                    <label for="tel_resp" style="color: white">.</label>
                                    <input type="text" class="form-control" data-toggle="tooltip" title="Celular Ex: (61) 99234-5678" name="tel_resp" id="tel_resp" onkeypress="mascara(this, telefone)" maxlength="16" placeholder="(__) _____-____" required value = "{{$pctSel->tel_resp}}">
                                </div>
                                <div class="col-sm-4">
                                    <label for="resp2" style="color: white">.</label>
                                    <input type="text" data-toggle="tooltip" title="Contato adicional. Ex: Tiago da Silva (Filho)" class="form-control" name="resp2" id="resp2" placeholder="Ex: Tiago da Silva (Filho)" maxlength="30" value="{{$pctSel->resp2}}">
                                </div>
                                <div class="col-sm-2">
                                    <label for="tel_resp2" style="color: white">.</label>
                                    <input type="text" class="form-control" data-toggle="tooltip" title="Celular Ex: (61) 99234-5678" name="tel_resp2" id="tel_resp2" onkeypress="mascara(this, telefone)" maxlength="16" placeholder="(__) _____-____" inputmode="text" value="{{$pctSel->tel_resp2}}">
                                </div>
                            </div>

                            <hr>

                            <div class="row form-group">
                                      <div class="col-sm-2">
                                          <label for="cep">Cep:</label>
                                          <div class="input-group input-group-sm">
                                              <input type="text" class="form-control" data-toggle="tooltip" title="Digite o CEP para preencher o endereço automaticamente." name="cep" id="cep" size="10" maxlength="9" onkeypress="mascara(this, cep)" onblur="pesquisacep(this.value);" value="{{$pctSel->cep}}">
                                              <div class="input-group-append">
                                                  <span class="input-group-text"><a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="blank" data-toggle="tooltip" title="Consultar Cep"><i class="far fa-question-circle"></i></a></i></span>
                                                </div>
                                            </div>
                                        </div>

                                <div class="col-sm-9">
                                    <label for="logradouro">Endereço:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" data-toggle="tooltip" title="Rua, Rodovia, Avenida, Quadra, Conjunto"  name="rua" id="rua" placeholder="Logradouro" maxlength="50" required value="{{$pctSel->rua}}">
                                </div>
                                <div class="col-sm-1">
                                    <label for="nr">Nº:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" data-toggle="tooltip" title="Número da Casa, Lote, Apt, Sala" name="nr" id="nr" maxlength="10"required value="{{$pctSel->nr}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="compl" id="compl" placeholder="Complemento"  data-toggle="tooltip" title="Complemento ou Ponto de referência" maxlength="30" value="{{$pctSel->compl}}">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro" required value="{{$pctSel->bairro}}">
                                </div>

                                <input type="text" class="form-control" name="cidade" id="cidade" style="display: none">
                                <div class="col-sm-3">
                                    <select name="city" id="city" class="form-control select" aria-hidden="true" required>

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
                        <div>
                            <div class=" float-right" >
                                {{-- <button type="button" class="btn btn-success swalDefaultSuccess">Launch Success Toast</button> --}}
                                {{-- Retornar para página anterior --}}
                                <a href="javascript:history.back()"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button></a>
                            <button type="submit" class="btn btn-primary swalDefaultSuccess">Salvar</button>
                            </div>
                        </div>
                    </form>

<!---------------------------------------------------- EQUIPAMENTOS DO PACIENTE ------------------------------------------------>
                </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tabEquipamentosPct">
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

                                    <table id="table_implantados" class="table table-sm  table-striped dataTable dtr-inline" role="grid" aria-describedby="table_implantados_info">

                                    <thead>
                                        <tr role="row">
                                            <th class="col-sm-1" style="text-align: center">#</th>
                                            {{-- <th>PCT</th> --}}
                                            <th style="text-align: center" class="sorting sorting_asc col-sm-1" tabindex="0" aria-controls="table_implantados" rowspan="1" colspan="1" aria-sort="ascending" title="Classificar crescente / decrescente">Patr</th>
                                            <th class="sorting col-sm-3" tabindex="0" aria-controls="table_implantados" rowspan="1" colspan="1">Equipamento</th>
                                            {{-- <th class="sorting" tabindex="0" aria-controls="table_implantados" rowspan="1" colspan="1" data-toggle="tooltip" title="Status do Equipamento" style="text-align: center"><i class="fas fa-cogs"></i></th> --}}
                                            {{-- <th class="sorting" tabindex="0" aria-controls="table_implantados" rowspan="1" colspan="1" data-toggle="tooltip" title="Alugado / Próprio"></th> --}}
                                            <th class="sorting" tabindex="0" aria-controls="table_implantados" rowspan="1" colspan="1" data-toggle="tooltip" title="Alugado / Próprio">A/P</th>
                                            <th class="sorting" tabindex="0" aria-controls="table_implantados" rowspan="1" colspan="1" data-toggle="tooltip" title="Alugado / Próprio">Início</th>
                                            <th class="sorting" tabindex="0" aria-controls="table_implantados" rowspan="1" colspan="1">
                                                <div data-toggle="modal" data-target="#">
                                                    <button data-toggle="tooltip" title="Adicionar novo Equipamento" type="button" class="btn btn-sm btn-outline-primary float-left" >
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($equipsPct as $equipPct)
                                            <tr class="odd" style="text-align: center; vertical-align: middle; line-height: 100%">
                                                <td style="text-align: center; vertical-align: middle">{{$equipPct->id}}</td>
                                                {{-- <td>{{$equip->pct_equip}}</td> --}}
                                                {{-- <td>
                                                    @if ($equip->pct_equip == '0')
                                                    @else
                                                        @foreach ($namePcts as $namePct)
                                                        @if ($namePct->id == $equip->id)
                                                            <p data-toggle="tooltip" data-placement="top" title="" data-original-title= {{$namePct->name_pct}} style="color:green" ><i class="fa fa-bed"></i></p>
                                                        @endif
                                                        @endforeach
                                                    @endif
                                                </td> --}}
                                                <td style="text-align: center; vertical-align: middle" class="dtr-control sorting_1" tabindex="0">{{$equipPct->patr}}</td>
                                                <td style="text-align: left; vertical-align: middle">{{$equipPct->name_equip}}</td>
                                                {{-- <td>{{$equip->status_equip}}</td> --}}
                                                {{-- <td style="text-align: center; vertical-align: middle"> --}}

                                                    {{-- @if ($equipPct->status_equip == '0')
                                                        <p style="color:green"><i class="fa fa-check"></i></p>
                                                    @else
                                                        <p style="color: red"><i class="fa fa-times"></i></p> --}}
                                                        {{-- <p data-toggle="tooltip" data-placement="top" title="" data-original-title="Em manutenção" style="color: red"><i class="fa fa-times"></i></p> --}}
                                                    {{-- @endif --}}


                                                <td style="text-align: left; vertical-align: middle">
                                                    {{-- Mostra a Alugado/Próprio --}}
                                                    @if ($equipPct->rent_equip == '0')
                                                        {{-- <p style="color:green"><i class="fa fa-check-circle"></i></p> --}}
                                                        {{-- <p data-toggle="tooltip" data-placement="top" title="" data-original-title="Próprio" style="color:green"><i class="fa fa-check-circle"></i></p> --}}
                                                    @else
                                                        @foreach ($fornecedores as $fornecedor)
                                                        @if ($fornecedor->id == $equipPct->rent_empresa)
                                                            {{-- <p style="color: rgb(247, 170, 3)"><i class="fa fa-exchange-alt"></i></p> --}}
                                                            {{-- <p data-toggle="tooltip" data-placement="top" title="" data-original-title="" style="color: rgb(247, 170, 3)"><i class="fa fa-exchange-alt"></i></p> --}}
                                                            {{$fornecedor->name_fornec}}
                                                        @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td style="text-align: left">
                                                    01/01/2021
                                                </td>
                                                <td style="text-align: left">
                                                    {{-- <div data-toggle="modal" data-target="#ModalEditPct" data-whatever="$Pct->id"> --}}
                                                    {{-- <div data-toggle="modal" data-target="#ModalEditPct" data-whatever="{{$Pct->id}}" data-whatever-name_pct="{{$Pct->name_pct}}" data-whatever-peso="{{$Pct->peso}}" data-whatever-altura="{{$Pct->altura}}" data-whatever-id_hc="{{$Pct->id_hc}}" data-whatever-resp="{{$Pct->resp}}" data-whatever-tel_resp="{{$Pct->tel_resp}}" data-whatever-resp2="{{$Pct->resp2}}" data-whatever-tel_resp2="{{$Pct->tel_resp2}}" data-whatever-cep_pct="{{$Pct->cep}}" data-whatever-rua="{{$Pct->rua}}" data-whatever-nr="{{$Pct->nr}}" data-whatever-compl="{{$Pct->compl}}" data-whatever-bairro="{{$Pct->bairro}}" data-whatever-city="{{$Pct->city}}" data-whatever-obs="{{$Pct->obs}}"> --}}
                                                    <div>
                                                        <span data-toggle="tooltip" title="Editar">
                                                            {{-- <a href="#" id="btnEditar" style="margin-right: 10px" ><i class="fas fa-exchange-alt"></i></a> --}}
                                                            <select name="solicita" id="solicita" class=" form-control form-control-sm select" aria-hidden="true">
                                                                <option value="0" >Selecione</option>
                                                                <option value="1"{{ $equipPct->status_equip == "1" ? 'selected' : ''}}>Reparo/Troca</option>
                                                                <option value="2"{{ $equipPct->status_equip == "2" ? 'selected' : ''}}>Recolhimento</option>
                                                                <option value="3"{{ $equipPct->status_equip == "3" ? 'selected' : ''}}>Recarga</option>
                                                            </select>
                                                        </span>

                                                    </div>
                                                </td>
                                                <td>
                                                    <span data-toggle="tooltip" title="Solicitação Pendente" style="text-align: center">
                                                        @if ($equipPct->id == 3)
                                                        <a href="#" data-toggle="modal" style="color: rgb(200, 200, 0)"><i class="fas fa-exclamation-triangle"></i></a>
                                                        @else
                                                        <a href="#" data-toggle="modal" data-target="#" style="color: rgb(200, 200, 0); visibility: hidden"><i class="fas fa-exclamation-triangle"></i></a>

                                                        @endif
                                                    </span>
                                                </td>
                                                </td>
                                            </tr>
                                        @endforeach



                                </tbody>
                                    <tfoot>
                                    {{-- <tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1" style="">CSS grade</th></tr> --}}
                                    </tfoot>
                                </table>

                                </div>
                            </div>
                            <div class="card-footer clearfix">
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
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

@stop

@section('css')

@stop

@section('js')


@stop

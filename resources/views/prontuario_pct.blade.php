@extends('adminlte::page')

@section('title', 'Prontuário do Paciente')

@section('content_header')

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
                  <label class="float-sm-right">{{$pctSel->name_pct}}</label>
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
                        </div>
                    </div>
                    </div>

                        <div>
                            <div class=" float-right" >
                                {{-- <button type="button" class="btn btn-success swalDefaultSuccess">Launch Success Toast</button> --}}
                                {{-- Retornar para página anterior --}}
                                <a href="javascript:history.back()"><button type="button" class="btn btn-outline-secondary " data-dismiss="modal">Cancelar</button></a>
                            <button type="submit" class="btn btn-outline-primary swalDefaultSuccess">Salvar</button>
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

                                    <table id="table_implantados" class="table table-sm table-striped dataTable dtr-inline" role="grid" aria-describedby="table_implantados_info">

                                    <thead>
                                        <tr role="row">
                                            {{-- <th>PCT</th> --}}
                                            <th style="text-align: center" class="sorting sorting_asc col-sm-1" tabindex="0" aria-controls="table_implantados" rowspan="1" colspan="1" aria-sort="ascending" title="Classificar crescente / decrescente">Patr</th>
                                            <th class="sorting col-sm-3" tabindex="0" aria-controls="table_implantados" rowspan="1" colspan="1">Equipamento</th>
                                            <th class="sorting col-sm-2" tabindex="0" aria-controls="table_implantados" rowspan="1" colspan="1">
                                                <div>
                                                    <span data-toggle="modal" data-target="#modalSolicit">
                                                        <button data-toggle="tooltip" title="Adicionar novo Equipamento" type="button" class="btn btn-sm btn-outline-primary float-left" style="margin-right: 10px" >
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </span>
                                                    <button data-toggle="tooltip" title="Recolhimento Total" type="button" class="btn btn-sm btn-outline-primary float-left" style="color: red; margin-right: 10px">
                                                        <i class="fas fa-sort-amount-down"></i>
                                                    </button>
                                                    <button data-toggle="tooltip" title="Pausa nos Esquipamentos" type="button" class="btn btn-sm btn-outline-primary float-left" style="color: rgb(14, 121, 0)">
                                                        <i class="far fa-pause-circle"></i>
                                                    </button>
                                                </div>
                                            </th>
                                            <th class="sorting col-sm-6" tabindex="0" aria-controls="table_implantados" rowspan="1" colspan="1">Observações</th>
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
                                                <td style="text-align: left">
                                                    {{-- <div data-toggle="modal" data-target="#ModalEditPct" data-whatever="$Pct->id"> --}}
                                                    {{-- <div data-toggle="modal" data-target="#ModalEditPct" data-whatever="{{$Pct->id}}" data-whatever-name_pct="{{$Pct->name_pct}}" data-whatever-peso="{{$Pct->peso}}" data-whatever-altura="{{$Pct->altura}}" data-whatever-id_hc="{{$Pct->id_hc}}" data-whatever-resp="{{$Pct->resp}}" data-whatever-tel_resp="{{$Pct->tel_resp}}" data-whatever-resp2="{{$Pct->resp2}}" data-whatever-tel_resp2="{{$Pct->tel_resp2}}" data-whatever-cep_pct="{{$Pct->cep}}" data-whatever-rua="{{$Pct->rua}}" data-whatever-nr="{{$Pct->nr}}" data-whatever-compl="{{$Pct->compl}}" data-whatever-bairro="{{$Pct->bairro}}" data-whatever-city="{{$Pct->city}}" data-whatever-obs="{{$Pct->obs}}"> --}}
                                                    <div>
                                                        <span data-toggle="tooltip" title="Selecione o tipo de solicitação para este ítem.">
                                                            {{-- <a href="#" id="btnEditar" style="margin-right: 10px" ><i class="fas fa-exchange-alt"></i></a> --}}
                                                            <select name="solicita" id="solicita" class=" form-control form-control-sm select" aria-hidden="true">
                                                                <option value="0" >Selecione</option>
                                                                <option value="1"{{ $equipPct->status_equip == "1" ? 'selected' : ''}}>Manutenção/Troca</option>
                                                                <option value="2"{{ $equipPct->status_equip == "2" ? 'selected' : ''}}>Recolhimento</option>
                                                                <option value="3"{{ $equipPct->status_equip == "3" ? 'selected' : ''}}>Recarga</option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" class=" form-control form-control-sm" data-toggle="tooltip" title="Descrição da solicitação" maxlength="100">
                                                </td>
                                                <td>
                                                    <span data-toggle="tooltip" title="Solicitação Pendente" style="text-align: center">
                                                        @if ($equipPct->status_equip > 0)
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
                            <div>
                                <p>Total de itens implantados: {{$equipsCount}}</p>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <p>teste</p>
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
                <!--//////////////////////////////////////////////////// Modal SOLICITAÇÃO /////////////////////////////////////////////-->
                <div class="modal fade" id="modalSolicit" tabindex="-1" role="dialog" aria-labelledby="modalSolicit" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="modalSolicit">Solicitar Novo Equipamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        <form action="#" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <div class="row form-group">
                                    <div class="col-sm-12">
                                        <div class="card-body table-responsive p-0" style="height: 300px;">
                                            <table class="table table-sm table-striped table-head-fixed text-nowrap">
                                              <thead>
                                                <tr>
                                                  <th>#</th>
                                                  <th>Equipamento</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach ( $equipsEstoque as $equipEstoque)
                                                    <tr class="odd" style="vertical-align: middle; line-height: 100%">
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-check" onchange="funcEquipsSel()">
                                                                    <input class="form-check-input" type="checkbox" style="transform: scale(1.2)">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{$equipEstoque->name_equip}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                              </tbody>
                                            </table>
                                            <p>{{$equipsEstoqueCount}}</p>
                                          </div>
                                    </div>
                                </div>
                        </div>
                        <p id="equipsSelecionados"></p>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <a href=""></a>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
<!--//////////////////////////////////////////////////// FIM MODAL SOLICITAÇÃO ////////////////////////////////////////////////-->
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

<link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">

@stop

@section('js')

public function funcEquipsSel(){

}
<!-- Select2 -->
<script src= {{asset('js/select2.full.min.js')}}></script>

<script src= {{asset('js/bootstrap.bundle.min.js')}}></script>

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
      $('#reservationdate').datetimepicker({
          format: 'L'
      });

      //Date and time picker
      $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'DD/MM/YYYY hh:mm A'
        }
      })
      //Date range as a button
      $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      //Timepicker
      $('#timepicker').datetimepicker({
        format: 'LT'
      })

      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()

      $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      })

    })
</script>

<script src= {{asset('js/jquery.inputmask.min.js')}}></script>

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


@stop

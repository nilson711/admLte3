@extends('adminlte::page')

@section('title', 'Pcts')

@section('content_header')

@stop

@section('content')

<body>

</body>

    <div class="card">
        <div class="card-header" >
          <h3 class="card-title">Pacientes</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                {{-- <div class="col-sm-8 col-md-6">
                    <div class="dt-buttons btn-group flex-wrap"></div>
                </div> --}}
                {{-- <div class="col-sm-4 col-md-4"> --}}
                    {{-- <div id="example1_filter" class="dataTables_filter"></div> --}}
                {{-- </div> --}}

                <div class="col-sm-8 col-md-6" style="margin-bottom: -30px">
                    <div class="dt-buttons btn-group flex-wrap"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">

                    <table id="example1" class="table table-sm  table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

                        <thead>
                            <tr role="row">
                                <th class="col-sm-1" style="text-align: center">#</th>
                                <th class="sorting sorting_asc col-sm-3" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" title="Classificar crescente / decrescente">Nome</th>
                                <th class="sorting col-sm-5" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Endereço</th>
                                {{-- <th class="sorting col-sm-1" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Bairro</th> --}}
                                <th class="sorting col-sm-1" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Cidade</th>
                                <th class="sorting col-sm-1" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"></th>

                                {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Telefone</th> --}}
                                {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Celular</th> --}}
                                {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Home Care</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <div data-toggle="modal" data-target="#ModalAddPct">
                                <button data-toggle="tooltip" title="Adicionar novo Paciente" type="button" class="btn btn-sm btn-outline-primary float-right" ><i class="fas fa-plus"></i></button>
                            </div>

                            @foreach ($allPcts as $Pct)
                            <tr class="odd" style="line-height: 100%">
                                <td style="text-align: center">
                                    <div >{{$Pct->id}}</div>
                                </td>


                                <td>{{$Pct->name_pct}}</td>
                                <td><span id="rua_pct">{{$Pct->rua_pct}}</span>

                                {{-- @php //BLOCO DE PHP QUE BUSCA NA STRING SE EXISTE UMA PALAVRA ESPECÍFICA
                                    $stringBase     = $Pct->rua_pct;                //base na qual será efetuada a pesquisa
                                    $stringPesquisa = 'Bloco';                      //o termo que desejamos pesquisar na string base
                                    $stringRes = strpos($stringBase, $stringPesquisa);
                                    if ($stringRes>1) {
                                        echo "Apt";
                                    }else {
                                        echo "CS";
                                    }
                                @endphp --}}


                                    {{$Pct->nr_end_pct}} ({{$Pct->compl_pct}}) {{$Pct->bairro_pct}}</td>

                                <td>
                                    @foreach ( $allCities as $City)
                                        @if ($City->id == $Pct->city_pct)
                                            {{$City->nome}}
                                        @endif
                                    @endforeach
                                </td>

                                <td style="text-align: center">
                                    <div>
                                    {{-- <div data-toggle="modal" data-target="#ModalEditPct"> --}}
                                        <a href="{{route('editPct', ['id'=> $Pct->id])}}" id="btnEditar" data-toggle="tooltip" title="Editar" ><i class="fas fa-edit"></i></a>
                                        {{-- FAZER EDIÇÃO POR AJAX (https://pt.stackoverflow.com/questions/261832/editar-dentro-de-um-modal) --}}
                                    </div>
                                </td>
                                {{-- <td>{{$Pct->tel1_pct}}</td> --}}
                                {{-- <td>{{$Pct->tel2_pct}}</td> --}}
                                {{-- <td>{{$Pct->id_hc}}</td> --}}
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



<!--///////////////////////////////// Modal NOVO PACIENTE /////////////////////////////////////////////-->
                <div class="modal fade" id="ModalAddPct" tabindex="-1" role="dialog" aria-labelledby="ModalAddPct" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="ModalAddPct">Adicionar Novo Paciente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        <form action="{{route('new_Pct_submit')}}" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <div class="row form-group">
                                    <div class="col-sm-6">
                                        <label for="Pct">Paciente: <span style="color: red">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="Pct" id="Pct" placeholder="Nome Completo do Paciente" maxlength="50" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="peso">Peso:</label>
                                        <select name="peso" id="peso" class="form-control form-control-sm select" aria-hidden="true">
                                            <option selected value="0" >Selecione</option>
                                            <option value="1">Até 90kg</option>
                                            <option value="2">Entre 90kg e 180kg</option>
                                            <option value="3">Acima de 180kg</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="altura">Altura:</label>
                                        <select name="altura" id="altura" class="form-control form-control-sm select" aria-hidden="true">
                                            <option selected value="0" selected>Selecione</option>
                                            <option value="1">- 1,90m</option>
                                            <option value="2">+ 1,90m</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="hc">Home Care:<span style="color: red">*</span></label>
                                        <select name="hc" id="hc" class="form-control form-control-sm select" style="width: 100%;" aria-hidden="true" required>
                                            <option selected value="0">Selecione</option>
                                            @foreach ($clientes as $cliente)
                                                    <option value="{{$cliente->id}}">{{$cliente->cliente}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-4">
                                        <label for="responsavel">Responsável:<span style="color: red">*</span></label>
                                        <input type="text" class="form-control form-control-sm" data-toggle="tooltip" title="Responsável pelo paciente. Ex: Maria da Silva (Esposa)" name="responsavel" id="responsavel" placeholder="Ex: Maria da Silva (Esposa)" maxlength="30" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="tel_resp" style="color: white">.</label>
                                        <input type="text" class="form-control form-control-sm" data-toggle="tooltip" title="Celular Ex: (61) 9234-5678" style="font-size: 90%" name="tel_resp" id="tel_resp" onkeypress="mascara(this, telefone)" maxlength="15" placeholder="(__) _____-____" required>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="resp2" style="color: white">.</label>
                                        <input type="text" data-toggle="tooltip" title="Contato adicional. Ex: Tiago da Silva (Filho)" class="form-control form-control-sm" name="resp2" id="resp2" placeholder="Ex: Tiago da Silva (Filho)" maxlength="30">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="tel_resp2" style="color: white">.</label>
                                        <input type="text" class="form-control form-control-sm" data-toggle="tooltip" title="Celular Ex: (61) 9234-5678" name="tel_resp2" id="tel_resp2" onkeypress="mascara(this, telefone)" maxlength="15" placeholder="(__) _____-____" inputmode="text">
                                    </div>
                                </div>

                                <hr>

                                <div class="row form-group">
                                          <div class="col-sm-2">
                                              <label for="cep">Cep:</label>
                                              <div class="input-group input-group-sm">
                                                  <input type="text" class="form-control" data-toggle="tooltip" title="Digite o CEP (somente números) para preencher o endereço automaticamente." name="cep" id="cep" size="10" maxlength="8" onblur="pesquisacep(this.value);">
                                                  <div class="input-group-append">
                                                      <span class="input-group-text"><a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="blank" data-toggle="tooltip" title="Consultar Cep"><i class="far fa-question-circle"></i></a></i></span>
                                                    </div>
                                                </div>
                                            </div>

                                    <div class="col-sm-9">
                                        <label for="logradouro">Endereço:<span style="color: red">*</span></label>
                                        <input type="text" class="form-control form-control-sm" data-toggle="tooltip" title="Rua, Rodovia, Avenida, Quadra, Conjunto"  name="rua" id="rua" placeholder="Logradouro" maxlength="50" required>
                                    </div>
                                    <div class="col-sm-1">
                                        <label for="nr">Nº:<span style="color: red">*</span></label>
                                        <input type="text" class="form-control form-control-sm" data-toggle="tooltip" title="Número da Casa, Lote, Apt, Sala" name="nr" id="nr" maxlength="10"required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" name="compl" id="compl" placeholder="Complemento"  data-toggle="tooltip" title="Complemento ou Ponto de referência" maxlength="30">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" name="bairro" id="bairro" placeholder="Bairro" required>
                                    </div>

                                    <input type="text" class="form-control form-control-sm" name="cidade" id="cidade" style="display: none">
                                    <div class="col-sm-3">
                                        <select name="city" id="city" class="form-control form-control-sm select" aria-hidden="true" required>
                                            <option selected value="">Selecione a Cidade</option>
                                            @foreach ( $allCities as $City)
                                                <option value={{$City->id}}>
                                                    {{$City->nome}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-1">
                                        <input type="text" class="form-control form-control-sm" name="uf" id="uf" placeholder="uf" required>
                                        {{-- <select name="uf" id="uf" class="form-control form-control-sm select" aria-hidden="true">
                                            <option selected value="7">DF</option> --}}
                                            {{-- @foreach ($fornecedores as $fornecedor) --}}
                                                    {{-- <option value="{{$fornecedor->id}}">{{$fornecedor->name_fornec}}</option> --}}
                                                {{-- @endforeach --}}
                                            {{-- </select> --}}
                                    </div>

                                    {{-- <div class="col-sm-1" data-toggle="tooltip" title="Localização">
                                        <button type="button" class="btn btn-sm btn-primary">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </button>
                                    </div> --}}


                                </div>

                                <div class="row form-group">
                                    <div class="col-sm-12">
                                        <label for="obs">Observações:</label>
                                        <input type="text" class="form-control form-control-sm" name="obs" id="obs" placeholder="Observações sobre o paciente" maxlength="100">
                                    </div>
                                </div>
                                {{-- <div class="col-sm-1" style="visibility: hidden">
                                    <input type="text" class="form-control form-control-sm" name="cidade" id="cidade" placeholder="Cidade" required>
                                </div> --}}
                        </div>
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

<!--///////////////////////////////// Modal EDITAR PACIENTE /////////////////////////////////////////////-->
                <div class="modal fade" id="ModalEditPct" tabindex="-1" role="dialog" aria-labelledby="ModalEditPct" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="ModalEditPct">Editar Paciente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        <form action="#" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <div class="row form-group">
                                    <div class="col-sm-6">
                                        <label for="editPct">Paciente: <span style="color: red">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="editPct" id="editPct" placeholder="Nome Completo do Paciente" maxlength="50" required value="{{$Pct->name_pct}}">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="peso">Peso:</label>
                                        <select name="editpeso" id="editpeso" class="form-control form-control-sm select" aria-hidden="true">
                                            <option selected value="0" value="{{$Pct->peso}}" >Selecione</option>
                                            <option value="1">Até 90kg</option>
                                            <option value="2">Entre 90kg e 180kg</option>
                                            <option value="3">Acima de 180kg</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="editaltura">Altura:</label>
                                        <select name="editaltura" id="editaltura" class="form-control form-control-sm select" aria-hidden="true">
                                            <option selected value="{{$Pct->altura}}" selected>Selecione</option>
                                            <option value="1">- 1,90m</option>
                                            <option value="2">+ 1,90m</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="edithc">Home Care:<span style="color: red">*</span></label>
                                        <select name="edithc" id="edithc" class="form-control form-control-sm select" style="width: 100%;" aria-hidden="true" required>
                                            <option selected value="{{$Pct->id_hc}}">Selecione</option>
                                            @foreach ($clientes as $cliente)
                                                    <option value="{{$cliente->id}}">{{$cliente->cliente}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-4">
                                        <label for="editresponsavel">Responsável:<span style="color: red">*</span></label>
                                        <input type="text" class="form-control form-control-sm" data-toggle="tooltip" title="Responsável pelo paciente. Ex: Maria da Silva (Esposa)" name="responsavel" id="editresponsavel" placeholder="Ex: Maria da Silva (Esposa)" maxlength="30" required value="{{$Pct->resp}}">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="edittel_resp" style="color: white">.</label>
                                        <input type="text" class="form-control form-control-sm" data-toggle="tooltip" title="Celular Ex: (61) 9234-5678" style="font-size: 90%" name="edittel_resp" id="edittel_resp" onkeypress="mascara(this, telefone)" maxlength="15" placeholder="(__) _____-____" required value="{{$Pct->tel_rep}}">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="editresp2" style="color: white">.</label>
                                        <input type="text" data-toggle="tooltip" title="Contato adicional. Ex: Tiago da Silva (Filho)" class="form-control form-control-sm" name="editresp2" id="editresp2" placeholder="Ex: Tiago da Silva (Filho)" maxlength="30" value="{{$Pct->resp2}}">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="edittel_resp2" style="color: white">.</label>
                                        <input type="text" class="form-control form-control-sm" data-toggle="tooltip" title="Celular Ex: (61) 9234-5678" name="edittel_resp2" id="edittel_resp2" onkeypress="mascara(this, telefone)" maxlength="15" placeholder="(__) _____-____" inputmode="text" value="{{$Pct->tel_resp2}}">
                                    </div>
                                </div>

                                <hr>

                                <div class="row form-group">
                                          <div class="col-sm-2">
                                              <label for="editcep">Cep:</label>
                                              <div class="input-group input-group-sm">
                                                  <input type="text" class="form-control" data-toggle="tooltip" title="Digite o CEP (somente números) para preencher o endereço automaticamente." name="editcep" id="editcep" size="10" maxlength="8" onblur="pesquisacep(this.value);">
                                                  <div class="input-group-append" value="{{$Pct->cep_pct}}">
                                                      <span class="input-group-text"><a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="blank" data-toggle="tooltip" title="Consultar Cep"><i class="far fa-question-circle"></i></a></i></span>
                                                    </div>
                                                </div>
                                            </div>

                                    <div class="col-sm-9">
                                        <label for="editlogradouro">Endereço:<span style="color: red">*</span></label>
                                        <input type="text" class="form-control form-control-sm" data-toggle="tooltip" title="Rua, Rodovia, Avenida, Quadra, Conjunto"  name="editrua" id="editrua" placeholder="Logradouro" maxlength="50" required value="{{$Pct->rua_pct}}">
                                    </div>
                                    <div class="col-sm-1">
                                        <label for="editnr">Nº:<span style="color: red">*</span></label>
                                        <input type="text" class="form-control form-control-sm" data-toggle="tooltip" title="Número da Casa, Lote, Apt, Sala" name="editnr" id="editnr" maxlength="10"required value="{{$Pct->nr_end_pct}}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" name="editcompl" id="editcompl" placeholder="Complemento"  data-toggle="tooltip" title="Complemento ou Ponto de referência" maxlength="30" value="{{$Pct->compl_pct}}">>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" name="editbairro" id="editbairro" placeholder="Bairro" required value="{{$Pct->bairro_pct}}">>
                                    </div>

                                    <input type="text" class="form-control form-control-sm" name="editcidade" id="editcidade" style="display: none">
                                    <div class="col-sm-3">
                                        <select name="editcity" id="editcity" class="form-control form-control-sm select" aria-hidden="true" required>
                                            <option selected value="{{$Pct->city_pct}}">>Selecione a Cidade</option>
                                            @foreach ( $allCities as $City)
                                                <option value={{$City->id}}>
                                                    {{$City->nome}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-1">
                                        <input type="text" class="form-control form-control-sm" name="edituf" id="edituf" placeholder="uf" required>
                                        {{-- <select name="uf" id="uf" class="form-control form-control-sm select" aria-hidden="true">
                                            <option selected value="7">DF</option> --}}
                                            {{-- @foreach ($fornecedores as $fornecedor) --}}
                                                    {{-- <option value="{{$fornecedor->id}}">{{$fornecedor->name_fornec}}</option> --}}
                                                {{-- @endforeach --}}
                                            {{-- </select> --}}
                                    </div>

                                    {{-- <div class="col-sm-1" data-toggle="tooltip" title="Localização">
                                        <button type="button" class="btn btn-sm btn-primary">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </button>
                                    </div> --}}


                                </div>

                                <div class="row form-group">
                                    <div class="col-sm-12">
                                        <label for="editobs">Observações:</label>
                                        <input type="text" class="form-control form-control-sm" name="editobs" id="editobs" placeholder="Observações sobre o paciente" maxlength="100" value="{{$Pct->obs_pct}}>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-1" style="visibility: hidden">
                                    <input type="text" class="form-control form-control-sm" name="cidade" id="cidade" placeholder="Cidade" required>
                                </div> --}}
                        </div>
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

            </div>

        <!-- /.card-body -->
        </div>

</section>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="css/admin_custom.css"> --}}
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="css/css">
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="css/all.min.css"> --}}

    <!-- DataTables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.min.css">
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script src="js/dataTables.responsive.min.js"></script>
    <script src="js/responsive.bootstrap4.min.js"></script>
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/buttons.bootstrap4.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>
    <script src="js/buttons.colVis.min.js"></script>
    {{-- <script src="js/localizaz.js"></script> --}}
    <!-- AdminLTE App -->
    <script src="js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="js/demo.js"></script>

    <!-- Page specific script -->

    <script>
        function numberToReal(numero) {
    var numero = numero.toFixed(2).split('.');
    numero[0] = "R$ " + numero[0].split(/(?=(?:...)*$)/).join('.');
    return numero.join(',');
}

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
function telefone(v){
    v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
    v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
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
function cep(v){
    // v=v.replace(/D/g,"")                //Remove tudo o que não é dígito
    v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/^(\d{5})(\d)/,"$1-$2") //Esse é tão fácil que não merece explicações
    return v
}function soNumeros(v){
    return v.replace(/\D/g,"")
}
function telefone(v){
    v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
    v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
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
    </script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

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


<!-- jQuery -->
{{-- <script src="js/jquery.min.js"></script> --}}
<!-- Bootstrap 4 -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="js/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="js/moment.min.js"></script>
<script src="js/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="js/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="js/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<script src="js/functions-equips.js"></script>
<script src="js/buscacep.js"></script>
{{-- <script src="js/localizaz.js"></script> --}}



<script>
  $(function () {
  $('#datetimepicker5').datetimepicker({
    locale: 'pt-br'
  });
});
</script>
<script>
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<script>
    function verificatexto(){
        var str = "Welcomo to TecAdmin.net";
        var result = str.indexOf("Tec")>-1;
        alert(result);
    }
</script>
<script>
    function funcTipoResid(){
        var strRua = document.getElementById("rua_pct");
        var resTipo = strRua.indexOf("Bloco")>-1;
        var tipoResid = document.getElementById("tipo_resid");
        // if (resTipo == true) {
        //     tipoResid.innerHTML = "Bloco";
        // } else {
        //     tipoResid.innerHTML = "Casa";
        // }
        alert('é bloco');
    }
</script>


@stop


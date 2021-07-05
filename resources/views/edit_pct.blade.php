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
            <div class="row">

                <div class="col-md-12">
            
                  <div class="card">
                  {{-- <div class="card-header"> --}}
                    {{-- <h3 class="card-title">Solicitações</h3> --}}
            
                  {{-- </div> --}}
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                      {{-- <form action="{{route('update', $Pct->id)}}" method="post"> --}}
                      <form action="#" method="post">
                        {{ method_field('PUT') }}
                        <div class="modal-body">
                        @csrf
                          <div class="form-group">
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <label for="Pct">Paciente: <span style="color: red">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="Pct" id="Pct" placeholder="Nome Completo do Paciente" maxlength="50" value="{{$pctSel->name_pct}}">
                                </div>
                                <div class="col-sm-2">
                                    <label for="peso">Peso:</label>
                                    <select name="peso" id="peso" class="form-control form-control-sm select" aria-hidden="true">
                                        <option value="0" >Selecione</option>
                                        <option value="1"{{ $pctSel->peso == "1" ? 'selected' : ''}}>Até 90kg</option>
                                        <option value="2"{{ $pctSel->peso == "2" ? 'selected' : ''}}>Entre 90kg e 180kg</option>
                                        <option value="3"{{ $pctSel->peso == "3" ? 'selected' : ''}}>Acima de 180kg</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label for="altura">Altura:</label>
                                    <select name="altura" id="altura" class="form-control form-control-sm select" aria-hidden="true">
                                        <option selected value = "{{$pctSel->altura}}" selected>Selecione</option>
                                        <option value="1" {{ $pctSel->altura == "1" ? 'selected' : ''}}>- 1,90m</option>
                                        <option value="2" {{ $pctSel->altura == "2" ? 'selected' : ''}}>+ 1,90m</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label for="hc">Home Care:<span style="color: red">*</span></label>
                                    <select name="hc" id="hc" class="form-control form-control-sm select" style="width: 100%;" aria-hidden="true" required>]
                                        
                                        {{--  
                                                Seleciona dentro do Foreach o id correpondente ao Home Care utilizando If ternário. 
                                                Lógica: Se o Id do Cliente (home care) for igual ao Id do HC do Paciente então coloque a propriedade 'selected' : caso contário não faça nada ''
                                        --}}
                                        @foreach ($clientes as $cliente)
                                            <option value = "{{$cliente->id}}" {{$cliente->id == $pctSel->id_hc ? 'selected' : ''}}>{{$cliente->cliente}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4">
                                    <label for="responsavel">Responsável:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control form-control-sm" data-toggle="tooltip" title="Responsável pelo paciente. Ex: Maria da Silva (Esposa)" name="responsavel" id="responsavel" placeholder="Ex: Maria da Silva (Esposa)" maxlength="30" required value = "{{$pctSel->resp}}">
                                </div>
                                <div class="col-sm-2">
                                    <label for="tel_resp" style="color: white">.</label>
                                    <input type="text" class="form-control form-control-sm" data-toggle="tooltip" title="Celular Ex: (61) 9234-5678" style="font-size: 90%" name="tel_resp" id="tel_resp" onkeypress="mascara(this, telefone)" maxlength="15" placeholder="(__) _____-____" required value = "{{$pctSel->tel_resp}}">
                                </div>
            
                                <div class="col-sm-4">
                                    <label for="resp2" style="color: white">.</label>
                                    <input type="text" data-toggle="tooltip" title="Contato adicional. Ex: Tiago da Silva (Filho)" class="form-control form-control-sm" name="resp2" id="resp2" placeholder="Ex: Tiago da Silva (Filho)" maxlength="30" value="{{$pctSel->resp2}}">
                                </div>
                                <div class="col-sm-2">
                                    <label for="tel_resp2" style="color: white">.</label>
                                    <input type="text" class="form-control form-control-sm" data-toggle="tooltip" title="Celular Ex: (61) 9234-5678" name="tel_resp2" id="tel_resp2" onkeypress="mascara(this, telefone)" maxlength="15" placeholder="(__) _____-____" inputmode="text" value="{{$pctSel->tel_resp2}}">
                                </div>
                            </div>
            
                            <hr>
            
                            <div class="row form-group">
                                      <div class="col-sm-2">
                                          <label for="cep">Cep:</label>
                                          <div class="input-group input-group-sm">
                                              <input type="text" class="form-control" data-toggle="tooltip" title="Digite o CEP (somente números) para preencher o endereço automaticamente." name="cep" id="cep" size="10" maxlength="8" onblur="pesquisacep(this.value);" value="{{$pctSel->cep}}">
                                              <div class="input-group-append">
                                                  <span class="input-group-text"><a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="blank" data-toggle="tooltip" title="Consultar Cep"><i class="far fa-question-circle"></i></a></i></span>
                                                </div>
                                            </div>
                                        </div>
            
                                <div class="col-sm-9">
                                    <label for="logradouro">Endereço:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control form-control-sm" data-toggle="tooltip" title="Rua, Rodovia, Avenida, Quadra, Conjunto"  name="rua" id="rua" placeholder="Logradouro" maxlength="50" required value="{{$pctSel->rua}}">
                                </div>
                                <div class="col-sm-1">
                                    <label for="nr">Nº:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control form-control-sm" data-toggle="tooltip" title="Número da Casa, Lote, Apt, Sala" name="nr" id="nr" maxlength="10"required value="{{$pctSel->nr}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" name="compl" id="compl" placeholder="Complemento"  data-toggle="tooltip" title="Complemento ou Ponto de referência" maxlength="30" value="{{$pctSel->compl}}">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" name="bairro" id="bairro" placeholder="Bairro" required value="{{$pctSel->bairro}}">
                                </div>
            
                                <input type="text" class="form-control form-control-sm" name="cidade" id="cidade" style="display: none">
                                <div class="col-sm-3">
                                    <select name="city" id="city" class="form-control form-control-sm select" aria-hidden="true" required>
                        
                {{-- Seleciona dentro do Foreach a cidade com  o id correspondente --}}
                                        @foreach ( $allCities as $city)
                                            <option value="{{$city->id}}" {{$city->id == $pctSel->city ? 'selected' : ''}} >{{$city->nome}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
            
                                <div class="col-sm-1">
                                    <input type="text" class="form-control form-control-sm" name="uf" id="uf" placeholder="uf" >
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
                                    <input type="text" class="form-control form-control-sm" name="obs" id="obs" placeholder="Observações sobre o paciente" maxlength="100" value="{{$pctSel->obs}}">
                                </div>
                            </div>
                            {{-- <div class="col-sm-1" style="visibility: hidden">
                                <input type="text" class="form-control form-control-sm" name="cidade" id="cidade" placeholder="Cidade" required>
                            </div> --}}
                          </div>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                {{-- Retornar para página anterior --}}
                                <a href="javascript:history.back()"> 
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button></a>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                    </form>
                  </div>
                  <!-- /.card-body -->
                  </div>
                </div>
              </div>
           
            <div class="card-footer clearfix">

            </div>
        </div>

</section>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="css/admin_custom.css"> --}}
    <!-- Google Font: Source Sans Pro -->

@stop

@section('js')

<script>
    // <!-- Adicionando Javascript -->


    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
            // document.getElementById('ibge').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
            //Busca o nome da cidade no campo cidade
            var text1 = document.getElementById('cidade').value;
                // alert(text1);
                //Seleciona a Cidade no Select
                $("#city option").filter(function() {
                    return this.text == text1;
                }).attr('selected', true);
            // document.getElementById('ibge').value=(conteudo.ibge);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";
                // document.getElementById('ibge').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);



            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

   

</script>


@stop


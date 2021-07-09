@extends('adminlte::page')

@section('title', 'Editar Pct')

@section('content_header')

@stop

@section('content')

<body>

    <div class="card" style="margin-top: -15px">
        <div class="card-header" >
          <h3 class="card-title">Editar dados do Paciente</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">

                  <div class="card-body p-0">
                      <form action="{{route('edit_Pct_submit', $pctSel->id)}}" method="post" >

                        <div class="modal-body" >
                        @csrf
                        <input type="hidden" name="id_pct" value="{{$pctSel->id}}">
                          <div class="form-group">
                            <div class="row form-group" style="margin-top: -20px">
                                <div class="col-sm-6">
                                    <label for="Pct">Paciente: <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="Pct" id="Pct" placeholder="Nome Completo do Paciente" maxlength="50" value="{{$pctSel->name_pct}}">
                                </div>
                                <div class="col-sm-2">
                                    <label for="peso">Peso:</label>
                                    <select name="peso" id="peso" class="form-control select" aria-hidden="true">
                                        <option value="0" >Selecione</option>
                                        <option value="1"{{ $pctSel->peso == "1" ? 'selected' : ''}}>Até 90kg</option>
                                        <option value="2"{{ $pctSel->peso == "2" ? 'selected' : ''}}>Entre 90kg e 180kg</option>
                                        <option value="3"{{ $pctSel->peso == "3" ? 'selected' : ''}}>Acima de 180kg</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label for="altura">Altura:</label>
                                    <select name="altura" id="altura" class="form-control select" aria-hidden="true">
                                        <option selected value = "{{$pctSel->altura}}" selected>Selecione</option>
                                        <option value="1" {{ $pctSel->altura == "1" ? 'selected' : ''}}>- 1,90m</option>
                                        <option value="2" {{ $pctSel->altura == "2" ? 'selected' : ''}}>+ 1,90m</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label for="hc">Home Care:<span style="color: red">*</span></label>
                                    <select name="hc" id="hc" class="form-control select" style="width: 100%;" aria-hidden="true" required>]

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
                        <div class="modal-footer" style="margin-top: -20px">
                            <div class="form-group">
                                {{-- <button type="button" class="btn btn-success swalDefaultSuccess">Launch Success Toast</button> --}}
                                {{-- Retornar para página anterior --}}
                                <a href="javascript:history.back()"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button></a>
                            <button type="submit" class="btn btn-primary swalDefaultSuccess">Salvar</button>
                            </div>
                        </div>
                    </form>
                  </div>
                  <!-- /.card-body -->

                </div>
              </div>

        </div>

</section>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="css/admin_custom.css"> --}}
    <link rel="stylesheet" href={{asset('css/css')}}>
    <link rel="stylesheet" href={{asset('css/adminlte.min.css')}}>

    <!-- Toastr -->
    <link rel="stylesheet" href= {{asset('css/toastr.min.css')}}>
     <!-- SweetAlert2 -->
    <link rel="stylesheet" href= {{asset('css/bootstrap-4.min.css')}}>


@stop

@section('js')

<script src= {{asset('js/sweetalert2.min.js')}}></script>
<script src= {{asset('js/toastr.min.js')}}></script>

<script>
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src= {{asset('js/jquery.min.js')}}></script>
<script src= {{asset('js/popper.min.js')}}></script>
<!-- Bootstrap 4 -->
<script src= {{asset('js/bootstrap.bundle.min.js')}}></script>
<!-- AdminLTE App -->
<script src= {{asset('js/adminlte.min.js')}}></script>
<script src= {{asset('js/demo.js')}}></script>

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
                // Coloca máscará de entrada para o CEP. Coloca o "-" após o 5º dígito
                document.getElementById('cep').value = cep.substring(0,5) +"-" +cep.substring(5);

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
</script>
<script>
    $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Dados do Paciente atualizados com sucesso!'
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
        icon: 'fas fa-envelope fa-lg',
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
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
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


@stop

</body>

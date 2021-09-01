@extends('adminlte::page')

@section('title', 'Editar Pct')

@section('content_header')

@stop

@section('content')

<body>

<div class="col-md-12">
  
  <p>Detalhes da Solicitação</p>

  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">
        @switch($solicitSel->type_solicit)
              @case(1)
                  <i class="fas fa-plus-circle fa-lg" data-toggle="tooltip"
                      title="Implantação"
                      style="color: rgb(255, 255, 255)"></i>
              @break
              @case(2)
                  <i class="fas fa-minus-circle fa-lg" data-toggle="tooltip"
                      title=" Recolhimento"
                      style="color: black"></i>
              @break
              @case(3)
                  <i class="fas fa-tools fa-lg" data-toggle="tooltip"
                      title="Troca/Manutenção"
                      style="color: rgb(255, 255, 255)"></i>
              @break
              @case(4)
                  <i class="fas fa-dolly fa-lg" data-toggle="tooltip"
                      title="Mudança"></i>
              @break
              @case(5)
                  <i class="fas fa-times-circle fa-lg" data-toggle="tooltip"
                      title="Recolhimento Total"
                      style="color: rgb(0, 0, 0)"></i>
              @break
              @case(6)
                  <i class="fas fa-battery-full fa-lg" data-toggle="tooltip"
                      title="Cilindro O2"
                      style="color: rgb(252, 252, 252); transform: rotate(-90deg)"></i>
              @break

              @default
                  <i class="fas fa-plus-circle" data-toggle="tooltip" title="nenhum"></i>
          @endswitch
           nº: {{$solicitSel->id}}
           
      </h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    
@foreach ($solicitAtual as $atual)
  {{$atual->name_pct}}
  {{$atual->cliente}}

  <div class="card-body">
    <i class="fas fa-map-marker-alt"></i>:
    {{ $atual->rua }} - nº {{ $atual->nr }}<br>
    {{ $atual->compl }} - {{ $atual->bairro }}<br>
    <hr>
    <i class="fas fa-procedures"></i>:

    <div>
        @foreach (explode(',', $atual->equips_solicit) as $itemEquip) {{-- Separa os itens por vírgula e joga numa lista --}}
            <div class="form-group">

                    <li style="line-height: 40%">{{$itemEquip}}</li>

                {{-- <div>
                    <i class="fas fa-plus"></i>
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" aria-hidden="true" required>]
                                <option value="" selected>Selecione</option>
                            @foreach ($equips as $equip)
                                <option value = "{{$equip->id}}">{{$equip->patr}} - {{$equip->name_equip}}</option>
                                @endforeach
                        </select>

                </div> --}}
                    {{-- <hr> --}}
            </div>
        @endforeach
            <!-- /.form-group -->
    </div>

        Obs: {{ $atual->obs_solicit }}
        <hr>
    <form action="{{route('iniciar_solicit', $atual->id)}}" method="post">
        @csrf
        <div class="form-group">
            @if($atual->status_solicit == 0)
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        <a >
                            <button class="btn btn-app swalDefaultSuccess" name="submitbutton" value="1" type="submit" style="color: green">
                                <i class="fas fa-play"></i> Iniciar
                            </button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab_cancelar" >
                            <button class="btn btn-app "  style="color: red">
                                <i class="fas fa-window-close"></i> Cancelar
                            </button>
                        </a>
                    </li>
                </ul>

            @else
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        <a data-toggle="modal" data-target="#modalFinalizar" >
                            <button class="btn btn-app"  style="color: green">
                                <i class="far fa-check-square"></i> Modal
                            </button>
                        </a>
                    </li>
                            <!-- Modal -->
                            <div class="modal fade" id="modalFinalizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Finalizar Solicitação</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    Aqui puxa todas as linhas lançadas na tabela itens do paciente.
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab_finalizar" >
                            <button class="btn btn-app"  style="color: green">
                                <i class="far fa-check-square"></i> Finalizar
                            </button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#tab_cancelar" >
                            <button class="btn btn-app "  style="color: red">
                                <i class="fas fa-window-close"></i> Cancelar
                            </button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab_retornar" data-toggle="tab">
                            <button class="btn btn-app " name="submitbutton" value="0" type="submit" style="color: rgb(0, 0, 0)">
                                <i class="fas fa-undo"></i> Retornar
                            </button>
                        </a>
                    </li>
                </ul>

            @endif

            <input type="number" name="status" id="status" value="{{$atual->status_solicit}}" style="display: none">
        </div>
        {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
        <div class="card">
           
            <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_none">

                </div>
                <div class="tab-pane" id="tab_finalizar">
                    Formulario com os equipamentos para incluir no cadastro do paciente.

                    <button class="btn btn-app bg-success btn-block swalDefaultFinalized" name="submitbutton" value="2" type="submit" style="color: green">
                        <i class="far fa-check-square"></i> Finalizar
                    </button>
                    </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_cancelar">
                    Aponta o motivo do cancelamento da Solicitação.
                    <button class="btn btn-app bg-danger btn-block swalDefaultError" name="submitbutton" value="3" type="submit" style="color: red">
                        <i class="fas fa-window-close"></i> Cancelar
                    </button>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane " id="tab_retornar">
                   <p style="text-align: center">
                       Retorna a solicitação para a lista de solicitações pendentes.
                    </p>
                    <button class="btn btn-app bg-secondary btn-block swalDefaultInfo" name="submitbutton" value="0" type="submit" style="color: red">
                        <i class="fas fa-undo"></i> Retornar
                    </button>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>



    </form>

</div>
@endforeach
    
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

{{-- <script>
      console.log($solicitAtual);
</script> --}}

@stop

</body>

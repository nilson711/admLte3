@extends('adminlte::page')

@section('title', 'Editar Pct')

@section('content_header')

@stop

@section('content')

<body>

<div class="col-md-12">
  <div class="row">
    <div class="col-sm-6">
      {{-- <p>Detalhes da Solicitação</p> --}}
    </div>

  </div>

  @foreach ($solicitAtual as $atual)
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
           nº: {{$solicitSel->id}} ({{$atual->cliente}})

           @if ($atual->status_solicit == 1)
              <i class="fas fa-ambulance" id="ambulancia" style="display: inline; color: yellow" data-toggle="tooltip" title={{$atual->user_atend}}></i><br>
           @else
              <i class="fas fa-ambulance" id="ambulancia" style="display: none"></i><br>
            @endif

        </h3>

          <div class="card-tools float-right" >
            <button type="button" class="btn btn-block btn-danger btn-sm">
              <a href="{{route('solicitacoes')}}">
                <i class="fas fa-times" ></i>
              </a>
            </button>
          </div>
    </div>
    <!-- /.card-header -->
    <!-- form start -->



  <div class="card-body">
    <label>
      PCT: {{$atual->name_pct}}
      PCT: {{$atual->id}}

    </label>  <br>
    <i class="fas fa-map-marker-alt"></i>
     {{ $atual->rua }} - nº {{ $atual->nr }}<br>
    {{ $atual->compl }} - {{ $atual->bairro }}<br>
    <i class="fas fa-hand-point-right"></i>
     {{ $atual->obs_solicit }}
    <hr>
    <i class="fas fa-procedures"></i>

    <div class="row">
        <div class="col-md-12">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title"></h3>
            </div>
            <div class="card-body p-0">
              <div >
                
                <div>
                  <!-- your steps content here -->
                  <div id="select-equips" class="content active" role="tabpanel" aria-labelledby="select-equips-trigger">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Solicitados</label>
                      <div> 
                        @foreach (explode(',', $atual->equips_solicit) as $itemEquip) {{-- Separa os itens por vírgula e joga numa lista --}}
                            <div class="form-group">
                              <div>
                                  <li class="li_itens" >{{$itemEquip}}</li>
                                    {{-- <i class="fas fa-plus"></i> --}}
                                    <form action="{{route('add_equip_pct')}}" method="post">
                                      @csrf
                                        <input type="text" name="solicitForEquip" value="{{$solicitSel->id}}" style="display: none">
                                          @if ($equipsSel == null) 
                                              @if ($atual->status_solicit == 0)
                                                  <div class="input-group input-group-sm">
                                                      <select name="selectEquip" class="selectEquip form-control select2 select2-hidden-accessible" onchange="coletaProdutoSelecionado()" on  style="width: 100%;" aria-hidden="true">]
                                                        <option value="" selected>Selecione</option>
                                                          @foreach ($equips as $equip)
                                                            <option value = "{{$equip->id}}">{{$equip->patr}} - {{$equip->name_equip}}</option>
                                                          @endforeach
                                                      </select>
                                                  </div>
                                              @endif
                                              <hr>
                                          @endif
                                            <input type="text" name="pctForEquip" value="{{$atual->id}}" style="display: none">
                                        <div id="equipSelecionados" style="display: none"></div>
                                      <input type="text" name="enviarEquip" id="enviarEquip" style="display: none">
                                     
                                                    <!-- Modal Conferir -->
                                                    
                                                    <div class="modal fade" id="modalConferir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Equipamentos selecionados</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                          </div>
                                                          <div class="modal-body">
                                                              <h5 id="txtAvisoQtd" style="color: red; display:none">
                                                              Atenção!<br>
                                                              Ainda faltam equipamentos para selecionar.
                                                              </h5>
                                                              <h5>Deseja continuar?</h5>
                                                          <label for="obs_atend">Observações:</label><br>
                                                          <textarea name="obs_atend" id="obs_atend" cols="38" rows="4"></textarea>
                                                          </div>
                                                          <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                          <button class="btn btn-primary swalDefaultAddEquip" name="submitbutton" value="2" type="submit">Confirmar</button>
                                                          </div>
                                                      </div>
                                                      </div>
                                                    </div>
                                    </form>
                                </div>
                            </div>
                          @endforeach


                    <form action="{{route('iniciar_solicit', $atual->SolicitId)}}" method="post" enctype="multipart/form-data">
                            @csrf
                                @if ($equipsSel != null)
                                    <label for="">Selecionados</label><br>
                                    @foreach ($equipsSel as $itemSel)
                                        <li style="color: blue">{{$itemSel->patr}} - {{$itemSel->name_equip}}</li>
                                    @endforeach  

                                    <ul class="nav nav-pills ml-auto p-2">
                                      @if ($atual->status_solicit == 0)
                                        <li class="nav-item">
                                            <a id="btnIniciar" >
                                                <button class="btn btn-app swalDefaultSuccess" onclick="txtCancelNoRequired()" name="submitbutton" value="1" type="submit" style="color: green; visibility: visible">
                                                    <i class="fas fa-play"></i> OK
                                                </button>
                                            </a>
                                        </li>
                                      @endif

                                      @if ($atual->status_solicit == 1)
                                        <li class="nav-item">
                                            <a id="linkBtnFinalizar" data-toggle="modal" data-target='#modalFinalizar' onclick="coletaProdutoSelecionado()">
                                                <button id="btnFinalizar" class="btn btn-app"  style="color: green" >
                                                    <i class="far fa-check-square"></i> Finalizar
                                                </button>
                                            </a>
                                            
                                          </li>
                                          <li class="nav-item">
                                            <a data-toggle="modal" data-target="#modalCancelar" >
                                                <button class="btn btn-app"  style="color: red" onclick="txtCancelRequired()">
                                                    <i class="fas fa-window-close"></i> Cancelar
                                                </button>
                                            </a>
                    
                                          </li>
                                          <li class="nav-item">
                                            <a >
                                                <button class="btn btn-app swalDefaultInfo" name="submitbutton" value="0" type="submit" style="color: rgb(0, 0, 0)">
                                                    <i class="fas fa-undo"></i> Retornar
                                                </button>
                                            </a>
                                          </li>
                                          @endif
                                        
                                        
                                </ul>
                                  

                                @endif
                                  @if ($equipsSel == null)
                                        <a id="btnConferido" style="visibility: visible" >
                                            <button class="btn btn-app" type="button" data-toggle="modal" data-target='#modalConferir' style="color: green">
                                            {{-- <button class="btn btn-app" type="submit" style="color: green" name="submitbutton" value="2">   --}}
                                              <i class="fas fa-check"></i>Confirma
                                          </button>
                                        </a>
                                  @else
                                    
                              @endif
                          
                          </a>
                        </div>
                      </div>
                    </div> 
                    {{-- FINAL DO STEP --}}
                    
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                rodapé do steps
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        
        
        
        
        
      <div class="form-group">

            <!-- Modal Concluir -->
            <div class="modal fade" id="modalFinalizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Concluir Solicitação</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <div class="modal-body">
                    <h5 id="txtAvisoQtd" style="color: red; display:none">Atenção - A quantidade de ítens solicitada é diferente da quantidade de itens implantados!</h5>
                   <h5>Deseja concluir esta solicitação?</h5> <br>
                   
                      <div class="form-group">
                        <label for="exampleFormControlFile1">Anexar Guia:</label>
                        <input type="file" class="form-control-file" name="guia" id="guia">
                      </div>
                    
                    <label for="obs_atend">Observações:</label><br>
                    <textarea name="obs_atend" id="obs_atend" cols="38" rows="4"></textarea>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button class="btn btn-primary swalDefaultFinalized" name="submitbutton" value="2" type="submit">Confirmar</button>
                  </div>
              </div>
              </div>
            </div>
            <!-- Modal Sem quipamento -->
            <div class="modal fade" id="modalSemEquip" tabindex="-1" role="dialog" aria-labelledby="modalSemEquip" aria-hidden="true">
              <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="modalSemEquip">Sem Equipamentos</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <div class="modal-body">

                  Não existe equipamentos Selecionados!
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  {{-- <button type="button" class="btn btn-primary swalDefaultFinalized" name="submitbutton" value="2" type="submit">Confirmar</button> --}}
                  </div>
              </div>
              </div>
            </div>
            <!-- Modal Cancelar-->
            <div class="modal fade" id="modalCancelar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Deseja Cancelar a Solicitação?</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <div class="modal-body">
                    <p>Qual o motivo do cancelamento?</p>
                  <textarea name="txtCancel" id="txtCancel" rows="5" style="width:100%" placeholder="Digite o motivo do cancelamento."></textarea>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary swalDefaultCancel" name="submitbutton" value="3" type="submit">Confirmar</button>
                  </div>
              </div>
              </div>
            </div>
            <input type="number" name="status" id="status" value="{{$atual->status_solicit}}" style="display: none">
        </div>
        {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

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
    {{-- <link rel="stylesheet" href="{{asset('css/bs-stepper.min.css')}}"> --}}


    <!-- Toastr -->
    <link rel="stylesheet" href= {{asset('css/toastr.min.css')}}>
     <!-- SweetAlert2 -->
    <link rel="stylesheet" href= {{asset('css/bootstrap-4.min.css')}}>

    <!-- Select2 -->
<link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/select2-bootstrap4.min.css')}}">

<!-- DataTables -->
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('css/buttons.bootstrap4.min.css')}}">

@stop

@section('js')

<script src= {{asset('js/sweetalert2.min.js')}}></script>
<script src= {{asset('js/toastr.min.js')}}></script>
{{-- <script src= {{asset('js/bs-stepper.min.js')}}></script> --}}

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
<!-- jQuery -->
{{-- <script src= {{asset('js/jquery.min.js')}}></script> --}}

<!-- Select2 -->
<script src= {{asset('js/select2.full.min.js')}}></script>

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
<script src= {{asset('js/functions-equips.js')}} defer></script>


<script>
    // BS-Stepper Init
  // document.addEventListener('DOMContentLoaded', function () {
  //   window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  // })
</script>


{{-- <script>
    $(document).ready(function () {
  var stepper = new Stepper($('.bs-stepper')[0])
})

</script> --}}
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
      toast: false,
      position: 'center',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Solicitação iniciada com sucesso!'
      })
    });
    $('.swalDefaultFinalized').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Solicitação Finalizada!'
      })
    });
    $('.swalDefaultAddEquip').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Equipamentos selecionados com sucesso!'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        icon: 'info',
        title: 'Solicitação retornada!'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        icon: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultCancel').click(function() {
      Toast.fire({
        icon: 'error',
        title: 'Solicitação Cancelada!'
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

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

  //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
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
{{-- <script>
      console.log($solicitAtual);
</script> --}}

{{-- SOMA A QUANTIDADE DE ITENS NA TAG LI --}}
<script type="text/javascript">
  $(document).ready(function(){
    //AQUI ACONTECE A CONTAGEM
      // alert($(".li_itens").length)
    // document.getElementById('totItens').value = ($(".li_itens").length);
  });

</script>

@stop

</body>

@extends('adminlte::page')

@section('title', 'Solicitações')

@section('content_header')
    <h1>Solicitações</h1>
@stop

@section('content')
{{-- <p>Painel de Informações</p> --}}

<div class="row">

    <div class="col-md-12">

        @foreach ($solicitacoes as $solicitacao )
            @if ($solicitacao->priority == 1)
                <div class="card card-danger collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            @switch($solicitacao->type_solicit)
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

                            &nbsp Nº: {{$solicitacao->id}} ({{ $solicitacao->cliente }})&nbsp
                                @if ($solicitacao->status_solicit == 0)
                                    <i class="fas fa-ambulance" id="ambulancia" style="display: none"></i><br>
                                @else
                                    <i class="fas fa-ambulance" id="ambulancia" data-toggle="tooltip" title="Em atendimento" style="display: inline; color:yellow"></i><br>
                                @endif
                            <strong>{{ $solicitacao->name_pct }}</strong><br>
                            {{ $solicitacao->bairro }}
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                            </button>
                        </div>

                    </div>
                    <div class="card-body">
                        <i class="fas fa-map-marker-alt"></i>:
                        {{ $solicitacao->rua }} - nº {{ $solicitacao->nr }}<br>
                        {{ $solicitacao->compl }} - {{ $solicitacao->bairro }}<br>
                        <hr>
                        <i class="fas fa-procedures"></i>: {{ $solicitacao->equips_solicit }}<br>
                            Obs: {{ $solicitacao->obs_solicit }}
                            <hr>
                        <form action="{{route('iniciar_solicit', $solicitacao->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                @if($solicitacao->status_solicit == 0)
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

                                <input type="number" name="status" id="status" value="{{$solicitacao->status_solicit}}" style="display: none">
                            </div>
                            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                            <div class="card">
                                {{-- <div class="card-header d-flex p-0">
                                <ul class="nav nav-pills ml-auto p-2">
                                    <li class="nav-item"><a class="nav-link" href="#tab_finalizar" data-toggle="tab">Finalizar</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_cancelar" data-toggle="tab">Cancelar</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_retornar" data-toggle="tab">Retornar</a></li>
                                    <li class="nav-item dropdown"> 
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                                        Opções <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" tabindex="-1" href="#tab_iniciar" data-toggle="tab">Iniciar</a>
                                        <a class="dropdown-item" tabindex="-1" href="#tab_finalizar" data-toggle="tab">Finalizar</a>
                                        <a class="dropdown-item" tabindex="-1" href="#tab_cancelar" data-toggle="tab">Cancelar</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" tabindex="-1" href="#tab_retornar" data-toggle="tab">Retornar</a>
                                    </div>
                                </li>
                                </ul>
                                </div> --}}
                                <!-- /.card-header -->
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

                    <!-- /.card-body -->
                </div>
            @else
                <div class="card card-primary collapsed-card">
                    <div class="card-header">
                    <h3 class="card-title">
                        @if ($solicitacao->priority == 1)
                            <i class="fas fa-exclamation" data-toggle="tooltip" title="Prioridade" style="color: red"></i>
                        @endif
                        @switch($solicitacao->type_solicit)
                            @case(1)
                                <i class="fas fa-plus-circle fa-lg" data-toggle="tooltip"
                                    title="Implantação"
                                    style="color: rgb(255, 255, 255)"></i>
                            @break
                            @case(2)
                                <i class="fas fa-minus-circle fa-lg" data-toggle="tooltip"
                                    title="Recolhimento"
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
                        &nbsp Nº: {{$solicitacao->id}} ({{ $solicitacao->cliente }})&nbsp
                                @if ($solicitacao->status_solicit ==0)
                                    <i class="fas fa-ambulance" id="ambulancia" style="display: none"></i><br>
                                @else
                                    <i class="fas fa-ambulance" id="ambulancia" style="display: inline"></i><br>
                                @endif
                            <strong>{{ $solicitacao->name_pct }}</strong><br>
                            {{ $solicitacao->bairro }}
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                    </div>
                    <div class="card-body">
                        <i class="fas fa-map-marker-alt"></i>:
                        {{ $solicitacao->rua }} - nº {{ $solicitacao->nr }}<br>
                        {{ $solicitacao->compl }} - {{ $solicitacao->bairro }}<br>
                        <hr>
                        <i class="fas fa-procedures"></i>: {{ $solicitacao->equips_solicit }}<br>
                            Obs:{{ $solicitacao->obs_solicit }}
                            <hr>
                            <a class="btn btn-app">
                                <i class="fas fa-play"></i> Iniciar
                            </a>
                            <a class="btn btn-app">
                                <i class="far fa-check-square"></i> Finalizar
                            </a>
                            <a class="btn btn-app">
                                <i class="fas fa-window-close"></i> Cancelar
                            </a>
                    </div>
                    <!-- /.card-body -->
                </div>
            @endif
        @endforeach
    </div>

@stop

@section('css')
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
{{-- <script src= {{asset('css/bootstrap-4.min.css')}}></script> --}}
{{-- <script src= {{asset('css/toastr.css')}}></script> --}}
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('css/bootstrap-4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('css/toastr.css')}}">

 

@stop

@section('js')

<script src= {{asset('js/functions-equips.js')}}></script>
{{-- <script src= {{asset('js/jquery.min.js')}}></script> --}}
<script src= {{asset('js/toastr.min.js')}}></script>
<script src= {{asset('js/sweetalert2.min.js')}}></script>



<script>
    console.log('Hi!');
</script>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<script>
    // var dateStr = document.getElementById('data_solicit').split('-');
    // var dataBr = dateStr.val(dateStr[2]) + '/'
    // dateStr[1] + '/' + dateStr[0]);

    // console.log(dataBr);
</script>

<script>
function iniciarAtendimento() {
  var txt;
  var r = confirm("Deseja iniciar esta solicitação?");
  if (r == true) {
    txt = "You pressed OK!";
    document.getElementById("ambulancia").style="display: inline";
    visibility = "visible"
    // style.display = "block"

  } else {
    txt = "You pressed Cancel!";
  }
//   document.getElementById("demo").innerHTML = txt;
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
      $('.swalDefaultInfo').click(function() {
        Toast.fire({
          icon: 'info',
          title: 'Solicitação retornada!'
        })
      });
      $('.swalDefaultError').click(function() {
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
@stop

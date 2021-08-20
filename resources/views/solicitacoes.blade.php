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
                    Obs: {{ $solicitacao->obs_solicit }}
                    <hr>
                <form action="{{route('iniciar_solicit', $solicitacao->id)}}" method="post">
                    @csrf
                    <div class="form-group">

                        <button class="btn btn-app" type="submit">
                            <i class="fas fa-play"></i> Iniciar
                        </button>
                        {{-- <a href="#" class="btn btn-app" type="submit" >
                            <i class="fas fa-play"></i> Iniciar
                        </a> --}}
                        <input type="number" name="status" id="status" value="{{$solicitacao->status_solicit}}" style="display: none">
                </form>

                        <a class="btn btn-app">
                            <i class="far fa-check-square"></i> Finalizar
                        </a>
                        <a class="btn btn-app">
                            <i class="fas fa-window-close"></i> Cancelar
                        </a>

                    </div>

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
@stop

@section('js')

<script src= {{asset('js/functions-equips.js')}}></script>

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

@stop

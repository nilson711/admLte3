@extends('adminlte::page')

@section('title', 'Solicitações')

{{-- @section('content_header')
    <h1>Dashboard</h1>
@stop --}}

@section('content')
{{-- <p>Painel de Informações</p> --}}

<div class="row">

    <div class="col-md-12">

        @foreach ($solicitacoes as $solicitacao )
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Nº: {{$solicitacao->id}} ({{ $solicitacao->cliente }}) </h3>
                </div>
                <div class="card-body">
                    <strong>{{ $solicitacao->name_pct }}</strong><br>
                    {{ $solicitacao->rua }} - nº {{ $solicitacao->nr }}<br>
                    {{ $solicitacao->compl }} - {{ $solicitacao->bairro }}<br>
                    <hr>
                    <i class="fas fa-procedures"></i>: {{ $solicitacao->equips_solicit }}
                        Obs:{{ $solicitacao->obs_solicit }}
                    </div>
                <!-- /.card-body -->
            </div>
        @endforeach
    </div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<script>
    var dateStr = document.getElementById('data_solicit').split('-');
    var dataBr = dateStr.val(dateStr[2]) + '/'
    dateStr[1] + '/' + dateStr[0]);

    console.log(dataBr);
</script>

@stop

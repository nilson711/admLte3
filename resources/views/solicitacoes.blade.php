@extends('adminlte::page')

@section('title', 'Solicitações')

{{-- @section('content_header')
    <h1>Dashboard</h1>
@stop --}}

@section('content')
    {{-- <p>Painel de Informações</p> --}}

  <div class="row">

    <div class="col-md-12">

      <div class="card">
      <div class="card-header">
        <h3 class="card-title" data-toggle="tootip" title="teste">Solicitações</h3>

      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table table-sm">
          <thead>
            <tr>
              <th class="col-sm-1" style="text-align: center">#</th>
              {{-- <th>Data</th> --}}
              <th>Paciente</th>
              <th>Home Care</th>
              <th>Tipo</th>

            </tr>
          </thead>
          <tbody>
              @foreach ($solicitacoes as $solicitacao )
                {{-- @php
                    echo '<pre>';
                        print_r($solicitacao);
                @endphp --}}
              <tr>
                <td style="text-align: center" rowspan="2" >
                    @if ($solicitacao->priority==1)
                        {{-- <i class="fas fa-exclamation-triangle" data-toggle="tooltip" title="Urgente" style="color: rgb(250, 10, 10); background-color: yellow">{{$solicitacao->id}}</i> --}}
                        <div data-toggle="tooltip" title="Urgente" style="color: rgb(250, 10, 10); background-color: yellow">
                            <strong>
                                {{$solicitacao->id}} <br>
                                {{\Carbon\Carbon::parse($solicitacao->date_solicit)->format('d/m - H:i')}}
                            </strong>
                        </div>
                    @else
                        {{$solicitacao->id}} <br>
                        {{\Carbon\Carbon::parse($solicitacao->date_solicit)->format('d/m - H:i')}}
                    @endif
                </td>

                  {{-- <td id="data_solicit">{{\Carbon\Carbon::parse($solicitacao->date_solicit)->format('d/m - H:i')}}</td> --}}
                  <td>{{$solicitacao->name_pct}} <br>
                    {{$solicitacao->rua}} - nº {{$solicitacao->nr}} {{$solicitacao->compl}} - {{$solicitacao->bairro}} <br>
                    Equipamentos: {{$solicitacao->equips_solicit}} - {{$solicitacao->obs_solicit}}

                </td>
                  <td>{{$solicitacao->cliente}}</td>
                  <td>
                      @switch($solicitacao->type_solicit)
                        @case(1)
                            <i class="fas fa-plus-circle" data-toggle="tooltip" title="Implantação" style="color: rgb(20, 187, 20)"></i>
                        @break
                        @case(2)
                            <i class="fas fa-minus-circle" data-toggle="tooltip" title="Recolhimento" style="color: black"></i>
                        @break
                        @case(3)
                            <i class="fas fa-tools" data-toggle="tooltip" title="Troca/Manutenção" style="color: orange"></i>
                        @break
                        @case(4)
                            <i class="fas fa-dolly" data-toggle="tooltip" title="Mudança"></i>
                        @break
                        @case(5)
                            <i class="fas fa-times-circle" data-toggle="tooltip" title="Recolhimento Total" style="color: red"></i>
                            @break
                        @case(6)
                            <i class="fas fa-battery-full" data-toggle="tooltip" title="Cilindro O2" style="color: rgb(149, 223, 240); transform: rotate(-90deg)"></i>

                            {{-- <i class="fas fa-lungs" data-toggle="tooltip" title="Cilindro O2" style="color: rgb(58, 203, 240)"></i> --}}

                            {{-- <img src="oxygen-tank.png" alt="O2" width="30"> --}}
                        @break

                        @default
                            <i class="fas fa-plus-circle" data-toggle="tooltip" title="nenhum"></i>
                      @endswitch

                    </td>
                    <tr>
                        <td colspan="4" style="border: none">
                            
                        </td>
                    </tr>
                </tr>
                @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>

    <script>
        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
      </script>

<script>

var dateStr = document.getElementById('data_solicit').split('-');
var dataBr = dateStr.val(dateStr[2])+'/'dateStr[1]+'/'+dateStr[0]);

console.log(dataBr);

</script>

@stop

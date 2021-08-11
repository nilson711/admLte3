@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Painel de Informações</p>

  <div class="row">

    <div class="col-md-6">

      <div class="card">
      <div class="card-header">
        <h3 class="card-title" data-toggle="tootip" title="teste">Solicitações</h3>

      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Paciente</th>
              <th>Home Care</th>
              <th>Tipo</th>
              <th>Info</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($solicitacoes as $solicitacao )
                {{-- @php
                    echo '<pre>';
                        print_r($solicitacao);
                @endphp --}}
              <tr>
                  <td>{{$solicitacao->id}}</td>
                  <td>{{$solicitacao->name_pct}}</td>
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
                  <td>
                      <button type="button" class="btn btn-outline-info btn-sm" title="Informações da Solicitação" data-toggle="modal" data-target="#ModalInfoSolicitacao"><i class="fas fa-info-circle"></i></button>
                      <!-- Modal -->
                      <div class="modal fade" id="ModalInfoSolicitacao" tabindex="-1" role="dialog" aria-labelledby="ModalInfoSolicitacaoLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="ModalInfoSolicitacaoLabel"># {{$solicitacao->id}} - {{$solicitacao->name_pct}} - {{$solicitacao->cliente}}</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            {{-- <tr>
              <td>2</td>
              <td>Raimundo Felix da Silva</td>
              <td>Indoor</td>
              <td><i class="fas fa-minus-circle" title="Recolhimento"></i></td>
              <td><button type="button" class="btn btn-outline-info btn-sm" title="Informações da Solicitação" data-toggle="modal" data-target="#ModalInfoSolicitacao"><i class="fas fa-info-circle"></i></button></td> --}}

            {{-- </tr> --}}
            {{-- <tr>
              <td>3</td>
              <td>Julio dos Santos</td>
              <td>Catedral</td>
              <td><i class="fas fa-times-circle" title="Recolhimento Total"></i></td>
              <td><button type="button" class="btn btn-outline-info btn-sm" title="Informações da Solicitação" data-toggle="modal" data-target="#ModalInfoSolicitacao"><i class="fas fa-info-circle"></i></button></td>

            </tr> --}}
            {{-- <tr>
              <td>4</td>
              <td>Manoel da Silva</td>
              <td>SOS Vida</td>
              <td><i class="fas fa-tools" title="Troca/Manutenção"></i></i></td>
              <td><button type="button" class="btn btn-outline-info btn-sm" title="Informações da Solicitação" data-toggle="modal" data-target="#ModalInfoSolicitacao"><i class="fas fa-info-circle"></i></button></td>

            </tr>
            <tr>
              <td>5</td>
              <td>José Costa Pereira</td>
              <td>Mederi</td>
              <td><i class="fas fa-dolly" title="Mudança de Local"></i></td>
              <td><button type="button" class="btn btn-outline-info btn-sm" title="Informações da Solicitação" data-toggle="modal" data-target="#ModalInfoSolicitacao"><i class="fas fa-info-circle"></i></button></td>

            </tr> --}}
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      </div>
    </div>

    {{-- LISTA DE TAREFAS --}}
    <section class="col-lg-6 connectedSortable ui-sortable">
      <!-- Custom tabs (Charts with tabs)-->
      <div class="card" style="position: relative; left: 0px; top: 0px;">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
          <h3 class="card-title">
            <i class="ion ion-clipboard mr-1"></i>
            Tarefas
          </h3>

          <div class="card-tools">
            <ul class="pagination pagination-sm">
              <li class="page-item"><a href="#" class="page-link">«</a></li>
              <li class="page-item"><a href="#" class="page-link">1</a></li>
              <li class="page-item"><a href="#" class="page-link">2</a></li>
              <li class="page-item"><a href="#" class="page-link">3</a></li>
              <li class="page-item"><a href="#" class="page-link">»</a></li>
            </ul>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{route('checkTarefa')}}" method="post">
          <ul class="todo-list ui-sortable" data-widget="todo-list">

            @foreach ($tasks as $task)

              <li class="" style="">
                <!-- drag handle -->
                <span class="handle ui-sortable-handle">
                </span>
                <!-- checkbox -->

                <div class="icheck-primary d-inline ml-2">
                    <label for="checkTarefa"></label>
                    <input type="checkbox" value="0" name="checkTarefa" id="checkTarefa">

                </div>
                <!-- todo text -->
                <span class="text">{{$task->tarefa}}</span>
                <!-- Emphasis label -->
                {{-- <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small> --}}
                <!-- General tools such as edit or delete-->
                <div class="tools">
                  <i class="fas fa-edit"></i>
                  <i class="fas fa-trash-o"></i>
                </div>
              </li>
            @endforeach


          </ul>
          @if (count($tasks) === 0)
           <p>Não existem tarefas</p>
          @else
              <small>{{count($tasks)}} Tarefa(s)</small>
          @endif
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">

            <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#ModalAddTarefa"><i class="fas fa-plus"></i> Nova Tarefa</button>


          <!-- Modal -->
          <div class="modal fade" id="ModalAddTarefa" tabindex="-1" role="dialog" aria-labelledby="ModalAddTarefa" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalAddTarefa">Adicionar Nova Tarefa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{route('new_task_submit')}}" method="post">
                  <div class="modal-body">
                    @csrf
                      <div class="row">
                        <label for="tarefa">Tarefa</label>
                        <input type="text" class="form-control" name="tarefa" id="tarefa" placeholder="Digite aqui" maxlength="50">
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
      </div>
    </div>



      <!-- TO DO List -->

      <!-- /.card -->
    </section>
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
@stop

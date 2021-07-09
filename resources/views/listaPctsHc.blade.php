@extends('adminlte::page')

@section('title', 'Lista Pcts')

@section('content_header')

@stop

@section('content')


<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{$clienteSel->cliente}} - Lista de Pacientes</h3>
        </div>
        <!-- ./card-header -->
        <div class="card-body">
        <table id="example1" class="table table-sm  table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Paciente</th>
                <th>Admissão</th>
                <th>Status</th>
                <th>Endereço</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ( $allPcts as $Pct)
                    @if ($Pct->id_hc == $clienteSel->id)
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>{{$Pct->id}}</td>
                            <td>{{$Pct->name_pct}}</td>
                            <td>{{$Pct->created_at}}</td>
                            <td>Approved</td>
                            <td>{{$Pct->bairro}}</td>
                            <td><span data-toggle="tooltip" title="Editar">
                                <a href="#" id="btnEditar" ><i class="fas fa-edit"></i></a>
                            </span>
                            </td>
                        </tr>
                        <tr class="expandable-body">
                            <td colspan="6">
                                <p>
                                    @foreach ($equipsDoPct as $equipDoPct )
                                    @if ($equipDoPct->pct_equip == $Pct->id)
                                    <li>{{$equipDoPct->patr}} - {{$equipDoPct->name_equip}}</li>
                                    @endif
                                    @endforeach
                                </p>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
          </table>
        </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row -->

@stop

@section('css')


@stop


@section('js')

@stop

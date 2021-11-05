@extends('adminlte::page')

@section('title', 'RequestCare')

@section('content_header')
    <h1>Dashboard MH</h1>
@stop

@section('content')
   <div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{count($solicitacoes)}}</h3>

              <p>Solicitações</p>
            </div>
            <div class="icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <a href="/solicitacoes" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{count($equips)}}<sup style="font-size: 20px"></sup></h3>
              <p>Equipamentos</p>
            </div>
            <div class="icon">
                <i class="fas fa-stethoscope"></i>
            </div>
            <a href="{{route('listaEquips')}}" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{count($allPcts)}}</h3>
              <p>Pacientes</p>
            </div>
            <div class="icon">
                <i class="fas fa-procedures"></i>
            </div>
            <a href="{{route('listaPcs')}}" class="small-box-footer">Lista prontuários <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{count($hc)}}</h3>
              <p>Home Cares</p>
            </div>
            <div class="icon">
                <i class="fas fa-hospital-user"></i>
            </div>
            <a href="{{route('clientes')}}" class="small-box-footer">Lista clientes <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
   </div>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>

    <script>
        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
      </script>
@stop

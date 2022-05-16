@extends('adminlte::page')

@section('title', 'RequestCare')

@section('content_header')
    <h1>Dashboard MH</h1>
    Olá {{$nameUser}}, Seja Bem Vindo!
@stop

@section('content')
   <div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
            <a href="/solicitacoes">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{count($solicitacoes)}}</h3>

                        <p>Solicitações</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="small-box-footer">
                        Acessar <i class="fas fa-arrow-circle-right"></i>
                    </div>
                </div>
            </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
            <a href="{{route('listaEquips')}}">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{count($equips)}}<sup style="font-size: 20px"></sup></h3>
                        <p>Equipamentos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <div class="small-box-footer">
                        Estoque <i class="fas fa-arrow-circle-right"></i>
                    </div>
                </div>
            </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
            <a href="{{route('listaPcs')}}">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{count($allPcts)}}</h3>
                        <p>Pacientes</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-procedures"></i>
                    </div>
                    <div class="small-box-footer">
                        Prontuários <i class="fas fa-arrow-circle-right"></i>
                    </div>
                </div>
            </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
            <a href="{{route('clientes')}}">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{count($hc)}}</h3>
                        <p>Home Cares</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-hospital-user"></i>
                    </div>
                    <div class="small-box-footer">
                        Clientes <i class="fas fa-arrow-circle-right"></i>
                    </div>
                </div>
            </a>
            
            {{-- <a href="https://api.whatsapp.com/send?phone=MH Suprimentos&text=Testando um texto" target="_blanck">Enviar mensagem</a> --}}

            

        </div>
        <!-- ./col -->
      </div>
   </div>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <script src= {{asset('js/jquery.min.js')}}></script>
    <link rel="stylesheet" href={{asset('css/css')}}>
    <link rel="stylesheet" href={{asset('css/all.min.css')}}>
    <link rel="stylesheet" href={{asset('css/adminlte.min.css')}}>
   
 
@stop

@section('js')
    <script> console.log('Hi!'); </script>

    <script defer="" referrerpolicy="origin" src={{('js/s.js')}}></script>
   

    <script>
        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
      </script>

<script src= {{asset('js/jquery.min.js')}}></script>
<script src= {{asset('js/Chart.min.js')}}></script>
<script src= {{asset('js/Chart.min.js')}}></script>
      
      
      
    {{-- <script src="./AdminLTE 3 _ ChartJS_files/bootstrap.bundle.min.js"></script>

    <script src="./AdminLTE 3 _ ChartJS_files/Chart.min.js"></script>

    <script src="./AdminLTE 3 _ ChartJS_files/adminlte.min.js"></script>

    <script src="./AdminLTE 3 _ ChartJS_files/demo.js"></script> --}}
<script>

    $(function () {
        
    }
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
    }
    </script>
    
    @stop
    
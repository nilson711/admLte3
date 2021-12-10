
@extends('adminlte::page')

@section('title', 'Solicitações')

@section('content_header')
    <h1>Solicitações</h1>
@stop

@section('content')
{{-- <p>Painel de Informações</p> --}}

<div >

    <div>
        @foreach ($solicitacoes as $solicitacao )
        <a href="{{route('edit_solicit', $solicitacao->id)}}">

        @if ($solicitacao->priority == 0)
            <div class="col-12">
                <div class="info-box">
                  <span class="info-box-icon bg-info">
                    @switch($solicitacao->type_solicit)
                        @case(1)
                            <i class="fas fa-plus-circle fa-lg" data-toggle="tooltip"
                                title="Implantação"
                                style="color: rgb(255, 255, 255)"></i>
                        @break
                        @case(2)
                            <i class="fas fa-minus-circle fa-lg" data-toggle="tooltip"
                            title="Recolhimento -
                            @switch($solicitacao->motivo)
                                @case(1)
                                    Alta
                                @break
                                @case(2)
                                    Óbito
                                @break
                                @case(3)
                                   Sem uso
                                @break
                                @case(4)
                                    Internado
                                @break
                                @case(5)
                                    Não atende a necessidade
                                @break
                                @case(6)
                                    Troca de Home Care
                                @break
                                @case(7)
                                    Troca de Equipamento
                                @break
                                @case(8)
                                    Outro
                                @break
                            @default

                            @endswitch

                            " style="color: rgb(255, 255, 255)"></i>
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

                  </span>

                  <div class="info-box-content ">
                        <span class="info-box-number ">
                          <small>
                            Nº: {{$solicitacao->id}} ({{ $solicitacao->cliente }})
                          </small>
                            @if ($solicitacao->status_solicit == 1)
                            <div class="spinner-grow spinner-grow-sm text-warning" role="status">
                              <span class="sr-only">

                              </span>
                            </div>
                            <i class="fas fa-ambulance" id="ambulancia" data-toggle="tooltip" title={{$solicitacao->user_atend}} style="display: inline; color:rgb(255, 81, 0)"></i><br>
                            @else
                            <i class="fas fa-ambulance" id="ambulancia" style="display: none"></i><br>
                            @endif
                          </span>

                              <span class="info-box-text">
                                {{ $solicitacao->name_pct }}
                                <hr>
                              </span>
                              <p style="text-transform:lowercase">
                                  {{$solicitacao->equips_solicit}}
                              </p>

                            <small >{{ $solicitacao->bairro }}</small>
                        {{-- <i class="fas fa-map-marker-alt" data-toggle="tooltip" title="{{ $solicitacao->bairro }}"></i> --}}
                  </div>

                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->

                      <!-- Modal -->
                      <div class="modal fade" id="modalFinalizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
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
                                <div class="btn-group mr-5" role="group">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                <div class="btn-group mr-2" role="group">
                                  <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                              </div>
                          </div>
                          </div>
                      </div>
            </div>
            @else
            <div class="col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger">
                        @switch($solicitacao->type_solicit)
                                @case(1)
                                    <i class="fas fa-plus-circle fa-lg" data-toggle="tooltip"
                                        title="Implantação"
                                        style="color: rgb(255, 255, 255)"></i>
                                @break
                                @case(2)
                                    <i class="fas fa-minus-circle fa-lg" data-toggle="tooltip"
                                        title=" Recolhimento"
                                        style="color: rgb(255, 0, 0)"></i>
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
                    </span>

                  <div class="info-box-content">
                    <span class="info-box-number">
                      Nº: {{$solicitacao->id}} ({{ $solicitacao->cliente }})
                            @if ($solicitacao->status_solicit == 0)
                              <i class="fas fa-ambulance" id="ambulancia" style="display: none"></i><br>
                            @else
                              <i class="fas fa-ambulance" id="ambulancia" data-toggle="tooltip" title="Em atendimento" style="display: inline; color:rgb(255, 81, 0)"></i><br>
                            @endif
                    </span>
                    <span class="info-box-text">
                      <p>{{ $solicitacao->name_pct }}</p>
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            @endif
        @endforeach
        </a>
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

<!-- Select2 -->
<link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/select2-bootstrap4.min.css')}}">

<!-- DataTables -->
<link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="css/buttons.bootstrap4.min.css">

@stop

@section('js')

<script src= {{asset('js/functions-equips.js')}}></script>
{{-- <script src= {{asset('js/jquery.min.js')}}></script> --}}
<script src= {{asset('js/toastr.min.js')}}></script>
<script src= {{asset('js/sweetalert2.min.js')}}></script>
<!-- Select2 -->
<script src= {{asset('js/select2.full.min.js')}}></script>

<!-- DataTables  & Plugins -->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script src="js/dataTables.responsive.min.js"></script>
<script src="js/responsive.bootstrap4.min.js"></script>
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/buttons.bootstrap4.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/buttons.print.min.js"></script>
<script src="js/buttons.colVis.min.js"></script>

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


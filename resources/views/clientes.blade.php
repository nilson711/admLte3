
@extends('adminlte::page')

@section('title', 'Home Cares')

@section('content_header')
    <h1>Clientes</h1>
@stop


@section('content')

    <div class="card">
        {{-- <div class="card-header">
          <h3 class="card-title">Clientessss</h3>
        </div> --}}
        <!-- /.card-header -->
        <div class="card-body">
          <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                {{-- <div class="col-sm-8 col-md-6">
                    <div class="dt-buttons btn-group flex-wrap"></div>
                </div> --}}
                {{-- <div class="col-sm-4 col-md-4"> --}}
                    {{-- <div id="example1_filter" class="dataTables_filter"></div> --}}
                {{-- </div> --}}

                <div class="col-sm-8 col-md-6" style="margin-bottom: -30px">
                    <div class="dt-buttons btn-group flex-wrap"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">

                    <table id="example1" class="table table-sm  table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

                        <thead>
                            <tr role="row">
                                <th>#</th>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" title="Classificar crescente / decrescente">Cliente</th>
                                {{-- <th class="sorting col-sm-4" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Endereço</th> --}}
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Telefone</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Celular</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">E-mail</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <div data-toggle="modal" data-target="#ModalAddCliente">
                                <button data-toggle="tooltip" title="Adicionar novo Cliente" type="button" class="btn btn-sm btn-outline-primary float-right" ><i class="fas fa-plus"></i></button>
                            </div>

                            @foreach ($clientes as $cliente)
                            <tr class="odd" style="line-height: 100%">
                                <td>{{$cliente->id}}</td>
                                <td>{{$cliente->cliente}}</td>
                                {{-- <td>{{$cliente->endereco}}</td> --}}
                                <td>{{$cliente->telefone}}</td>
                                <td>{{$cliente->celular}}</td>
                                <td>{{$cliente->email}}</td>
                                <td>
                                    <span data-toggle="tooltip" title="Lista de Pacientes">
                                        <a href="{{route('listapcthc', $cliente->id)}}" style="margin-right: 10px"><i class="fas fa-info-circle"></i></a>
                                    </span>
                                    <span data-toggle="tooltip" title="Editar">
                                        <a href="#" id="btnEditar" ><i class="fas fa-edit"></i></a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        {{-- <tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1" style="">CSS grade</th></tr> --}}
                        </tfoot>
                    </table>

                </div>
            </div>
            <div class="card-footer clearfix">



<!------------------------------ Modal ADICIONAR NOVO CLIENTE------------------------------------>
                <div class="modal fade" id="ModalAddCliente" tabindex="-1" role="dialog" aria-labelledby="ModalAddCliente" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="ModalAddCliente">Adicionar Novo Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form action="{{route('new_cliente_submit')}}" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="row form-group">
                                <label for="cliente">Cliente:</label>
                                <input type="text" class="form-control" name="cliente" id="cliente" placeholder="Nome do Home Care" maxlength="50" required>
                            </div>
                            <div class="row form-group">
                                <label for="endereco">Endereço:</label>
                                <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Endereço" required>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <label for="tel">Telefone:</label>
                                    <input type="text" class="form-control" name="tel" id="tel"
                                    onkeypress="mascara(this, telefone)" maxlength="16" placeholder="(__) _____-____" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="celular">Celular:</label>
                                    <input type="text" class="form-control" name="celular" id="celular" onkeypress="mascara(this, telefone)" maxlength="16" placeholder="(__) _____-____" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="e-mail">E-mail:</label>
                                <input type="email" class="form-control" name="e-mail" id="e-mail" placeholder="e-mail de contato" required>
                            </div>
                            <div class="row form-group">
                                <label for="e-mail2">E-mail 2:</label>
                                <input type="email" class="form-control" name="e-mail2" id="e-mail2" placeholder="outro e-mail de contato" required>
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

        <!-- /.card-body -->
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
  function mascara(o, f) {
      v_obj = o
      v_fun = f
      setTimeout("execmascara()", 1)
  }

  function execmascara() {
      v_obj.value = v_fun(v_obj.value)
  }

  function leech(v) {
      v = v.replace(/o/gi, "0")
      v = v.replace(/i/gi, "1")
      v = v.replace(/z/gi, "2")
      v = v.replace(/e/gi, "3")
      v = v.replace(/a/gi, "4")
      v = v.replace(/s/gi, "5")
      v = v.replace(/t/gi, "7")
      return v
  }

  function soNumeros(v) {
      return v.replace(/\D/g, "")
  }

  function cep(v) {
      // v=v.replace(/D/g,"")                //Remove tudo o que não é dígito
      // v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
      v = v.replace(/^(\d{5})(\d)/, "$1-$2") //Esse é tão fácil que não merece explicações

          +
          "-"
      return v
  }

  function soNumeros(v) {
      return v.replace(/\D/g, "")
  }

  function telefone(v) {
      v = v.replace(/\D/g, "") //Remove tudo o que não é dígito
      v = v.replace(/^(\d\d)(\d)/g, "($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
      v = v.replace(/(\d)(\d{3})/, "$1 $2") //Coloca um espaço no primeiro dígito do telefone
      v = v.replace(/(\d{4})(\d)/, "$1-$2") //Coloca hífen entre o quarto e o quinto dígitos

      return v
  }

  function cpf(v) {
      v = v.replace(/\D/g, "") //Remove tudo o que não é dígito
      v = v.replace(/(\d{3})(\d)/, "$1.$2") //Coloca um ponto entre o terceiro e o quarto dígitos
      v = v.replace(/(\d{3})(\d)/, "$1.$2") //Coloca um ponto entre o terceiro e o quarto dígitos
      //de novo (para o segundo bloco de números)
      v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
      return v
  }

  function mdata(v) {
      v = v.replace(/\D/g, "");
      v = v.replace(/(\d{2})(\d)/, "$1/$2");
      v = v.replace(/(\d{2})(\d)/, "$1/$2");

      v = v.replace(/(\d{2})(\d{2})$/, "$1$2");
      return v;
  }

  function mcc(v) {
      v = v.replace(/\D/g, "");
      v = v.replace(/^(\d{4})(\d)/g, "$1 $2");
      v = v.replace(/^(\d{4})\s(\d{4})(\d)/g, "$1 $2 $3");
      v = v.replace(/^(\d{4})\s(\d{4})\s(\d{4})(\d)/g, "$1 $2 $3 $4");
      return v;
  }

  //Datemask dd/mm/yyyy
  $('#data_rent').inputmask('dd/mm/yyyy', {
      'placeholder': 'dd/mm/yyyy'
  })
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


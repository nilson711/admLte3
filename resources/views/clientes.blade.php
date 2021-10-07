@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')

@stop

@section('content')

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Clientes</h3>
        </div>
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
                                    <input type="text" class="form-control" name="celular" id="celular" onkeypress="mascara(this, celularMasc)" maxlength="16" placeholder="(__) _____-____" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="e-mail">E-mail:</label>
                                <input type="email" class="form-control" name="e-mail" id="e-mail" placeholder="e-mail de contato" required>
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

</section>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="css/admin_custom.css"> --}}
    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet" href="css/css"> --}}

    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="css/all.min.css"> --}}

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}"
    <link rel="stylesheet" href="{{asset('css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/buttons.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
    <!-- jQuery -->
<script src= {{asset('js/jquery.min.js')}}></script>
<!-- Bootstrap 4 -->
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src= {{asset('')}}></script>
<!-- DataTables  & Plugins -->
<script src= {{asset('js/jquery.dataTables.min.js')}}></script>
<script src= {{asset('js/dataTables.bootstrap4.min.js')}}></script>
<script src= {{asset('js/dataTables.responsive.min.js')}}></script>
<script src= {{asset('js/responsive.bootstrap4.min.js')}}></script>
<script src= {{asset('js/dataTables.buttons.min.js')}}></script>
<script src= {{asset('js/buttons.bootstrap4.min.js')}}></script>
<script src= {{asset('js/jszip.min.js')}}></script>
<script src= {{asset('js/pdfmake.min.js')}}></script>
<script src= {{asset('js/vfs_fonts.js')}}></script>
<script src= {{asset('js/buttons.html5.min.js')}}></script>
<script src= {{asset('js/buttons.print.min.js')}}></script>
<script src= {{asset('js/buttons.colVis.min.js')}}></script>
<script src= {{asset('js/adminlte.min.js')}}></script>
<script src= {{asset('js/demo.js')}}></script>
<script src= {{asset('js/select2.full.min.js')}}></script>
<script src= {{asset('js/jquery.bootstrap-duallistbox.min.js')}}></script>
<script src= {{asset('js/moment.min.js')}}></script>
<script src= {{asset('js/jquery.inputmask.min.js')}}></script>
<script src= {{asset('js/daterangepicker.js')}}></script>
<script src= {{asset('js/tempusdominus-bootstrap-4.min.js')}}></script>
<script src= {{asset('js/bootstrap-switch.min.js')}}></script>
<script src= {{asset('js/bs-stepper.min.js')}}></script>
<script src= {{asset('js/dropzone.min.js')}}></script>
<script src= {{asset('js/functions-equips.js')}}></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    //   ,      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

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
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date picker
      $('#reservationdate').datetimepicker({
          format: 'L'
      });

      //Date and time picker
      $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'DD/MM/YYYY hh:mm A'
        }
      })
      //Date range as a button
      $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      //Timepicker
      $('#timepicker').datetimepicker({
        format: 'LT'
      })

      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()

      $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      })

    })
  </script>
<script>
  $(function () {
  $('#datetimepicker5').datetimepicker({
    locale: 'pt-br'
  });
});
</script>
<script>
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<script>
    function numberToReal(numero) {
    var numero = numero.toFixed(2).split('.');
    numero[0] = "R$ " + numero[0].split(/(?=(?:...)*$)/).join('.');
    return numero.join(',');
    }

    function mascara(o,f){
        v_obj=o
        v_fun=f
        setTimeout("execmascara()",1)
    }
    function execmascara(){
        v_obj.value=v_fun(v_obj.value)
    }
    function leech(v){
        v=v.replace(/o/gi,"0")
        v=v.replace(/i/gi,"1")
        v=v.replace(/z/gi,"2")
        v=v.replace(/e/gi,"3")
        v=v.replace(/a/gi,"4")
        v=v.replace(/s/gi,"5")
        v=v.replace(/t/gi,"7")
        return v
    }
    function soNumeros(v){
        return v.replace(/\D/g,"")
    }
    function telefone(v){
        v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
        v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
        //v=v.replace(/(\d)(\d{3})/,"$1 $2")    //Coloca um espaço no primeiro dígito do telefone
        //v=v.replace(/(\d{4})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2")    //Coloca hífen entre o terceiro e o quarto dígitos
        return v
    }
    function celularMasc(v){
        v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
        v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
        v=v.replace(/(\d)(\d{3})/,"$1 $2")    //Coloca um espaço no primeiro dígito do telefone
        v=v.replace(/(\d{4})(\d)/,"$1-$2")    //Coloca hífen entre o terceiro e o quarto dígitos
        return v
    }
    function cpf(v){
        v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
        v=v.replace(/(\d{2})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                                //de novo (para o segundo bloco de números)
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
        return v
    }
    function cep(v){
        // v=v.replace(/D/g,"")                //Remove tudo o que não é dígito
        // v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
        v=v.replace(/^(\d{5})(\d)/,"$1-$2") //Esse é tão fácil que não merece explicações
        return v
    }
    function soNumeros(v){
        return v.replace(/\D/g,"")
    }

    function cpf(v){
        v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
        v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                                //de novo (para o segundo bloco de números)
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
        return v
    }
    function mdata(v){
        v=v.replace(/\D/g,"");
        v=v.replace(/(\d{2})(\d)/,"$1/$2");
        v=v.replace(/(\d{2})(\d)/,"$1/$2");

        v=v.replace(/(\d{2})(\d{2})$/,"$1$2");
        return v;
    }
    function mcc(v){
        v=v.replace(/\D/g,"");
        v=v.replace(/^(\d{4})(\d)/g,"$1 $2");
        v=v.replace(/^(\d{4})\s(\d{4})(\d)/g,"$1 $2 $3");
        v=v.replace(/^(\d{4})\s(\d{4})\s(\d{4})(\d)/g,"$1 $2 $3 $4");
        return v;
    }
</script>

@stop

@extends('adminlte::page')

@section('title', 'Pcts')

@section('content_header')

@stop

@section('content')

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Pacientes</h3>
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
                                <th class="col-sm-1" style="text-align: center">#</th>
                                <th class="sorting sorting_asc col-sm-3" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" title="Classificar crescente / decrescente">Nome</th>
                                <th class="sorting col-sm-5" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Endereço</th>
                                {{-- <th class="sorting col-sm-1" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Bairro</th> --}}
                                <th class="sorting col-sm-1" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Cidade</th>
                                {{-- <th class="sorting col-sm-1" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">UF</th> --}}
                                <th class="sorting col-sm-1" data-toggle="tooltip" title="Localização do Paciente" aria-controls="example1" rowspan="1" colspan="1" style="text-align: center"><i class="fas fa-map-marker-alt"></i></th>
                                {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Telefone</th> --}}
                                {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Celular</th> --}}
                                {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Home Care</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <div data-toggle="modal" data-target="#ModalAddPct">
                                <button data-toggle="tooltip" title="Adicionar novo Paciente" type="button" class="btn btn-sm btn-outline-primary float-right" ><i class="fas fa-plus"></i></button>
                            </div>

                            @foreach ($allPcts as $Pct)
                            <tr class="odd" style="line-height: 100%">
                                <td style="text-align: center">{{$Pct->id}}</td>
                                <td>{{$Pct->name_pct}}</td>
                                <td>{{$Pct->end_pct}}</td>
                                {{-- <td>{{$Pct->bairro_pct}}</td> --}}
                                <td>
                                    @foreach ( $allCities as $City)
                                        @if ($City->id == $Pct->city_pct)
                                            {{$City->nome}}
                                        @endif
                                    @endforeach
                                </td>
                                {{-- <td>{{$Pct->uf_pct}}</td> --}}
                                <td style="text-align: center">
                                    @if ($Pct->localization_pct==0)

                                    @else
                                        <a href="{{$Pct->localization_pct}}">Local</a>
                                    @endif
                                </td>
                                {{-- <td>{{$Pct->tel1_pct}}</td> --}}
                                {{-- <td>{{$Pct->tel2_pct}}</td> --}}
                                {{-- <td>{{$Pct->id_hc}}</td> --}}
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



                <!-- Modal -->
                <div class="modal fade" id="ModalAddPct" tabindex="-1" role="dialog" aria-labelledby="ModalAddPct" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="ModalAddPct">Adicionar Novo Paciente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form action="#" method="post">
                        {{-- <form action="{{route('new_Pct_submit')}}" method="post"> --}}
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">


                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <label style="fo" for="Pct">Paciente:</label>
                                    <input type="text" class="form-control form-control-sm" name="Pct" id="Pct" placeholder="Nome Completo do Paciente" maxlength="50" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="responsavel">Responsável:</label>
                                    <input type="text" class="form-control form-control-sm" name="responsavel" id="responsavel" placeholder="Ex: Maria da Silva (Esposa)" maxlength="50" required>
                                </div>
                                <div class="col-sm-2">
                                    <label for="telefone">Tel:</label>
                                    <input type="text" class="form-control form-control-sm" style="font-size: 85%" name="telefone" id="telefone" placeholder="Celular" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control form-control-sm" data-toggle="tooltip" title="E-mail do responsável" placeholder="E-mail de contato">
                                      </div>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" name="responsavel" id="responsavel" placeholder="Ex: Manoel da Silva (Filho)" maxlength="50" required>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control form-control-sm" style="font-size: 85%" name="telefone" id="telefone" placeholder="Celular" required>
                                </div>
                            </div>


                            <div class="row form-group">
                                <div class="col-sm-12">
                                    <label for="endereco">Endereço:</label>
                                    <input type="text" class="form-control form-control-sm" data-toggle="tooltip" title="Use abreviações Ex: Qd, Cj, Bl, Cs, Sl, Lt, Apt, Cond, Nº etc. "  name="endereco" id="endereco" placeholder="Endereço" maxlength="100" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-sm" name="bairro" id="bairro" placeholder="Bairro" required>
                                </div>
                                <div>
                                    <select name="city" id="city" class="form-control form-control-sm select" aria-hidden="true">
                                        <option selected value="0">Selecione a Cidade</option>
                                        @foreach ( $allCities as $City)
                                            <option value={{$City->id}}>{{$City->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <select name="uf" id="uf" class="form-control form-control-sm select" aria-hidden="true">
                                        <option selected value="7">DF</option>
                                        {{-- @foreach ($fornecedores as $fornecedor) --}}
                                                {{-- <option value="{{$fornecedor->id}}">{{$fornecedor->name_fornec}}</option> --}}
                                            {{-- @endforeach --}}
                                        </select>
                                </div>

                                <div class="col-sm-2">
                                    <input type="text" class="form-control form-control-sm" name="cep" id="cep" placeholder="CEP" required>
                                </div>

                                    <div class="col-sm-2">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <input type="email" class="form-control form-control-sm" data-toggle="tooltip" title="Localização">
                                          </div>
                                    </div>

                            </div>
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <label for="obs">Observações:</label>
                                    <input type="text" class="form-control form-control-sm" name="obs" id="obs" placeholder="Observações sobre o paciente" maxlength="50" required>
                                </div>
                                <div class="col-sm-3">
                                    <label for="hc">Home Care</label>
                                    <select name="hc" id="hc" class="form-control form-control-sm select" style="width: 100%;" aria-hidden="true">
                                        <option selected value="0">Selecione</option>
                                        {{-- @foreach ($fornecedores as $fornecedor) --}}
                                                {{-- <option value="{{$fornecedor->id}}">{{$fornecedor->name_fornec}}</option> --}}
                                            {{-- @endforeach --}}
                                        </select>
                                </div>
                                <div class="col-sm-3">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" checked="">
                                        <label for="customCheckbox4" class="custom-control-label">Obeso</label>
                                      </div>
                                </div>
                            </div>
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
    <link rel="stylesheet" href="css/css">
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="css/all.min.css"> --}}

    <!-- DataTables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.min.css">
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
    <!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="js/bootstrap.bundle.min.js"></script>
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
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
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

<!-- jQuery -->
{{-- <script src="js/jquery.min.js"></script> --}}
<!-- Bootstrap 4 -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="js/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="js/moment.min.js"></script>
<script src="js/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="js/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="js/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<script src="js/functions-equips.js"></script>

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
@stop

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
                    
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                        
                    <thead>
                        <tr role="row">
                            <th>#</th>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" title="Classificar crescente / decrescente">Cliente</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Endereço</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Telefone</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Celular</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr class="odd">
                                <td>{{$cliente->id}}</td>
                                <td class="dtr-control sorting_1" tabindex="0">{{$cliente->cliente}}</td>
                                <td>{{$cliente->endereco}}</td>
                                <td>{{$cliente->telefone}}</td>
                                <td>{{$cliente->celular}}</td>
                                <td>{{$cliente->email}}</td>
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
                    <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#ModalAddCliente"><i class="fas fa-plus"></i> Novo Cliente</button>


                <!-- Modal -->
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
                                <div class="col-md-6">
                                    <label for="telefone">Telefone:</label>
                                    <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Tel fixo" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="celular">Celular:</label>
                                    <input type="text" class="form-control" name="celular" id="celular" placeholder="Celular" required>
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
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
@stop

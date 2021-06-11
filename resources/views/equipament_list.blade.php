@extends('adminlte::page')

@section('title', 'Equipamentos')

@section('content_header')

@stop

@section('content')


<div class="col-12 col-sm-12">
    <div class="card card-primary card-outline card-outline-tabs">
      <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Em estoque</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Implantados</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Manutenção</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Locados</a>
          </li>
        </ul>
      </div>
      <div class="card-body">

        <div class="tab-content" id="custom-tabs-four-tabContent">
          <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
            <div>
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="col-sm-8 col-md-6" style="margin-bottom: -30px">
                        <div class="dt-buttons btn-group flex-wrap"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">

                        <table id="example1" class="table table-sm  table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

                        <thead>
                            <tr role="row">
                                <th style="text-align: center">#</th>
                                {{-- <th>PCT</th> --}}
                                <th style="text-align: center" class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" title="Classificar crescente / decrescente">Patr</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Equipamento</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" data-toggle="tooltip" title="Status do Equipamento" style="text-align: center"><i class="fas fa-cogs"></i></th>
                                {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" data-toggle="tooltip" title="Implantado"></th> --}}
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" data-toggle="tooltip" title="Alugado / Próprio"></th>
                                {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" data-toggle="tooltip" title="Alugado / Próprio">A/P</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equips as $equip)
                                <tr class="odd" style="text-align: center; vertical-align: middle; line-height: 50%">
                                    <td style="text-align: center; vertical-align: middle">{{$equip->id}}</td>
                                    {{-- <td>{{$equip->pct_equip}}</td> --}}
                                    {{-- <td>
                                        @if ($equip->pct_equip == '0')
                                        @else
                                            @foreach ($namePcts as $namePct)
                                            @if ($namePct->id == $equip->id)
                                                <p data-toggle="tooltip" data-placement="top" title="" data-original-title= {{$namePct->name_pct}} style="color:green" ><i class="fa fa-bed"></i></p>
                                            @endif
                                            @endforeach
                                        @endif
                                    </td> --}}
                                    <td style="text-align: center; vertical-align: middle" class="dtr-control sorting_1" tabindex="0">{{$equip->patr}}</td>
                                    <td style="text-align: left; vertical-align: middle">{{$equip->name_equip}}</td>
                                    {{-- <td>{{$equip->status_equip}}</td> --}}
                                    <td style="text-align: center; vertical-align: middle">

                                        @if ($equip->status_equip == '0')
                                            <p style="color:green"><i class="fa fa-check"></i></p>
                                        @else
                                            <p style="color: red"><i class="fa fa-times"></i></p>
                                            {{-- <p data-toggle="tooltip" data-placement="top" title="" data-original-title="Em manutenção" style="color: red"><i class="fa fa-times"></i></p> --}}
                                        @endif

                                    {{-- <td style="text-align: center; vertical-align: middle"> --}}
                                        {{-- Mostra o Paciente que está implantado --}}
                                        {{-- @if ($equip->pct_equip == '0')
                                        @else
                                                @foreach ($allPcts as $allPct)
                                                @if ($allPct->id == $equip->pct_equip)
                                                    <p style="color:green" ><i class="fa fa-bed"></i></p> --}}
                                                    {{-- <p data-toggle="tooltip" data-placement="top" title="" data-original-title= "{{$allPct->name_pct}}" style="color:green" ><i class="fa fa-bed"></i></p> --}}
                                                {{-- @endif
                                                @endforeach
                                        @endif
                                    </td> --}}
                                    <td style="text-align: center; vertical-align: middle">
                                        {{-- Mostra a Alugado/Próprio --}}
                                        @if ($equip->rent_equip == '0')
                                            <p style="color:green"><i class="fa fa-check-circle"></i></p>
                                            {{-- <p data-toggle="tooltip" data-placement="top" title="" data-original-title="Próprio" style="color:green"><i class="fa fa-check-circle"></i></p> --}}
                                        @else
                                            @foreach ($fornecedores as $fornecedor)
                                            @if ($fornecedor->id == $equip->rent_empresa)
                                                <p style="color: rgb(247, 170, 3)"><i class="fa fa-exchange-alt"></i></p>
                                                {{-- <p data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$fornecedor->name_fornec}}" style="color: rgb(247, 170, 3)"><i class="fa fa-exchange-alt"></i></p> --}}
                                            @endif
                                            @endforeach
                                        @endif
                                    </td>

                                    </td>
                                    {{-- <td>{{$equip->rent_equip}}</td> --}}
                                    {{-- <td style="text-align: center; vertical-align: middle"> --}}
                                        {{-- @if ($equip->rent_equip == '0')
                                            <p data-toggle="tooltip" data-placement="top" title="" data-original-title="Próprio" style="color:green"><i class="fa fa-check-circle"></i></p>
                                        @else
                                            <p data-toggle="tooltip" data-placement="top" title="" data-original-title="Alugado" style="color: rgb(247, 170, 3)"><i class="fa fa-exchange-alt"></i></p>
                                        @endif --}}
                                    {{-- </td> --}}
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

                    <button type="button" class="btn btn-sm btn-outline-primary float-right" data-toggle="modal" data-target="#ModalAddEquip"><i class="fas fa-plus"></i>Novo Equipamento</button>

                    <!-- Modal -->
                    <div class="modal fade bd-example-modal-lg" id="ModalAddEquip" tabindex="-1" role="dialog" aria-labelledby="ModalAddEquip" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="ModalAddEquip">Adicionar Novo Equipamento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form action="{{route('newEquipSubmit')}}" method="post">
                            <div class="modal-body">
                                @csrf
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="cliente">Equipamento:</label>
                                        <input type="text" class="form-control" name="name_equip" id="name_equip" placeholder="Nome do equipamento" maxlength="50" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cliente">Patrimônio Nº:</label>
                                        <input type="text" class="form-control" name="patr" id="patr" placeholder="Nº de patrimônio" maxlength="50" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="telefone">Modelo:</label>
                                        <input type="text" class="form-control" name="modelo_equip" id="modelo_equip" placeholder="Modelo do Equipamento" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="celular">Marca:</label>
                                        <input type="text" class="form-control" name="marca_equip" id="marca_equip" placeholder="Marca do Equipamento" required>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                <div class="col-md-3">
                                    <div>
                                    <input class="check-input" type="checkbox" value="1" name="rent_equip" id="rent_equip" onchange="locacaoSelecionada()">
                                    <label for="rent_equip">Locação</label>
                                    <div id="rent_empresa" name="rent_empresa" style="visibility: hidden" data-toggle="tooltip" data-original-title="Empresa que alugou o equipamento" >
                                        <select name="value_rent_empresa" id="value_rent_empresa" class="form-control select" style="width: 100%;" aria-hidden="true" name="selectEmpresaRent" id="selectEmpresaRent">
                                        <option selected value="0">Selecione</option>
                                        @foreach ($fornecedores as $fornecedor)
                                                <option value="{{$fornecedor->id}}">{{$fornecedor->name_fornec}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-9">
                                    <div id="selectPctList" name="selectPctList" style="visibility: hidden">

                                        <label>Paciente</label>
                                        <select id="valuePct" name="valuePct" class="form-control select" style="width: 100%;" tabindex="-1" aria-hidden="true" data-toggle="tooltip" data-original-title="Paciente que o equipamento será implantado">
                                            <option selected value="0">Selecione o paciente</option>
                                            @foreach ($allPcts as $allPct)
                                                <option value="{{$allPct->id}}">{{$allPct->name_pct}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                </div>

                                <div class="row form-group">
                                    <div class='input-group date col-md-3' id='datetimepicker5'>
                                    <input type='date' class="form-control" id="data_rent" name="data_rent" style="visibility: hidden" data-toggle="tooltip" data-original-title="Data de início da locação"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    </div>
                                    <div class="col-md-8">
                                    <input type="file" style="visibility: hidden" class="form-control-file" name="guia_loc" id="guia_loc" data-toggle="tooltip" data-original-title="Anexar Guia de Locação.">
                                    </div>
                                </div>

                                <div class="row form-group">
                                    {{-- <label for="endereco">Obs:</label> --}}
                                    <textarea class="form-control" name="desc_equip" id="desc_equip" cols="5" rows="1" placeholder="Observações e Anotações a sobre este equipamento" maxlength="100"></textarea>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                                <a href=""></a>
                                <button type="submit" class="btn btn-outline-primary">Salvar</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>

                <!-- /.Equipamentos em Estoque  -->

                <!-- Modal -->
                <div class="modal fade bd-example-modal-lg" id="ModalAddEquip" tabindex="-1" role="dialog" aria-labelledby="ModalAddEquip" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="ModalAddEquip">Adicionar Novo Equipamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form action="{{route('newEquipSubmit')}}" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="cliente">Equipamento:</label>
                                    <input type="text" class="form-control" name="name_equip" id="name_equip" placeholder="Nome do equipamento" maxlength="50" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="cliente">Patrimônio Nº:</label>
                                    <input type="text" class="form-control" name="patr" id="patr" placeholder="Nº de patrimônio" maxlength="50" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="telefone">Modelo:</label>
                                    <input type="text" class="form-control" name="modelo_equip" id="modelo_equip" placeholder="Modelo do Equipamento" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="celular">Marca:</label>
                                    <input type="text" class="form-control" name="marca_equip" id="marca_equip" placeholder="Marca do Equipamento" required>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                            <div class="col-md-3">
                                <div>
                                <input class="check-input" type="checkbox" value="1" name="rent_equip" id="rent_equip" onchange="locacaoSelecionada()">
                                <label for="rent_equip">Locação</label>
                                <div id="rent_empresa" name="rent_empresa" style="visibility: hidden" data-toggle="tooltip" data-original-title="Empresa que alugou o equipamento" >
                                    <select name="value_rent_empresa" id="value_rent_empresa" class="form-control select" style="width: 100%;" aria-hidden="true" name="selectEmpresaRent" id="selectEmpresaRent">
                                    <option selected value="0">Selecione</option>
                                    @foreach ($fornecedores as $fornecedor)
                                            <option value="{{$fornecedor->id}}">{{$fornecedor->name_fornec}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                            </div>

                            <div class="form-group col-md-9">
                                <div id="selectPctList" name="selectPctList" style="visibility: hidden">

                                    <label>Paciente</label>
                                    <select id="valuePct" name="valuePct" class="form-control select" style="width: 100%;" tabindex="-1" aria-hidden="true" data-toggle="tooltip" data-original-title="Paciente que o equipamento será implantado">
                                        <option selected value="0">Selecione o paciente</option>
                                        @foreach ($allPcts as $allPct)
                                            <option value="{{$allPct->id}}">{{$allPct->name_pct}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            </div>

                            <div class="row form-group">
                                <div class='input-group date col-md-3' id='datetimepicker5'>
                                <input type='date' class="form-control" id="data_rent" name="data_rent" style="visibility: hidden" data-toggle="tooltip" data-original-title="Data de início da locação"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                </div>
                                <div class="col-md-8">
                                <input type="file" style="visibility: hidden" class="form-control-file" name="guia_loc" id="guia_loc" data-toggle="tooltip" data-original-title="Anexar Guia de Locação.">
                                </div>
                            </div>

                            <div class="row form-group">
                                {{-- <label for="endereco">Obs:</label> --}}
                                <textarea class="form-control" name="desc_equip" id="desc_equip" cols="5" rows="1" placeholder="Observações e Anotações a sobre este equipamento" maxlength="100"></textarea>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                            <a href=""></a>
                            <button type="submit" class="btn btn-outline-primary">Salvar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
          <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
            <div>
                <div id="implantados_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="col-sm-8 col-md-6" style="margin-bottom: -30px">
                        <div class="dt-buttons btn-group flex-wrap"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">

                        <table id="table_implantados" class="table table-sm  table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

                        <thead>
                            <tr role="row">
                                <th style="text-align: center">#</th>
                                {{-- <th>PCT</th> --}}
                                <th style="text-align: center" class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" title="Classificar crescente / decrescente">Patr</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">Equipamento</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" data-toggle="tooltip" title="Status do Equipamento" style="text-align: center"><i class="fas fa-cogs"></i></th>
                                {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" data-toggle="tooltip" title="Implantado"></th> --}}
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" data-toggle="tooltip" title="Alugado / Próprio"></th>
                                {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" data-toggle="tooltip" title="Alugado / Próprio">A/P</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipsImplantados as $equipImplantado)
                                <tr class="odd" style="text-align: center; vertical-align: middle; line-height: 50%">
                                    <td style="text-align: center; vertical-align: middle">{{$equipImplantado->id}}</td>
                                    {{-- <td>{{$equip->pct_equip}}</td> --}}
                                    {{-- <td>
                                        @if ($equip->pct_equip == '0')
                                        @else
                                            @foreach ($namePcts as $namePct)
                                            @if ($namePct->id == $equip->id)
                                                <p data-toggle="tooltip" data-placement="top" title="" data-original-title= {{$namePct->name_pct}} style="color:green" ><i class="fa fa-bed"></i></p>
                                            @endif
                                            @endforeach
                                        @endif
                                    </td> --}}
                                    <td style="text-align: center; vertical-align: middle" class="dtr-control sorting_1" tabindex="0">{{$equipImplantado->patr}}</td>
                                    <td style="text-align: left; vertical-align: middle">{{$equipImplantado->name_equip}}</td>
                                    {{-- <td>{{$equip->status_equip}}</td> --}}
                                    <td style="text-align: center; vertical-align: middle">

                                        @if ($equipImplantado->status_equip == '0')
                                            <p style="color:green"><i class="fa fa-check"></i></p>
                                        @else
                                            <p style="color: red"><i class="fa fa-times"></i></p>
                                            {{-- <p data-toggle="tooltip" data-placement="top" title="" data-original-title="Em manutenção" style="color: red"><i class="fa fa-times"></i></p> --}}
                                        @endif

                                    <td style="text-align: center; vertical-align: middle">
                                        {{-- Mostra o Paciente que está implantado --}}
                                        @if ($equipImplantado->pct_equip == '0')
                                        @else
                                                @foreach ($allPcts as $allPct)
                                                @if ($allPct->id == $equipImplantado->pct_equip)
                                                    {{-- <p style="color:green" ><i class="fa fa-bed"></i></p> --}}
                                                    <p data-toggle="tooltip" data-placement="top" title="" data-original-title= "{{$allPct->name_pct}}" style="color:green" ><i class="fa fa-bed"></i></p>
                                                @endif
                                                @endforeach
                                        @endif
                                    </td>
                                    <td style="text-align: center; vertical-align: middle">
                                        {{-- Mostra a Alugado/Próprio --}}
                                        @if ($equipImplantado->rent_equip == '0')
                                            <p style="color:green"><i class="fa fa-check-circle"></i></p>
                                            {{-- <p data-toggle="tooltip" data-placement="top" title="" data-original-title="Próprio" style="color:green"><i class="fa fa-check-circle"></i></p> --}}
                                        @else
                                            @foreach ($fornecedores as $fornecedor)
                                            @if ($fornecedor->id == $equipImplantado->rent_empresa)
                                                <p style="color: rgb(247, 170, 3)"><i class="fa fa-exchange-alt"></i></p>
                                                {{-- <p data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$fornecedor->name_fornec}}" style="color: rgb(247, 170, 3)"><i class="fa fa-exchange-alt"></i></p> --}}
                                            @endif
                                            @endforeach
                                        @endif
                                    </td>

                                    </td>
                                    {{-- <td>{{$equip->rent_equip}}</td> --}}
                                    {{-- <td style="text-align: center; vertical-align: middle"> --}}
                                        {{-- @if ($equip->rent_equip == '0')
                                            <p data-toggle="tooltip" data-placement="top" title="" data-original-title="Próprio" style="color:green"><i class="fa fa-check-circle"></i></p>
                                        @else
                                            <p data-toggle="tooltip" data-placement="top" title="" data-original-title="Alugado" style="color: rgb(247, 170, 3)"><i class="fa fa-exchange-alt"></i></p>
                                        @endif --}}
                                    {{-- </td> --}}
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



                </div>

                <!-- /.Equipamentos em Estoque  -->


            </div>
          </div>
          <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
             Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
          </div>
          <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
             Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
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
{{-- <script src="js/jquery.min.js"></script> --}}
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
<script>
    $(function () {
      $("#table_implantados").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#implantados_wrapper .col-md-6:eq(0)');
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

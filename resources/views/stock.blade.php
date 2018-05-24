
@extends('adminlte::page')

@section('title', 'Invest')

@section('content_header')
    <h1>Lista de Ações</h1>
@stop

@section('content')
<p>Quantidade de ações disponíveis: {{ $stocksCount }}</p>

<div class="box-header">
    <h3 class="box-title pull-right">
        <a href="" onclick="alert('Funcionalidade ainda nao implementada!!');" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Adicionar</a>
        {{-- <a href="" onclick="alert('Funcionalidade ainda nao implementada!!');" class="btn btn-primary"><i class="fa fa-refresh"></i>&nbsp;&nbsp;&nbsp;Importar Historico</a> --}}
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-date-updateall"><i class="fa fa-refresh"></i>&nbsp;&nbsp;&nbsp;Importar Historico</button>
    </h3>
</div>

<div style="display: none;" class="modal fade" id="modal-date-updateall">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Data de Início</h4>
        </div>
            <div class="modal-body">
                <div class="form-group" style="width:300px">
                    {!! Form::open() !!}
                    {{-- <label>Data de Início:</label> --}}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        {!!Form::text('beginDate',null,['class'=>'form-control', 'data-inputmask-alias'=>'datetime'])!!}
                        <span class="input-group-btn">
                                {!! Form::button('<i class="fa fa-refresh"></i>&nbsp;&nbsp;&nbsp;Importar',['type' => 'submit','id'=>'beginDateSubmit','class' => 'btn btn-primary']) !!}
                        </span>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group --> 
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
        <!-- /.modal-content -->
        {!! Form::close() !!}
    </div>
    <!-- /.modal-dialog -->
</div>


@if (isset($stocks) && $stocks != NULL)
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title" style="font-size:14px">Esta ação possui dados históricos disponíveis apenas a partir de xx/01/2018</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input name="table_search" class="form-control pull-right" placeholder="Search" type="text">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th style="width: 20px">#</th>
                            <th style="width: 20px"><input type="checkbox" name=""></th>
                            <th>Código</th>
                            <th>Histórico de Cotações</th>
                            <th>Última Atualização</th>
                            <th style="width: 100px">Menu</th>
                        </tr>
                        @foreach ($stocks as $stock)
                            <tr>    
                                <td>{{ $loop->iteration }}</td>
                                <td><input type="checkbox" name="ticker" value='{{ $stock->ticker }}'></td>
                                <td>{{ $stock->ticker }}</td>
                                <td>{{ $stock->first_history }} - {{ $stock->last_history }}</td>
                                <td>{{ $stock->updated_at }}</td>
                                <td>
                                    <a id="deleteHistory" title="Excluir historico de cotação"
                                        onclick="alert('Funcionalidade ainda nao implementada!!');" href="" style="padding-left: 9px;"><i class="fa fa-edit"></i></a>
                                    <a href="{!! route('stock-history.show',['ticker'=>$stock->ticker]) !!}" style="padding-left: 9px;"><i class="fa fa-refresh"></i></a>
                                    <a id="deleteHistory" title="Excluir historico de cotação"
                                        onclick="alert('Funcionalidade ainda nao implementada!!');" href="" style="padding-left: 9px;"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
{{-- Paginaçao  --}}
<div class="row">
    <div class="col-xs-12">
        <div class="pull-right">
        {{-- Adapção abaixo para editar o html gerado pelo metodo links() padrao do laravel --}}
        {!!  str_replace("<ul", "<ul style='margin:0' ", $stocks->links()) !!} 
        </div>
    </div>
</div>
@else
<h4>Nenhum registro encontrado.</h4>
@endif

<a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Voltar</a>

@stop

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#beginDateSubmit').on('click', function (e) {
                e.preventDefault();
                var beginDate = $("input[name=beginDate]").val();
                // alert(beginDate);
                // var title = $('#title').val();
                var ticker = 'VULC3'
                $.ajax({
                    type: "GET",
                    url: "{{ route('stock-history.updateEmMassa') }}/",
                    data: {beginDate: beginDate, ticker: ticker},
                    success: function( msg ) {
                        console.log(msg);
                    }
                });
            });
        });
    </script>
{{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}
@stop
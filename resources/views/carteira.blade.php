
@extends('adminlte::page')

@section('title', 'Invest')

@section('content_header')
    <h1>Lista de Operaçoes em Ações e FII</h1>
@stop

@section('content')
<div class="box-header">
    <h3 class="box-title pull-right">
        <a href="{{ route('carteira.nova-operacao') }}" title="Cadastrar operação de compra de ação" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Nova Operação</a>
        {{-- <a href="" onclick="alert('Funcionalidade ainda nao implementada!!');" class="btn btn-primary"><i class="fa fa-refresh"></i>&nbsp;&nbsp;&nbsp;Importar Historico</a> --}}
        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-date-updateall"><i class="fa fa-refresh"></i>&nbsp;&nbsp;&nbsp;Importar Historico</button> --}}
    </h3>
</div>


@if (isset($operacoes) && !$operacoes->isEmpty())
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3></h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 200px;">
                        <input name="table_search" class="form-control pull-right" placeholder="CÓDIGO" type="text">
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
                            {{-- <th style="width: 20px"><input type="checkbox" name="select_all_tickers"></th> --}}
                            <th>Ativo</th>
                            <th>Data</th>
                            <th>Tipo Operação</th>
                            <th>Quantidade</th>
                            <th>Preço/Ajuste</th>
                            <th>Taxas</th>
                            <th>Corretora</th>
                            <th>Classe</th>
                            <th>Valor Operação</th>
                            <th>Lucro</th>
                            <th>% Lucro</th>
                            <th>Qtd Atual</th>
                            <th>PM Atual</th>
                            <th>Qtd Anterior</th>
                            <th>PM Anterior</th>
                            <th>Valor Investido</th>
                            <th>Total Operação</th>
                            <th>Op.Aberta?</th>
                            <th style="width: 100px">Menu</th>
                        </tr>
                        @foreach ($operacoes as $operacao)
                            <tr>    
                                <td>{{ $loop->iteration }}</td>
                                <td><input type="checkbox" name="ticker" value='{{ $stock->ticker }}'></td>
                                <td>{{ $operacao->cod_ativo }}</td>
                                <td>{{ $operacao->data }}</td>
                                <td>{{ $operacao->tipo_operacao }}</td>
                                <td>{{ $operacao->quantidade }}</td>
                                <td>
                                    <a id="deleteHistory" title="Editar ativo"
                                        onclick="alert('Funcionalidade ainda nao implementada!!');" href="" style="padding-left: 9px;"><i class="fa fa-edit"></i></a>
                                    <a href="{!! route('stock-history.show',['ticker'=>$stock->ticker]) !!}" title="Importar histórico de cotações" style="padding-left: 9px;"><i class="fa fa-refresh"></i></a>
                                    <a id="deleteHistory" title="Excluir ativo"
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
        {{-- {!!  str_replace("<ul", "<ul style='margin:0' ", $stocks->links()) !!}  --}}
        </div>
    </div>
</div>
@else
    <h4>Nenhum registro encontrado.</h4>
@endif

<a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Voltar</a>

@stop

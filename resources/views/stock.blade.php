
@extends('adminlte::page')

@section('title', 'Invest')

@section('content_header')
    <h1>Histórico de Cotações de Ações</h1>
@stop

@section('content')
<p>Quantidade de ações disponíveis: {{ $stocksCount }}</p>

<div class="box-header">
    <h3 class="box-title"></h3>
</div>
<!-- /.box-header -->
<div class="box-body no-padding">
    <table class="table table-condensed">
        <tbody>
            <tr>
                <th style="width: 10px">#</th>
                <th>Código</th>
                <th>Histórico desde</th>
                <th>Última Atualização</th>
                <th style="width: 80px">Menu</th>
            </tr>
            @foreach ($stocks as $stock)
                <tr>    
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $stock->ticker }}</td>
                    <td>{{ $stock->inicial_history }}</td>
                    <td>{{ $stock->last_history_update }}</td>
                    <td><a href="" style="padding-left: 9px;"><i class="fa fa-search"></i></a>
                        <a href="{!! route('stock.updateHistory',['ticker'=>$stock->ticker]) !!}" style="padding-left: 9px;"><i class="fa fa-refresh"></i>
                        <a href="" style="padding-left: 9px;"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- /.box-body -->
@stop
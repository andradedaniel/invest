
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
        <a href="" onclick="alert('Funcionalidade ainda nao implementada!!');" class="btn btn-primary"><i class="fa fa-refresh"></i>&nbsp;&nbsp;&nbsp;Importar Historico</a>
    </h3>
</div>
<!-- /.box-header -->
<div class="box-body no-padding">
    <table class="table table-condensed">
        <tbody>
            <tr>
                <th style="width: 20px">#</th>
                <th>Código</th>
                <th>Histórico de Cotações</th>
                <th>Última Atualização</th>
                <th style="width: 80px">Menu</th>
            </tr>
            @foreach ($stocks as $stock)
                <tr>    
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $stock->ticker }}</td>
                    <td>{{ $stock->first_history }} - {{ $stock->last_history }}</td>
                    <td>{{ $stock->updated_at }}</td>
                    <td><a id="deleteHistory" title="Excluir historico de cotação"
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
@stop

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        //alert("Settings page was loaded");
    });
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
@stop
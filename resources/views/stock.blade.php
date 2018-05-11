
@extends('adminlte::page')

@section('title', 'Invest')

@section('content_header')
    <h1>Histórico de Cotações de Ações</h1>
@stop

@section('content')
<p>Quantidade de ações disponíveis: {{ $stocksCount }}</p>

<div class="box-header">
    <h3 class="box-title">Ações disponíveis</h3>
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
                    <td><a href="{!! route('stock.show',['ticker'=>$stock->ticker]) !!}" style="padding-left: 9px;"><i class="fa fa-search"></i></a>
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
@stop
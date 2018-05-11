
@extends('adminlte::page')

@section('title', 'Invest')

@section('content_header')
    <h1>Histórico de Cotações de <b>{{ $ticker }}</b></h1>
@stop

@section('content')

<div class="box-body">
        {!! Form::open(['route' => ['stock.updateHistory',$ticker]]) !!}
            <div class="form-group">
                <label>Data de Início:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        {!!Form::text('beginDate')!!}
                        <!-- <input id="data1" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/aaaa'" data-mask=""> -->
                    </div>
            </div>
            {{-- <div class="form-group">
                <label>Data de Fim:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="data2" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/aaaa'" data-mask="">
                    </div>
            </div> --}}
            {!! Form::button('<i class="fa fa-refresh"></i>&nbsp;&nbsp;&nbsp;Importar Histórico',['type' => 'submit','class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
<hr>

@if (isset($stockHistory) && $stockHistory != NULL)
<!-- /.box-header -->
<div class="box-header">
        Esta ação possui dados históricos disponíveis apenas a partir de xx/01/2018
</div>
<div class="box-body no-padding">
    <table class="table table-condensed">
        <tbody>
            <tr>
                <th style="width: 10px">#</th>
                <th>Data</th>
                <th>Fechamento</th>
                <th>Mínima</th>
                <th>Máxima</th>
                <th>Variação</th>
                <th>Variação %</th>
            </tr>
            @foreach ($stockHistory as $history)
                <tr>    
                    <td>{{ $loop->iteration+$skipped }}</td>
                    <td>{{ $history->date }}</td>
                    <td>{{ $history->closed }}</td>
                    <td>{{ $history->min }}</td>
                    <td>{{ $history->max }}</td>
                    <td>{{ $history->var }}</td>
                    <td>{{ $history->var_percent }}%</td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
<div class="clearfix" style="align:right">
{{ $stockHistory->links() }}
</div>
@else
    <h4>Nenhum registro encontrado.</h4>
@endif

<a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Voltar</a>

<!-- /.box-body -->
@stop
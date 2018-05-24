
@extends('adminlte::page')

@section('title', 'Invest')

@section('content_header')
    <h1>Histórico de Cotações de <b>{{ $ticker }}</b></h1>
@stop

@section('content')
    {!! Form::open(['route' => ['stock-history.update',$ticker]]) !!}
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Atualizar Histórico de Cotações</h4>
                    </div>
                    <div class="box-body">
                        <!-- Date dd/mm/yyyy -->
                        <div class="form-group" style="width:300px">
                                <label>Data de Início:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {!!Form::text('beginDate',null,['class'=>'form-control', 'data-inputmask-alias'=>'datetime'])!!}
                                    <span class="input-group-btn">
                                            {!! Form::button('<i class="fa fa-refresh"></i>&nbsp;&nbsp;&nbsp;Importar',['type' => 'submit','class' => 'btn btn-primary']) !!}
                                    </span>
                                </div>
                                <!-- /.input group -->
                        </div>
                        <!-- /.form group --> 
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    {!! Form::close() !!}


    @if (isset($stockHistory) && $stockHistory != NULL)
        <div class="row">
            <div class="col-xs-12">
                <div id="chart_container" style="width:100%; height:400px;"></div>
            </div>
        </div>
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
                {!!  str_replace("<ul", "<ul style='margin:0' ", $stockHistory->links()) !!} 
                </div>
            </div>
        </div>
    @else
        <h4>Nenhum registro encontrado.</h4>
    @endif

    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Voltar</a>
@stop

@section('js')
    <!-- InputMask -->
    <script src="{{ asset('js/inputmask/inputmask.min.js') }}"></script>
    <script src="{{ asset('js/inputmask/inputmask.date.extensions.min.js') }}"></script>
    <script src="{{ asset('js/inputmask/inputmask.extensions.min.js') }}"></script>
    <script src="{{ asset('js/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('js/inputmask/bindings/inputmask.binding.min.js') }}"></script>
    <!-- HighCharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>@include('graficos.historico-cotacao')</script>
@stop
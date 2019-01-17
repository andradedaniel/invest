@extends('adminlte::page')

@section('title', 'Invest')

@section('content_header')
    <h1>Operaçoes em Ações e FII</h1>
@stop

@section('content')

{!! Form::open(['route' => 'carteira.nova-operacao1', 'method' => 'post']) !!}
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">Cadastrar Operação</h4>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label>Código do Ativo:</label>
                    {{-- {!!Form::text('beginDate',null,['class'=>'form-control','data-inputmask'=>"'alias': 'dd/mm/yyyy'",'data-mask'=>''])!!} --}}
                    <select class="js-example-basic-single form-control" name="cod_ativo">
                        <option value="">-- Selecione --</option>
                        @foreach ($stocks as $stock)
                            <option value="{{ $stock['ticker'] }}">{{ $stock['ticker'] }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- /.form group -->
                <div class="form-group">
                    <label>Data da Operação:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" name="data_operacao" >
                    </div>
                </div>
                <div class="form-group">
                    <label>Quantidade:</label>
                    <input type="text" class="form-control pull-right" name="quantidade" >
                </div>

                <div class="form-group">
                    <label>Preço:</label>
                    <input type="text" class="form-control pull-right" name="preco_ajuste" >
                </div>
                <!-- /.form group -->  
                {!! Form::button('<i class="fa fa-refresh"></i>&nbsp;&nbsp;&nbsp;Cadastrar',['type' => 'submit','class' => 'btn btn-primary']) !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
{!! Form::close() !!}
@stop


@section('js')
    <script> 
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@stop

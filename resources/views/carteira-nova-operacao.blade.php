@extends('adminlte::page')

@section('title', 'Invest')

@section('content_header')
    <h1>Operaçoes em Ações e FII</h1>
@stop

@section('content')

{!! Form::open() !!}
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
                            
                            <select class="js-example-basic-single form-control" name="state">
                                <option value="">-- Selecione --</option>
                                @foreach ($stocks as $stock)
                                    <option value="{{ $stock['ticker'] }}">{{ $stock['ticker'] }}</option>
                                @endforeach
                                  </select>
                </div>
                <!-- /.form group -->
                <div class="form-group">
                        <label>Data:</label>
                        <div class="input-group">
                            {{-- {!!Form::text('beginDate',null,['class'=>'form-control','data-inputmask'=>"'alias': 'dd/mm/yyyy'",'data-mask'=>''])!!} --}}
                            <input class="form-control pull-right" id="datepicker" type="date">
                        </div>
                        <!-- /.input group -->
                </div>
                <!-- /.form group -->  
                {!! Form::button('<i class="fa fa-refresh"></i>&nbsp;&nbsp;&nbsp;Importar',['type' => 'submit','class' => 'btn btn-primary']) !!}
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

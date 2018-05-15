@extends('adminlte::page')

@section('title', 'Invest')

@section('content_header')
    <h1>Carteira de Ações</h1>
@stop

@section('content')

<?php $options = ['0'=>'opçao 1','1'=>'opçao 2','2'=>'opçao 3']?>

{!! Form::open() !!}
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">Cadastrar Operação em XXXX</h4>
            </div>
            <div class="box-body">
                <div class="form-group">
                        <label>Código do Ativo:</label>
                            {{-- {!!Form::text('beginDate',null,['class'=>'form-control','data-inputmask'=>"'alias': 'dd/mm/yyyy'",'data-mask'=>''])!!} --}}
                            
                            <select class="js-example-basic-single form-control" name="state">
                                @foreach ($options as $id => $option)
                                <?php var_dump($option) ?>
                            <option value="{{ $id }}">{{ $option }}</option>
                                @endforeach
                                  </select>
                </div>
                <!-- /.form group -->
                <div class="form-group">
                        <label>Data:</label>
                        <div class="input-group">
                            {!!Form::text('beginDate',null,['class'=>'form-control','data-inputmask'=>"'alias': 'dd/mm/yyyy'",'data-mask'=>''])!!}
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

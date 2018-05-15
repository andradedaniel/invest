@extends('adminlte::page')

@section('title', 'Invest')

@section('content_header')
    <h1>Carteira de Ações</h1>
@stop

@section('content')
    <p>Ações</p>
    <div class="box-header">
        <h3 class="box-title pull-right">
            <a href="{{ route('carteira-acao.comprar') }}" title="Cadastrar operação de compra de ação" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Comprar</a>
        </h3>
    </div>
<!-- /.box-header -->





@stop

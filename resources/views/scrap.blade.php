@extends('adminlte::page')

@section('title', 'Invest')

@section('content_header')
    <h1>Scrap</h1>
@stop

@section('content')
Data/Hora 	Cotação 	Mínima 	Máxima 	Variação 	Variação (%) 	Volume
    @foreach ($pricesHistory as $priceHistory)
        <p>{{ $priceHistory['date'] }} - 
           {{ $priceHistory['closed'] }} - 
           {{ $priceHistory['min'] }} - 
           {{ $priceHistory['max'] }} - 
           {{ $priceHistory['var'] }} - 
           {{ $priceHistory['varPercent'] }}</p>
    @endforeach
@stop
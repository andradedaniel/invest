var url = "{{route('grafico.historico-cotacao',$ticker)}}";
    $(document).ready(function(){
        $.getJSON(url, function (data) {
            Highcharts.chart('chart_container', {
                chart: {
                    zoomType: 'x'
                },
                title: {
                    text: '{{ $ticker }}'//'USD to EUR exchange rate over time'
                },
                subtitle: {
                    text: document.ontouchstart === undefined ?
                            'Clique e arraste no gráfico para dar zoom' : 'Pinch the chart to zoom in'
                            //'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
                },
                xAxis: {
                    type: 'datetime',
                },
                yAxis: {
                    title: {
                        text: 'Valor R$'
                    }
                },
                tooltip: {
                    xDateFormat: '%d/%m/%Y',  
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    area: {
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        marker: {
                            radius: 2
                        },
                        lineWidth: 1,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        },
                        threshold: null
                    }
                },
                series: [{
                    type: 'area',
                    name: 'R$',
                    data: data
                }]
            });
        });       
    });
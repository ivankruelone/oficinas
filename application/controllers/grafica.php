<?php 

?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Java Smart Home Simulator</title>
  
<!-- Latest compiled and minified CSS -->
</head>
<body>
<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery.js"></script>
    <!-- Importo el archivo Javascript de Highcharts directamente desde su servidor -->
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
 
<div id="container">
</div>
<script type='text/javascript'>
$(function () {
    $(document).ready(function() {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
    
        var chart;
        $('#container').highcharts({
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function() {
                        
                    }
                }
            },
            title: {
                text: 'RENTABILIDAD DE FARMACIAS'
            },
            xAxis: {
                type: 'decimal',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Value'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('$', this.x) +'<br/>'+
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: true
            },
            exporting: {
                enabled: true
            },
            series: [{
                name: 'Rentabilidad',
                data: (function() {
                   var data = [];
                                        data.push([1400976011000,0.000]);
                                        data.push([1400976017000,0.000]);
                                        data.push([1400976018000,0.000]);
                                        data.push([1400976020000,2.625]);
                                        data.push([1400976022000,2.785]);
                                        data.push([1400976024000,3.685]);
                                        data.push([1400979627000,2.785]);
                                        data.push([1400979629000,4.160]);
                                        data.push([1400979633000,4.160]);
                                        data.push([1400981436000,4.160]);
                                        data.push([1400981437000,4.160]);
                                        data.push([1400981440000,4.160]);
                                    return data;
                })()
            },{
                name: 'Rentabilidad 40%',
                     data: (function() {
                        var data = [];
                                        data.push([1400976011000,0.000]);
                                        data.push([1400976017000,0.000]);
                                        data.push([1400976018000,0.000]);
                                        data.push([1400976020000,0.000]);
                                        data.push([1400976022000,0.000]);
                                        data.push([1400976024000,9.500]);
                                        data.push([1400979627000,0.000]);
                                        data.push([1400979629000,0.000]);
                                        data.push([1400979633000,0.000]);
                                        data.push([1400981436000,0.000]);
                                        data.push([1400981437000,0.000]);
                                        data.push([1400981440000,0.000]);
                                    return data;
                     })() 
            }]
        });
    });
    
});
//]]>  
 
</script>
</html>
?>
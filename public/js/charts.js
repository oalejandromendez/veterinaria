var ChartFiltro;
var limite;
var url_base64 = [];

function crearGrafica(canvas = null, tipo, titulo = null,  etiquetas, etiquetasData, data = null) {
    var dynamicColorsArray = function (cantidad) {
        let colors =[];
        for (let i = 0; i < cantidad; i++) {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            colors.push("rgb(" + r + "," + g + "," + b + ")");
        }
        return colors

    };

    var dynamicColors = function () {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgb(" + r + "," + g + "," + b + ")";
    };

    var dataset = [];

    for (let i = 0; i < etiquetasData.length; i++){
        let aux = {};
        aux['label'] = etiquetasData[i];
        aux['data'] = data[i];
        if(tipo != 'line'){
            aux['backgroundColor'] = dynamicColorsArray(data[i].length);
        }
        else{    
            aux['borderColor'] = dynamicColors();
            aux['fill'] = false;
        }
        dataset.push(aux);
    }
    
   
    var jsonChart = {
        type: tipo,
        data: {
            labels: etiquetas,
            datasets: dataset,
        },
        options:{
            title:{
                display:true,
                text: titulo
            },
            animation: {
                onComplete: function (animation) {
                    if(url_base64.length < limite)
                        url_base64.push(this.toBase64Image());
                }
            },

            "scales": { 
            }

        },
    };
    if (tipo == 'bar' || tipo == 'horizontalBar'){
        jsonChart.options.scales = {
            "yAxes": [{
                "ticks": {
                    "beginAtZero": true
                }
            }],
            "xAxes": [{
                "ticks": {
                    "beginAtZero": true
                }
            }]
        };
    }

    var ctx = document.getElementById(canvas).getContext('2d');
    var myChart = new Chart(ctx, jsonChart);
    
    return myChart;
}

function peticionGraficas(ruta) {
     $.ajax({
         url: ruta,
         type: 'GET',
         dataType: 'json',
         success: function (r) {
            $('#graficas').removeClass('hidden');
            ChartFiltro = crearGrafica('decesos', 'bar', 'Numero de Decesos Generales', r.labels_decesos,
                ['Cantidad'], r.data_decesos
            );
         },
         error: function () {
             alert('Ocurrio un error en el servidor ...');
         }
     });
}

function peticionGraficasAltas(ruta) {
    $.ajax({
        url: ruta,
        type: 'GET',
        dataType: 'json',
        success: function (r) {
           $('#graficas').removeClass('hidden');
           ChartFiltro = crearGrafica('altas', 'bar', 'Numero de Altas Generales', r.labels_altas,
               ['Cantidad'], r.data_altas
           );
        },
        error: function () {
            alert('Ocurrio un error en el servidor ...');
        }
    });
}
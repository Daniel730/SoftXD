function initialize(dado, background, labels, tipoVar){    
    if(tipoVar == "nominal"){
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'polarArea',
            data: {
                datasets: [{
                    data: dado,
                    backgroundColor: background
                }],
                labels: labels
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }else if(tipoVar == "ordinal"){
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'polarArea',
            data: {
                datasets: [{
                    data: dado,
                    backgroundColor: background
                }],
                labels: labels
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }else if(tipoVar == "discreta"){
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: '',
                    data: dado,
                    backgroundColor: background
                }]
                
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }else if(tipoVar == "continua"){
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: '',
                    data: dado,
                    backgroundColor: background
                }]
                
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true // Começa no 0
                        }
                    }],
                    xAxes: [{ // Eixo X,configura o espaçamento e o tamanho do gráfico
                      categoryPercentage: 1.0,
                      barPercentage: 1
                  }],
                }
            }
        });
    }
}
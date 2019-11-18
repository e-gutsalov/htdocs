$(document).ready(function() {

    $('.switch-btn').click(function(){
        $(this).toggleClass('switch-on');
    });

    let chart = new Chart($('#canvas'), {
        type: 'line',
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Димамика изменения цены',
                fontSize: 20,
                fontStyle: 'bold'
            },
            legend: {
                position: 'left'
            },
            tooltips: {
                mode: 'nearest',
                intersect: true
            }
        }
    });

    chart.data.labels = ['21.01.19', '22.01.19', '23.01.19', '24.01.19', '25.01.19', '26.01.19', '27.01.19'];
    chart.data.datasets = [
        {
            label: 'LG',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [100, 150, 500, 200, 250, 300, 550],
            fill: false
        },
        {
            label: 'Samsung',
            backgroundColor: 'rgb(192, 192, 192)',
            borderColor: 'rgb(192, 192, 192)',
            data: [1000, 200, 250, 300, 350, 400, 450],
            fill: false
        }
    ];

    chart.data.datasets.push({
        label: 'Sony',
        data: [200, 350, 600, 300, 450, 800, 950],
        backgroundColor: 'rgb(255, 199, 132)',
        borderColor: 'rgb(255, 199, 132)',
        fill: false
    });

    chart.update();

});

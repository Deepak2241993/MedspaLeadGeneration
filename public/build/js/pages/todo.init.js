/*
Template Name: Tocly -  Admin & Dashboard Template
Author: Themesdesign
Contact: themesdesign.in@gmail.com
File: Todo init js
*/

var options = {

    chart: {
    height: 200,
    type: 'bar',
    offsetX: -10,
    toolbar: {
        show: false,
    }
    },
    plotOptions: {
    bar: {
        columnWidth: '25%'
    }
    },
    dataLabels: {
    enabled: false
    },

    fill: {
        opacity: 1,
      },

    series: [{
    name: 'Tasks',
    data: [52, 66, 50, 74, 36, 52, 66]
    }],
    grid: {
        yaxis: {
            lines: {
                show: false,
            }
        }
    },
    yaxis: {
        labels: {
            formatter: function (value) {
                return value + "hrs";
            }
        }
    },
    xaxis: {
        labels: {
            rotate: -90
        },
        categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
    },
    colors: ['#086070'],

    }

    var chart = new ApexCharts(
    document.querySelector("#overview-chart"),
    options
    );

    chart.render();



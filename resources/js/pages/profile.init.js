/*
Template Name: Tocly -  Admin & Dashboard Template
Author: Themesdesign
Contact: themesdesign.in@gmail.com
File: Profile Js File
*/


var options = {

    chart: {
    height: 334,
    type: 'bar',
    toolbar: {
        show: false,
    }
    },
    plotOptions: {
    bar: {
        columnWidth: '20%'
    }
    },
    dataLabels: {
    enabled: false
    },

    fill: {
        opacity: 1,
      },

    series: [{
    name: 'Overview',
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
        },
        title: {
            text: '% (Percentage)'
        }
    },
    xaxis: {
        labels: {
            rotate: -90
        },
        categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    },
    colors: ['#086070'],

    }

    var chart = new ApexCharts(
    document.querySelector("#overview-chart"),
    options
    );

    chart.render();


    

//   Monthly Earning
var options1 = {
    chart: {
      type: 'area',
      height: 214,
      offsetX: -10,
      toolbar: {
        show: false
      },
    },
  
    series: [{
      name: 'Expenses',
      data: [0, 70, 40, 75, 35, 75]
    }, {
      name: 'Income',
      data: [0, 35, 15, 30, 15, 30]
    }
    ],
    stroke: {
      curve: 'straight',
      width: ['2.5', '2.5'],
      dashArray: [0, 5],
    },
    colors: ['#086070','#2651e9'],
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
    },
    legend: {
        show: false,
    },
  
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            inverseColors: false,
            opacityFrom: 0.70,
            opacityTo: 0.01,
            stops: [30, 100, 100, 100]
          },
      },
      dataLabels: {
        enabled: false
      },
    tooltip: {
      fixed: {
        enabled: false
      }
      ,
      x: {
        show: false
      }
      ,
      y: {
        title: {
          formatter: function (seriesName) {
            return ''
          }
        }
      }
      ,
      marker: {
        show: false
      }
    }
  }
  new ApexCharts(document.querySelector("#sales-over"), options1).render();
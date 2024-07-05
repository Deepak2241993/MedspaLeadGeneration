/*
Template Name: Tocly -  Admin & Dashboard Template
Author: Themesdesign
Contact: themesdesign.in@gmail.com
File: Dashboard Init Js File
*/



// column chart

var options = {
  series: [{
  name: 'Net Profit',

  data: [19, 36, 24, 20, 34, 24, 11, 36, 24, 15, 21, 28]
}, {
  name: 'Revenue',
  data: [07, 12, 10, 12, 11, 10, 13, 10, 12, 8, 13, 13]
}],
  chart: {
  type: 'bar',
  height: 350,
  stacked: true,
  toolbar: {
    show: false
  },
  zoom: {
    enabled: true
  }
},

plotOptions: {
  bar: {
    horizontal: false,
    columnWidth: '42%'
  },
},
dataLabels: {
  enabled: false
},

legend: {
 show:false,
},
xaxis: {
  categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Des' ],
},
colors: ['#0c768a', '#daeaee'],
fill: {
  opacity: 1
}
};

var chart = new ApexCharts(document.querySelector("#column-chart"), options);
chart.render();


// donut chart

  var options = {
    series: [40405, 15552, 19824],
    labels: ["Online", "Offline", "Marketing"],
    chart: {
      type: "donut",
      height: 350,
    },

    plotOptions: {
      pie: {
        size: 100,
        offsetX: 0,
        offsetY: 0,
        donut: {
          size: "77%",
          labels: {
            show: true,
            name: {
              show: true,
              fontSize: "18px",
              offsetY: -5,
            },
            value: {
              show: true,
              fontSize: "24px",
              color: "#343a40",
              fontWeight: 500,
              offsetY: 10,
              formatter: function (val) {
                return "$" + val;
              },
            },
            total: {
              show: true,
              fontSize: "16px",
              label: "Total value",
              color: "#9599ad",
              fontWeight: 400,
              formatter: function (w) {
                return (
                  "$" +
                  w.globals.seriesTotals.reduce(function (a, b) {
                    return a + b;
                  }, 0)
                );
              },
            },
          },
        },
      },
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: true,
      position: 'bottom',
    },
    yaxis: {
      labels: {
        formatter: function (value) {
          return "$" + value;
        },
      },
    },
    stroke: {
      lineCap: "round",
      width: 2,
    },
    colors: ['#0c768a', '#38c786', '#daeaee'],
  };
  var chart = new ApexCharts(document.querySelector("#donut-chart"), options);
  chart.render();

  
// world map with line & markers
var worldlinemap = new jsVectorMap({
  map: "world_merc",
  selector: "#world-map-markers",
  zoomOnScroll: false,
  zoomButtons: false,
  markerStyle:{
    initial: { fill: "#0c768a" },
    selected: { fill: "#0c768a" }
  },
  markers: [{
          name: "Greenland",
          coords: [72, -42]
      },
      {
          name: "Canada",
          coords: [56.1304, -106.3468]
      },
      {
          name: "Brazil",
          coords: [-14.2350, -51.9253]
      },
      {
          name: "Egypt",
          coords: [26.8206, 30.8025]
      },
      {
          name: "Russia",
          coords: [61, 105]
      },
      {
          name: "China",
          coords: [35.8617, 104.1954]
      },
      {
          name: "United States",
          coords: [37.0902, -95.7129]
      },
      {
          name: "Norway",
          coords: [60.472024, 8.468946]
      },
      {
          name: "Ukraine",
          coords: [48.379433, 31.16558]
      },
  ],
  lines: [{
          from: "Canada",
          to: "Egypt"
      },
      {
          from: "Russia",
          to: "Egypt"
      },
      {
          from: "Greenland",
          to: "Egypt"
      },
      {
          from: "Brazil",
          to: "Egypt"
      },
      {
          from: "United States",
          to: "Egypt"
      },
      {
          from: "China",
          to: "Egypt"
      },
      {
          from: "Norway",
          to: "Egypt"
      },
      {
          from: "Ukraine",
          to: "Egypt"
      },
  ],
  regionStyle: {
      initial: {
          stroke: "#daeaee",
          strokeWidth: 0.25,
          fill: "#daeaee",
          fillOpacity: 1,
      },
  },
  lineStyle: {
      animation: true,
      strokeDasharray: "6 3 6",
  },
})



// radialBar
var options = {
  labels: ["E-Commerce", "Facebook", "Instagram"],
  series: [38, 24, 16],
  chart: {
      height: 402,
  type: 'donut',
},
plotOptions: {
  pie: {
    startAngle: -90,
    endAngle: 90,
    offsetY: 10,
    donut: {
      size: '80%',
    },
  }
},
colors: ['#0c768a', '#38c786', '#daeaee'],
grid: {
  padding: {
    bottom: -190
  }
},

legend: {
  show: false,
},

responsive: [{
  breakpoint: 320,
  options: {
    chart: {
      width: 180
    },
    legend: {
      position: 'bottom'
    }
  }
}]
};

var chart = new ApexCharts(document.querySelector("#social-source"), options);
chart.render();
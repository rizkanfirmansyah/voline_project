$(document).ready(function() {
    vaksinasi()
    status()
})

function vaksinasi(id = 'DAY') {
    $.ajax({
        url:'/api/v1/dashboard/index/get/pattient',
        data:{
            id :id,
        },
        success:res=>{
            lineChart({data:res.values.value, label:res.values.parm})
        },
        error:err=>console.log(err)
    })
}

function status() {
    $.ajax({
        url:'/api/v1/dashboard/index/get/status',
        success:res=>{
            chartBar({data:res.values.value, label:res.values.parm})
        },
        error:err=>console.log(err)
    })
}

function lineChart (values) {
    var chart = $('#chart-sales-dark');

    function init(chart) {

      var lineChart = new Chart(chart, {
        type: 'line',
        options: {
          scales: {
            yAxes: [{
              gridLines: {
                lineWidth: 1,
                color: Charts.colors.gray[900],
                zeroLineColor: Charts.colors.gray[900]
              },
              ticks: {
                beginAtZero:true
              }
            }]
          },
        },
        data: {
          labels: values.label,
          datasets: [{
            label: 'Performance',
            data: values.data
          }]
        }
      });

      chart.data('chart', lineChart);

    };


    // Events

    if (chart.length) {
      init(chart);
    }

}

function chartBar(value) {
        var $chart = $('#chart-bars');
        function initChart($chart) {
            var ordersChart = new Chart($chart, {
                type: 'bar',
                data: {
                    labels:value.label,
                    datasets: [{
                        label: 'Status',
                        data: value.data,
                        backgroundColor:[
                            'rgb(45,206,168)',
                        ]
                    }],
                }
            });
            $chart.data('chart', ordersChart);
        }


        // Init chart
        if ($chart.length) {
            initChart($chart);
        }


}

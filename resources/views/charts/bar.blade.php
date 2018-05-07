<script>

// -- Bar Chart Example
var bar = {!! json_encode(($chart)) !!}
// console.log(bar);
var ctx = document.getElementById(bar.id);
var myBarChart = new Chart(ctx, {
  type: bar.type,
  data: {
    labels: bar.labels,
    datasets: bar.datasets,
    //must be an array
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: bar.unit
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {

          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

</script>

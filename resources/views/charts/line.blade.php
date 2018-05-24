
<script>

var line = {!! json_encode($chart) !!}
console.log(line)
var ctx = document.getElementById(line.id);
var myLineChart = new Chart(ctx, {
  type: line.type,
  data: {
      labels: line.labels,
      datasets: line.datasets,

    },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: line.unit
        },
        gridLines: {
          display: false
        },
         ticks: {
            stepSize: 1,
            min: 0,
            autoSkip: false
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 0,

          autoSkip: false
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});




</script>

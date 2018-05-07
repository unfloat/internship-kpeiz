
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
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5
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

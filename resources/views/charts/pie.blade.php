<script>
var pie = {!! json_encode($chart) !!}
var ctx = document.getElementById(pie.id);
// console.log(pie + " " + pie.id);
var myPieChart = new Chart(ctx, {
  type: pie.type,
  data: {
    labels: pie.labels,
    datasets: [{
      data: pie.datasets.data,
      backgroundColor: pie.datasets.backgroundColor,
    }],
  },
});

</script>


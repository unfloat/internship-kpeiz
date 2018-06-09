
<script>

var cumulativeLine = {!! json_encode($chart) !!}

    var nvddata2 = [
    {
        "key": "Series 1",
        "color": '#0066CC',
        "values": [ [ 1025409600000 , 0] , [ 1028088000000 , -6.3382185140371] , [ 1030766400000 , -5.9507873460847] , [ 1033358400000 , -11.569146943813] , ]
    },
    {
        "key": "Series 2",
        "color": '#ff9800',
        "values": [ [ 1025409600000 , 0] , [ 1028088000000 , 0] , [ 1030766400000 , 0] , [ 1033358400000 , 0]]
    },
    {
        "key": "Series 3",
        "color": '#33AC71',
        "values": [ [ 1025409600000 , 0] , [ 1028088000000 , -6.3382185140371] , [ 1030766400000 , -5.9507873460847] , [ 1033358400000 , -11.569146943813] ]
    },
    {
        "key": "Series 4",
        "color": '#EC5E69',
        "values": [ [ 1025409600000 , -7.0674410638835] , [ 1028088000000 , -14.663359292964] , [ 1030766400000 , -14.104393060540] , [ 1033358400000 , -23.114477037218] ]
    }
    ];

    nv.addGraph(function() {
        var chart = nv.models.cumulativeLineChart()
        .x(function(d) { return d[0] })
        //adjusting, 100% is 1.00, not 100 as it is in the data
        .y(function(d) { return d[1] / 100 })
        .color(d3.scale.category10().range())
        .useInteractiveGuideline(true)
        ;

        chart.xAxis
        .tickFormat(function(d) {
            return d3.time.format('%x')(new Date(d))
        });

        chart.yAxis.tickFormat(d3.format(',.1%'));

        d3.select('#nvd2 svg')
        .datum(nvddata2)
        .transition().duration(500)
        .call(chart)
        ;

        nv.utils.windowResize(chart.update);

        return chart;
    });



</script>

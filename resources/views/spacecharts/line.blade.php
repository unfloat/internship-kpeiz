
<script>

var spaceline = {!! json_encode($chart) !!}

    var nvddata1 = function() {
     return [
        {
            values: spaceline.sinvalues,
            key: spaceline.sinlabel,
            color: '#EC5E69'
        },
        {
            values: spaceline.cos,
            key: spaceline.coskey,
            color: '#0066CC'
        }
        ];
        /*for (var i = 0; i < 100; i++) {
            sin.push({x: i, y: Math.sin(i/10)});
            cos.push({x: i, y: .5 * Math.cos(i/10)});
        }*/


    };
    nv.addGraph(function() {
        var chart = nv.models.lineChart()
        .useInteractiveGuideline(true)
        ;

        chart.xAxis
        .axisLabel('Time (ms)')
        .tickFormat(d3.format(',r'))
        ;

        chart.yAxis
        .axisLabel('Voltage (v)')
        .tickFormat(d3.format('.02f'))
        ;

        d3.select('#nvd1 svg')
        .datum(nvddata1())
        .transition().duration(500)
        .call(chart)
        ;

        nv.utils.windowResize(chart.update);

        return chart;
    });


</script>

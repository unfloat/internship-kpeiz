<script>

var stackedArea = {!! json_encode($chart) !!}
 var nvddata4 = [
    {
        "key" : "North America" ,
        "color": '#0066CC',
        "values" : [ [ 1025409600000 , 23.041422681023] , [ 1028088000000 , 19.854291255832] , [ 1030766400000 , 21.02286281168] , [ 1033358400000 , 22.093608385173] ]
    },
    {
        "key" : "Africa" ,
        "color": '#5893DF',
        "values" : [ [ 1025409600000 , 7.9356392949025] , [ 1028088000000 , 7.4514668527298] , [ 1030766400000 , 7.9085410566608] , [ 1033358400000 , 5.8996782364764] ]
    },
    {
        "key" : "South America" ,
        "color": '#ff9800',
        "values" : [ [ 1025409600000 , 7.9149900245423] , [ 1028088000000 , 7.0899888751059] , [ 1030766400000 , 7.5996132380614] , [ 1033358400000 , 8.2741174301034] ]
    },
    {
        "key" : "Asia" ,
        "color": '#ffd180',
        "values" : [ [ 1025409600000 , 13.153938631352] , [ 1028088000000 , 12.456410521864] , [ 1030766400000 , 12.537048663919] , [ 1033358400000 , 13.947386398309] ]
    },
    {
        "key" : "Europe" ,
        "color": '#63CB89',
        "values" : [ [ 1025409600000 , 9.3433263069351] , [ 1028088000000 , 8.4583069475546] , [ 1030766400000 , 8.0342398154196] , [ 1033358400000 , 8.1538966876572] ]
    },
    {
        "key" : "Australia" ,
        "color": '#b9f6ca',
        "values" : [ [ 1025409600000 , 5.1162447683392] , [ 1028088000000 , 4.2022848306513] , [ 1030766400000 , 4.3543715758736] , [ 1033358400000 , 5.4641223667245] ]
    },
    {
        "key" : "Antarctica" ,
        "color": '#EC5E69',
        "values" : [ [ 1025409600000 , 1.3503144674343] , [ 1028088000000 , 1.2232741112434] , [ 1030766400000 , 1.3930470790784] , [ 1033358400000 , 1.2631275030593] ]
    }
    ];

    nv.addGraph(function() {
        var chart = nv.models.stackedAreaChart()
        .x(function(d) { return d[0] })
        .y(function(d) { return d[1] })
        .clipEdge(true)
        .useInteractiveGuideline(true)
        ;

        chart.xAxis
        .showMaxMin(false)
        .tickFormat(function(d) { return d3.time.format('%x')(new Date(d)) });

        chart.yAxis
        .tickFormat(d3.format(',.2f'));

        d3.select('#nvd4 svg')
        .datum(nvddata4)
        .transition().duration(500).call(chart);
        nv.utils.windowResize(chart.update);
        return chart;
    });





</script>

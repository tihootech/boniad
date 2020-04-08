<script type="text/javascript">
    var data = {
        labels: ["4 روز پیش", "3 روز ئیش", "پریروز", "دیروز", "امروز"],
        datasets: [
            {
                label: "بازدید ها",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [280, 480, 400, 190, 860]
            }
        ]
    };
    var pdata = [
        {
            value: 300,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "رزرو های تایید شده"
        },
        {
            value: 50,
            color:"#F7464A",
            highlight: "#FF5A5E",
            label: "رزرو های معلق"
        }
    ]

    var ctxl = $("#lineChartDemo").get(0).getContext("2d");
    var lineChart = new Chart(ctxl).Line(data);

    var ctxp = $("#pieChartDemo").get(0).getContext("2d");
    var pieChart = new Chart(ctxp).Pie(pdata);
</script>



<div class="col-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Monthly Incidents Comparison Chart </h5>
        </div>
        <div class="card-body">
            <div class="chart">
                <div id="m-incidents-chart"></div>
            </div>
        </div>
    </div>
</div>


@push('monthly-incidents-js')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Column chart
        var options = {
            chart: {
                height: 350,
                type: "bar",
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    endingShape: "rounded",
                    columnWidth: "55%",
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"]
            },
            series: [{
                name: '{{ $lastYear }}',
                data: {{ json_encode($previousYear) }}
            }, {
                name: '{{ $thisYear }}',
                data: {{ json_encode($currentYear) }}
            }],
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            },
            yaxis: {
                title: {
                    text: "Total Incidents"
                }
            },
            fill: {
                opacity: 2,
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "total: " + val
                    }
                }
            }
        }
        var chart = new ApexCharts(
        document.querySelector("#m-incidents-chart"),
        options
        );
        chart.render();
    });
</script>


@endpush

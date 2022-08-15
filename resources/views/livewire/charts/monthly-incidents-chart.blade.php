

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
                data:[
                ' {{ $previousYear[0] }} ', ' {{ $previousYear[1] }} ', ' {{ $previousYear[2] }} ', ' {{ $previousYear[3] }} ', ' {{ $previousYear[4] }} ', ' {{ $previousYear[5] }} ',
                ' {{ $previousYear[6] }} ',' {{ $previousYear[7] }} ', ' {{ $previousYear[8] }} ', ' {{ $previousYear[9] }} ', ' {{ $previousYear[10] }} ', ' {{ $previousYear[11] }} '
                ]
            }, {
                name: '{{ $thisYear }}',
                data:[
                ' {{ $currentYear[0] }} ', ' {{ $currentYear[1] }} ', ' {{ $currentYear[2] }} ', ' {{ $currentYear[3] }} ', ' {{ $currentYear[4] }} ', ' {{ $currentYear[5] }} ',
                ' {{ $currentYear[6] }} ',' {{ $currentYear[7] }} ', ' {{ $currentYear[8] }} ', ' {{ $currentYear[9] }} ', ' {{ $currentYear[10] }} ', ' {{ $currentYear[11] }} '
                ]
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
                opacity: 2
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

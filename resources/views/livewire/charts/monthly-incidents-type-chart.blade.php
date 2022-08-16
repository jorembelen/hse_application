
<div class="col-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">Monthly Incident Type Chart for the Year {{ now()->format('Y') }} </h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="chart">
                <div id="inc-types-chart"></div>
            </div>
        </div>
    </div>
</div>


@push('inc-type-js')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Line chart
        var options = {
            chart: {
                height: 350,
                type: "line",
                zoom: {
                    enabled: false
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: [5, 7, 5],
                curve: "straight",
                dashArray: [0, 8, 5]
            },
            series: [{
                name: "Fatality",
                data: {{ json_encode($fatality) }}
            },
            {
                name: "Lost Time Injury",
                data: {{ json_encode($lostInjury) }}
            },
            {
                name: "Dangerous Occurence",
                data: {{ json_encode($dangerousOccurence) }}
            },
            {
                name: "First Aid",
                data: {{ json_encode($firstAid) }}
            },
            {
                name: "Property Damage",
                data: {{ json_encode($propertyDamage) }}
            },
            {
                name: "MTC",
                data: {{ json_encode($mtc) }}
            },
            {
                name: "RWC",
                data: {{ json_encode($rwc) }}
            },
            {
                name: "MVI",
                data: {{ json_encode($mvi) }}
            },
            {
                name: "Near Miss",
                data: {{ json_encode($nearMiss) }}
            }
            ],
            markers: {
                size: 0,
                style: "hollow", // full, hollow, inverted
            },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            },
            tooltip: {
                y: [{
                    title: {
                        formatter: function(val) {
                            return val
                        }
                    }
                }, {
                    title: {
                        formatter: function(val) {
                            return val
                        }
                    }
                }, {
                    title: {
                        formatter: function(val) {
                            return val;
                        }
                    }
                }]
            },
            grid: {
                borderColor: "#f1f1f1",
            }
        }

        var chart = new ApexCharts(
        document.querySelector("#inc-types-chart"),
        options
        );
        chart.render();

    });
</script>

@endpush

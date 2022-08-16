
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

{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Line chart
        new Chart(document.getElementById("inc-types-chart"), {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Fatality",
                    fill: true,
                    backgroundColor: "transparent",
                    borderColor: window.theme.info,
                    data: {{ json_encode($fatality) }}
                }, {
                    label: "Lost Injury",
                    fill: true,
                    backgroundColor: "transparent",
                    borderColor: window.theme.success,
                    data: {{ json_encode($lostInjury) }}
                }, {
                    label: "Dangerous Occurence",
                    fill: true,
                    backgroundColor: "transparent",
                    borderColor: window.theme.primary,
                    data: {{ json_encode($dangerousOccurence) }}
                }, {
                    label: "Property Damage",
                    fill: true,
                    backgroundColor: "transparent",
                    borderColor: window.theme.primary,
                    data: {{ json_encode($propertyDamage) }}
                }, {
                    label: "First Aid",
                    fill: true,
                    backgroundColor: "transparent",
                    borderColor: window.theme.danger,
                    borderDash: [4, 4],
                    data: {{ json_encode($firstAid) }}
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    intersect: false
                },
                hover: {
                    intersect: true
                },
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                scales: {
                    xAxes: [{
                        reverse: true,
                        gridLines: {
                            color: "rgba(0,0,0,0.05)"
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 500
                        },
                        display: true,
                        borderDash: [5, 5],
                        gridLines: {
                            color: "rgba(0,0,0,0)",
                            fontColor: "#fff"
                        }
                    }]
                }
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        window.addEventListener('reApplyChart',  event => {
            new Chart(document.getElementById("filtered-chart"), {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Property Damage",
                    fill: true,
                    backgroundColor: "transparent",
                    borderColor: window.theme.primary,
                    data: {{ json_encode($propertyDamage) }}
                }, {
                    label: "First Aid Two",
                    fill: true,
                    backgroundColor: "transparent",
                    borderColor: window.theme["danger"],
                    borderDash: [4, 4],
                    data: {{ json_encode($firstAidTwo) }}
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    intersect: false
                },
                hover: {
                    intersect: true
                },
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                scales: {
                    xAxes: [{
                        reverse: true,
                        gridLines: {
                            color: "rgba(0,0,0,0.05)"
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 500
                        },
                        display: true,
                        borderDash: [5, 5],
                        gridLines: {
                            color: "rgba(0,0,0,0)",
                            fontColor: "#fff"
                        }
                    }]
                }
            }
        });
        });
    });
</script> --}}

@endpush

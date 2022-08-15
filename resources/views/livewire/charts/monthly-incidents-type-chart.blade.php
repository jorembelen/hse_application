
<div class="col-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Monthly Incident Type Chart for the Year {{ now()->format('Y') }}</h5>
        </div>
        <div class="card-body">
            <div class="chart">
                <div id="apexcharts-line"></div>
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
                    data:[
                    ' {{ $fatality[0] }} ', ' {{ $fatality[1] }} ', ' {{ $fatality[2] }} ', ' {{ $fatality[3] }} ', ' {{ $fatality[4] }} ', ' {{ $fatality[5] }} ',
                    ' {{ $fatality[6] }} ',' {{ $fatality[7] }} ', ' {{ $fatality[8] }} ', ' {{ $fatality[9] }} ', ' {{ $fatality[10] }} ', ' {{ $fatality[11] }} '
                    ]
                },
                {
                    name: "Lost Time Injury",
                    data:[
                    ' {{ $lostInjury[0] }} ', ' {{ $lostInjury[1] }} ', ' {{ $lostInjury[2] }} ', ' {{ $lostInjury[3] }} ', ' {{ $lostInjury[4] }} ', ' {{ $lostInjury[5] }} ',
                    ' {{ $lostInjury[6] }} ',' {{ $lostInjury[7] }} ', ' {{ $lostInjury[8] }} ', ' {{ $lostInjury[9] }} ', ' {{ $lostInjury[10] }} ', ' {{ $lostInjury[11] }} '
                    ]
                },
                {
                    name: "Dangerous Occurence",
                    data:[
                    ' {{ $dangerousOccurence[0] }} ', ' {{ $dangerousOccurence[1] }} ', ' {{ $dangerousOccurence[2] }} ', ' {{ $dangerousOccurence[3] }} ', ' {{ $dangerousOccurence[4] }} ', ' {{ $dangerousOccurence[5] }} ',
                    ' {{ $dangerousOccurence[6] }} ',' {{ $dangerousOccurence[7] }} ', ' {{ $dangerousOccurence[8] }} ', ' {{ $dangerousOccurence[9] }} ', ' {{ $dangerousOccurence[10] }} ', ' {{ $dangerousOccurence[11] }} '
                    ]
                },
                {
                    name: "First Aid",
                    data:[
                    ' {{ $firstAid[0] }} ', ' {{ $firstAid[1] }} ', ' {{ $firstAid[2] }} ', ' {{ $firstAid[3] }} ', ' {{ $firstAid[4] }} ', ' {{ $firstAid[5] }} ',
                    ' {{ $firstAid[6] }} ',' {{ $firstAid[7] }} ', ' {{ $firstAid[8] }} ', ' {{ $firstAid[9] }} ', ' {{ $firstAid[10] }} ', ' {{ $firstAid[11] }} '
                    ]
                },
                {
                    name: "Property Damage",
                    data:[
                    ' {{ $propertyDamage[0] }} ', ' {{ $propertyDamage[1] }} ', ' {{ $propertyDamage[2] }} ', ' {{ $propertyDamage[3] }} ', ' {{ $propertyDamage[4] }} ', ' {{ $propertyDamage[5] }} ',
                    ' {{ $propertyDamage[6] }} ',' {{ $propertyDamage[7] }} ', ' {{ $propertyDamage[8] }} ', ' {{ $propertyDamage[9] }} ', ' {{ $propertyDamage[10] }} ', ' {{ $propertyDamage[11] }} '
                    ]
                },
                {
                    name: "MTC",
                    data:[
                    ' {{ $mtc[0] }} ', ' {{ $mtc[1] }} ', ' {{ $mtc[2] }} ', ' {{ $mtc[3] }} ', ' {{ $mtc[4] }} ', ' {{ $mtc[5] }} ',
                    ' {{ $mtc[6] }} ',' {{ $mtc[7] }} ', ' {{ $mtc[8] }} ', ' {{ $mtc[9] }} ', ' {{ $mtc[10] }} ', ' {{ $mtc[11] }} '
                    ]
                },
                {
                    name: "RWC",
                    data:[
                    ' {{ $rwc[0] }} ', ' {{ $rwc[1] }} ', ' {{ $rwc[2] }} ', ' {{ $rwc[3] }} ', ' {{ $rwc[4] }} ', ' {{ $rwc[5] }} ',
                    ' {{ $rwc[6] }} ',' {{ $rwc[7] }} ', ' {{ $rwc[8] }} ', ' {{ $rwc[9] }} ', ' {{ $rwc[10] }} ', ' {{ $rwc[11] }} '
                    ]
                },
                {
                    name: "MVI",
                    data:[
                    ' {{ $mvi[0] }} ', ' {{ $mvi[1] }} ', ' {{ $mvi[2] }} ', ' {{ $mvi[3] }} ', ' {{ $mvi[4] }} ', ' {{ $mvi[5] }} ',
                    ' {{ $mvi[6] }} ',' {{ $mvi[7] }} ', ' {{ $mvi[8] }} ', ' {{ $mvi[9] }} ', ' {{ $mvi[10] }} ', ' {{ $mvi[11] }} '
                    ]
                },
                {
                    name: "Near Miss",
                    data:[
                    ' {{ $nearMiss[0] }} ', ' {{ $nearMiss[1] }} ', ' {{ $nearMiss[2] }} ', ' {{ $nearMiss[3] }} ', ' {{ $nearMiss[4] }} ', ' {{ $nearMiss[5] }} ',
                    ' {{ $nearMiss[6] }} ',' {{ $nearMiss[7] }} ', ' {{ $nearMiss[8] }} ', ' {{ $nearMiss[9] }} ', ' {{ $nearMiss[10] }} ', ' {{ $nearMiss[11] }} '
                    ]
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
            document.querySelector("#apexcharts-line"),
            options
        );
        chart.render();
    });
</script>

@endpush

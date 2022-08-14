

    	<div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Root Cause</h5>
                    <table class="table mb-0 table-responsive">
                        <thead>
                            <tr>
                                <td style="font-size: 12px;"><i class="fas fa-square-full text-primary"></i> People: {{$cause[0]}}</td>
                                <td style="font-size: 12px;"><i class="fas fa-square-full text-warning"></i> Process & Procedure: {{$cause[1]}}</td>
                                <td style="font-size: 12px;"><i class="fas fa-square-full text-danger"></i> Equipment: {{$cause[2]}}</td>
                                <td style="font-size: 12px;"><i class="fas fa-square-full text-success"></i> Workplace: {{$cause[3]}}</td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="chartjs-pie"></canvas>
                    </div>
                </div>
            </div>
        </div>

    	<div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Incident Type - WPS</h5>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div id="wps-chart"></div>
                    </div>
                </div>
            </div>
        </div>


@push('wps-js')

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
                name: "WPS-3",
                data: [
                '{{ $fatality[0] }}', '{{ $lostTimeInjury[0] }}', '{{ $dangerousOccurence[0] }}', '{{ $firstAid[0] }}', '{{ $propertyDamage[0] }}', '{{ $mtc[0] }}', '{{ $rwc[0] }}', '{{ $mvi[0] }}', '{{ $nearMiss[0] }}'
                ]
            }, {
                name: "WPS-4",
                data: [
                '{{ $fatality[1] }}', '{{ $lostTimeInjury[1] }}', '{{ $dangerousOccurence[1] }}','{{ $firstAid[1] }}', '{{ $propertyDamage[1] }}', '{{ $mtc[1] }}', '{{ $rwc[1] }}', '{{ $mvi[1] }}', '{{ $nearMiss[1] }}'
                ]
            }, {
                name: "WPS-5",
                data: [
                '{{ $fatality[2] }}', '{{ $lostTimeInjury[2] }}', '{{ $dangerousOccurence[2] }}', '{{ $firstAid[2] }}', '{{ $propertyDamage[2] }}', '{{ $mtc[2] }}', '{{ $rwc[2] }}', '{{ $mvi[2] }}', '{{ $nearMiss[2] }}'
                ]
            }],
            xaxis: {
                categories: [
                'Fatality', 'Lost Time Injury', 'Dangerous Occurence', 'First Aid', 'Property Damage',
                'MTC', 'RWC', 'MVI', 'Near Miss'
                ],
            },
            yaxis: {
                title: {
                    text: " Number of Incidents"
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " - incident(s)"
                    }
                }
            }
        }
        var chart = new ApexCharts(
        document.querySelector("#wps-chart"),
        options
        );
        chart.render();
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pie chart
        new Chart(document.getElementById("chartjs-pie"), {
            type: "pie",
            data: {
                labels: [
                    'People', 'Process & Procedure', 'Equipment', 'Workplace'
                ],
                datasets: [{
                    data: [
                        '{{$cause[0]}}', '{{$cause[1]}}', '{{$cause[2]}}', '{{$cause[3]}}'
                    ],
                    backgroundColor: [
                        window.theme.primary,
                        window.theme.warning,
                        window.theme.danger,
                        window.theme.success
                        // "#f77eb9"
                    ],
                    borderColor: "transparent"
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                }
            }
        });
    });
</script>

@endpush

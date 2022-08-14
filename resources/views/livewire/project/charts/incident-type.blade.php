

    	<div class="col-12 col-lg-6">
            <div class="card ">
                <div class="card-header">
                    <h5 class="card-title">Incident Type</h5>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div id="incidents-chart"></div>
                    </div>
                </div>
            </div>
        </div>






@push('incident-chart-js')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var sBar = {
            chart: {
                height: 350,
                type: 'bar',
                toolbar: {
                    show: false,
                }
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                name: "Total ",
                data: ['{{$data[0]}}', '{{$data[1]}}', '{{$data[2]}}', '{{$data[3]}}', '{{$data[4]}}', '{{$data[5]}}', '{{$data[6]}}', '{{$data[7]}}', '{{$data[8]}}']
            }],
            xaxis: {
                categories: [
                'Fatality', 'Lost Time Injury', 'Dangerous Occurence', 'First Aid', 'Property Damage',
                'MTC', 'RWC', 'MVI', 'Near Miss'
                ],
            },
            yaxis: {
                title: {
                    text: ""
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
        document.querySelector("#incidents-chart"),
        sBar
        );

        chart.render();
    });
</script>

@endpush

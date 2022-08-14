
       	<div class="col-12 col-lg-6">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Awaiting Notifications</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat stat-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up-right align-middle"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                            </div>
                        </div>
                    </div>
                    <span class="h1 d-inline-block mt-1 mb-4">{{ $pendingNotifications }}</span>
                    <div class="mb-0">
                        @if($pendingNotifications === 0)
                        <p class="task-hight-priority"><span>No Pending!</span></p>
                        @else
                        <a href="{{ route('admin.pending-incidents') }}"><p class="mb-2">View Details </p></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
       	<div class="col-12 col-lg-6">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">On-Going Recommendations</h5>
                        </div>

                        <div class="col-auto">
                            <div class="stat stat-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle align-middle mr-2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            </div>
                        </div>
                    </div>
                    <span class="h1 d-inline-block mt-1 mb-4">{{ $pendingRecommendations }}</span>
                    <div class="mb-0">
                        @if($pendingRecommendations === 0)
                        <p class="task-hight-priority"><span>No Pending!</span></p>
                        @else
                        <a href="{{ route('admin.pending-recommendation') }}"><p class="mb-2">View Details</p></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

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

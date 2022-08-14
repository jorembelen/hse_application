
    <div class="col-12 col-lg-6">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Notifications</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat stat-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up-right align-middle"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                        </div>
                    </div>
                </div>
                <span class="h1 d-inline-block mt-1 mb-4">{{$awaiting}}</span>
                <div class="mb-0">
                    @if($awaiting != '0')
                    <a href="{{ route('project.pending-incidents') }}"><p class="mb-2">View Details</p></a>
                    @else
                    <p class="task-hight-priority"><span>No Pending!</span></p>
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
                        <h5 class="card-title">Recommendations</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat stat-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle align-middle mr-2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        </div>
                    </div>
                </div>
                <span class="h1 d-inline-block mt-1 mb-4">{{$recommendation}}</span>
                <div class="mb-0">
                    @if($recommendation != '0')
                    <a href="{{ route('project.pending-recommendations') }}"><p class="mb-2">View Details</p></a>
                    @else
                    <p class="task-hight-priority"><span>No Pending!</span></p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @livewire('project.charts.incident-type')
    @livewire('project.charts.incident-type-wps')




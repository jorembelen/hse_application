
<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/">
            <span class="align-middle mr-3">HSE APP</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                {{ auth()->user()->userRole() }}
            </li>
            <li class="sidebar-item {{ (request()->segment(1) == '') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="sidebar-link">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            @if(auth()->user()->role == 'admin' || auth()->user()->role == 'manager' || auth()->user()->role == 'super_admin'
            || auth()->user()->role == 'member' || auth()->user()->role == 'hsem')
            <li class="sidebar-item">
                <a href="#projects" data-toggle="collapse" class="sidebar-link {{ (in_array(request()->segment(1), ['admin-incident-notifications', 'admin-incident-investigation', 'recommendations'])) ? 'active' : '' }}">
                    <i class="align-middle" data-feather="slack"></i> <span class="align-middle">Incidents</span>
                </a>
                <ul id="projects" class="sidebar-dropdown list-unstyled collapse {{ (in_array(request()->segment(1), ['admin-incident-notifications', 'admin-incident-investigation', 'recommendations'])) ? 'show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ (request()->segment(1) == 'admin-incident-notifications') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.incidents') }}">Notifications</a></li>
                    <li class="sidebar-item {{ (request()->segment(1) == 'admin-incident-investigation') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.investigation') }}">Investigations</a></li>
                    <li class="sidebar-item {{ (request()->segment(1) == 'recommendations') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.recommendation') }}">Recommendations</a></li>
                </ul>
            </li>
            @endif
            @if (auth()->user()->role == 'gm')
            <li class="sidebar-item {{ (in_array(request()->segment(1), ['incidents-list', 'investigations', 'recommendations'])) ? 'active' : '' }}">
                <a href="#projects" data-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="slack"></i> <span class="align-middle">Incidents</span>
                </a>
                <ul id="projects" class="sidebar-dropdown list-unstyled collapse {{ (in_array(request()->segment(1), ['incidents-list', 'investigations-list', 'recommendations'])) ? 'show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ (request()->segment(1) == 'incidents-list') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('incidents') }}">Notifications</a></li>
                    <li class="sidebar-item {{ (request()->segment(1) == 'investigations-list') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('investigations') }}">Investigations</a></li>
                    <li class="sidebar-item {{ (request()->segment(1) == 'recommendations') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.recommendation') }}">Recommendations</a></li>
                </ul>
            </li>
            @endif
            @if(auth()->user()->role == 'user' || auth()->user()->role == 'site_member')
            <li class="sidebar-item">
                <a href="#projects" data-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="slack"></i> <span class="align-middle">Incidents</span>
                </a>
                <ul id="projects" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                    <a class="sidebar-link" href="/incidents#!"> Notification</a>
                    <a class="sidebar-link" href="{{ route('admin.investigation') }}"> Investigation</a>
                </ul>
            </li>
            @endif
            @if(auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin' || auth()->user()->role == 'gm' || auth()->user()->role == 'hsem')
            <li class="sidebar-item {{ (request()->segment(1) == 'reviews') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('reviews') }}">
                    <i class="align-middle" data-feather="feather"></i> <span class="align-middle">Reviews</span>
                </a>
            </li>
            @endif
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out align-middle mr-2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    Logout</span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
            </li>
        </ul>

    </div>
</nav>

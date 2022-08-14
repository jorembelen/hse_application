<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/">
            <span class="align-middle mr-3">HSE APP</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>
            <li class="sidebar-item {{ (request()->segment(1) == '') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="sidebar-link">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            @if(auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin')
                @include('layouts.includes.sidebar.admin')
            @endif

            @if(auth()->user()->role == 'user' || auth()->user()->role == 'site_member')
                @include('layouts.includes.sidebar.project')
            @endif

            @if (auth()->user()->role == 'gm' || auth()->user()->role == 'member' || auth()->user()->role == 'hsem' || auth()->user()->role == 'hse-member')
                @include('layouts.includes.sidebar.manager')
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

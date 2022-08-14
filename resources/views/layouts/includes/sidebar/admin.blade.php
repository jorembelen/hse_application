
         <li class="sidebar-item {{ (in_array(request()->segment(1), ['admin-locations', 'admin-employees', 'admin-users'])) ? 'active' : '' }}">
            <a href="#management" data-toggle="collapse" class="sidebar-link">
                <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Site Management</span>
            </a>
            <ul id="management" class="sidebar-dropdown list-unstyled collapse {{ (in_array(request()->segment(1), ['admin-locations', 'admin-employees', 'admin-users'])) ? 'show' : '' }}" data-parent="#sidebar">
                <li class="sidebar-item {{ (in_array(request()->segment(1), ['admin-locations'])) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.locations') }}"> Locations</a></li>
                <li class="sidebar-item {{ (in_array(request()->segment(1), ['admin-employees'])) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.employees') }}"> Employees</a></li>
                <li class="sidebar-item {{ (in_array(request()->segment(1), ['admin-users'])) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.users') }}"> Users</a></li>
            </ul>
        </li>

            <li class="sidebar-item {{ (in_array(request()->segment(1), ['admin-incident-notifications', 'admin-incident-investigation', 'recommendations'])) ? 'active' : '' }}">
                <a href="#projects" data-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="slack"></i> <span class="align-middle">Incidents</span>
                </a>
                <ul id="projects" class="sidebar-dropdown list-unstyled collapse {{ (in_array(request()->segment(1), ['admin-incident-notifications', 'admin-incident-investigation', 'recommendations'])) ? 'show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ (request()->segment(1) == 'admin-incident-notifications') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.incidents') }}">Notifications</a></li>
                    <li class="sidebar-item {{ (request()->segment(1) == 'admin-incident-investigation') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.investigation') }}">Investigations</a></li>
                    <li class="sidebar-item {{ (request()->segment(1) == 'recommendations') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin.recommendation') }}">Recommendations</a></li>
                </ul>
            </li>
            <li class="sidebar-item {{ (request()->segment(1) == 'reviews') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('reviews') }}">
                    <i class="align-middle" data-feather="feather"></i> <span class="align-middle">Reviews</span>
                </a>
            </li>

            @if (auth()->user()->role === 'super_admin')
            <li class="sidebar-item {{ (request()->segment(1) == 'admin-users-session') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.users-session') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Users Session</span>
                </a>
            </li>
            @endif

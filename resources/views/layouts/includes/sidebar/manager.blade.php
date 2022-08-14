
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
        <li class="sidebar-item {{ (request()->segment(1) == 'reviews') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('reviews') }}">
                <i class="align-middle" data-feather="feather"></i> <span class="align-middle">Reviews</span>
            </a>
        </li>

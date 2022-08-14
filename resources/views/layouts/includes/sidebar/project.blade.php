
            <li class="sidebar-item {{ (in_array(request()->segment(1), ['project-incident-notifications', 'project-incident-investigation', 'project-recommendations'])) ? 'active' : '' }}">
                <a href="#projects" data-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="slack"></i> <span class="align-middle">Incidents</span>
                </a>
                <ul id="projects" class="sidebar-dropdown list-unstyled collapse {{ (in_array(request()->segment(1), ['project-incident-notifications', 'project-incident-investigation', 'recommendations'])) ? 'show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ (request()->segment(1) == 'project-incident-notifications') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('project.incidents') }}">Notifications</a></li>
                    <li class="sidebar-item {{ (request()->segment(1) == 'project-incident-investigation') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('project.investigation') }}">Investigations</a></li>
                    <li class="sidebar-item {{ (request()->segment(1) == 'recommendations') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('project.recommendations') }}">Recommendations</a></li>
                </ul>
            </li>


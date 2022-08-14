<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Menu</li>

        <li>
            <a href="/" class="waves-effect">
                <i class="bx bx-home-circle"></i>
                <span key="t-dashboards">Dashboard</span>
            </a>
        </li>

        <li class="">
            <a href="#" class="has-arrow waves-effect" aria-expanded="false">
                <i class="bx bx-aperture"></i>
                <span key="t-chat"> Management</span>
            </a>
            <ul class="sub-menu" aria-expanded="false" >
                <li><a href="#" key="t-wallet">Locations</a></li>
            </ul>
        </li>

        <li class="mm-">
            <a hhref="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form2').submit();" class="waves-effect ">
                <i class="bx bx-power-off"></i>
                <span key="t-chat">Logout</span>
                <form id="logout-form2" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </a>
        </li>


    </ul>
</div>



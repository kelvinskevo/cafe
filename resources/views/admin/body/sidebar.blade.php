<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="index.html"><img src="{{ asset('assets/images/klassy-logo.png') }}"
                alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="{{ asset('assets/images/klassy-logo.png') }}"
                alt="logo" /></a>
    </div>
    <ul class="nav">

        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('chefs.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-table-large"></i>
                </span>
                <span class="menu-title">Chefs</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('events.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Events</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('foods.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">Foods</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <span class="menu-icon">
                    <i class="mdi mdi-laptop"></i>
                </span>
                <span class="menu-title">Reservations</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('reservations.index') }}">New
                            Reservations</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('reservations.confirmed') }}">Confirmed
                            reservations</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('reservations.rejected') }}">Rejected
                            Reservations</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('reservations.all') }}">All
                            Reservations</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('specials.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Specials</span>
            </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('users.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Users</span>
            </a>
        </li>



    </ul>
</nav>

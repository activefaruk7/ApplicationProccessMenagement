        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Application Management</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            @cannot('is-teacher', auth()->user())
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ request()->routeIs('userapplication.*') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#applicationCollapse"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Application</span>
                </a>
                <div id="applicationCollapse" class="collapse {{ request()->routeIs('userapplication.*') ? 'show' : '' }}" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->routeIs('userapplication.create') ? 'active' : '' }}" href="{{route('userapplication.create')}}">Apply</a>
                        <a class="collapse-item {{ request()->routeIs('userapplication.index') ? 'active' : '' }}" href="{{route('userapplication.index')}}">Show</a>
                    </div>
                </div>
            </li>
            @endcan
            @can('is-teacher', auth()->user())

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item {{ request()->routeIs('check-application-index') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('check-application-index')}}">
                    <span>Applicatoins</span></a>
                </a>

            </li>


            @endcan








        </ul>
        <!-- End of Sidebar -->

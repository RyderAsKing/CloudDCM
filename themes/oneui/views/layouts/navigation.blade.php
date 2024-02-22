<!-- Sidebar -->
<!--
        Sidebar Mini Mode - Display Helper classes

        Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
        Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
            If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

        Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
        Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
        Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
    -->
<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header">
        <!-- Logo -->
        <a class="font-semibold text-dual" href="/">
            <span class="smini-visible">
                <i class="fa fa-circle-notch text-primary"></i>
            </span>
            <span class="smini-hide fs-5 tracking-wider">Cloud<span class="fw-normal">DCM</span></span>
        </a>
        <!-- END Logo -->

        <!-- Extra -->
        <div>
            <!-- Dark Mode -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="dark_mode_toggle"
                href="javascript:void(0)">
                <i class="far fa-moon"></i>
            </a>
            <!-- END Dark Mode -->

            <!-- Options -->
            {{-- <div class="dropdown d-inline-block ms-1">
                <a class="btn btn-sm btn-alt-secondary" id="sidebar-themes-dropdown" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" href="#">
                    <i class="fa fa-brush"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end fs-sm smini-hide border-0"
                    aria-labelledby="sidebar-themes-dropdown">
                    <!-- Sidebar Styles -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_light"
                        href="javascript:void(0)">
                        <span>Sidebar Light</span>
                    </a>
                    <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_dark"
                        href="javascript:void(0)">
                        <span>Sidebar Dark</span>
                    </a>
                    <!-- END Sidebar Styles -->

                    <div class="dropdown-divider"></div>

                    <!-- Header Styles -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_light"
                        href="javascript:void(0)">
                        <span>Header Light</span>
                    </a>
                    <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_dark"
                        href="javascript:void(0)">
                        <span>Header Dark</span>
                    </a>
                    <!-- END Header Styles -->
                </div>
            </div> --}}
            <!-- END Options -->

            <!-- Close Sidebar, Visible only on mobile screens -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close"
                href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
            </a>
            <!-- END Close Sidebar -->
        </div>
        <!-- END Extra -->
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}"
                        href="{{route('dashboard')}}">
                        <i class="nav-main-link-icon si si-cursor"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                @hasanyrole('user|subuser')
                <li class="nav-main-heading">MODULES</li>

                @can('view', App\Models\Rack::class)
                <li class="nav-main-item{{ request()->is('colocation_manager/*') ? ' open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="true" href="#">
                        <i class="nav-main-link-icon fa-solid fa-server"></i>
                        <span class="nav-main-link-name">Colocation Manager</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('colocation_manager.locations.index') ? ' active' : '' }}"
                                href="{{route('colocation_manager.locations.index')}}">
                                <span class="nav-main-link-name">Locations</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('colocation_manager.racks.index') ? ' active' : '' }}"
                                href="{{route('colocation_manager.racks.index')}}">
                                <span class="nav-main-link-name">Racks</span>
                            </a>
                        </li>

                    </ul>
                </li>
                @endcan

                @can('view', App\Models\Customer::class)
                <li class="nav-main-item open">
                    <a class="nav-main-link" href="{{route('customer_relationship_manager.customers.index')}}">
                        <i class="nav-main-link-icon fa fa-thin fa-users"></i>
                        <span class="nav-main-link-name">CRM</span>
                    </a>
                </li>
                @endcan

                @can('view', App\Models\VPS::class)

                <li class="nav-main-item{{ request()->is('vps_manager/*') ? ' open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="true" href="#">
                        <i class="nav-main-link-icon fa fa-thin fa-cloud"></i>
                        <span class="nav-main-link-name">VPS Manager</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('vps_manager.locations.index') ? ' active' : '' }}"
                                href="{{route('vps_manager.locations.index')}}">
                                <span class="nav-main-link-name">Locations</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('vps_manager.vpss.index') ? ' active' : '' }}"
                                href="{{route('vps_manager.vpss.index')}}">
                                <span class="nav-main-link-name">VPS</span>
                            </a>
                        </li>

                    </ul>
                </li>
                @endcan

                @can('view', App\Models\Subnet::class)
                <li class="nav-main-item open">
                    <a class="nav-main-link" href="{{route('ip_manager.subnets.index')}}">
                        <i class="nav-main-link-icon fa fa-thin fa-network-wired"></i>
                        <span class="nav-main-link-name">IP Manager</span>
                    </a>
                </li>


                @endcan

                @can('view', App\Models\Server::class)

                <li class="nav-main-item open">
                    <a class="nav-main-link" href="{{route('dedicated_server_manager.servers.index')}}">
                        <i class="nav-main-link-icon fa fa-thin fa-microchip"></i>
                        <span class="nav-main-link-name">Server Manager</span>
                    </a>
                </li>
                @endcan

                @endhasanyrole

                @hasanyrole('admin|user')
                <li class="nav-main-heading">Configuration</li>
                <li class="nav-main-item open">
                    <a class="nav-main-link" href="{{route('users.index')}}">
                        <i class="nav-main-link-icon fa fa-thin fa-user"></i>
                        <span class="nav-main-link-name">Users</span>
                    </a>
                </li>
                @endhasanyrole
                @impersonating
                <li class="nav-main-item open">
                    <a class="nav-main-link" href="{{route('impersonate.leave')}}">
                        <i class="nav-main-link-icon fa fa-thin fa-circle-xmark"></i>
                        <span class="nav-main-link-name">Leave impersonation</span>
                    </a>
                </li>
                @endImpersonating
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar -->

<!-- Header -->
<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div class="d-flex align-items-center">
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-dual" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <!-- END Toggle Sidebar -->

        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="d-flex align-items-center">
            <!-- User Dropdown -->
            <div class="dropdown d-inline-block ms-2">
                <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center"
                    id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="Header Avatar"
                        style="width: 21px;">
                    <span class="d-none d-sm-inline-block ms-2">{{auth()->user()->name}}</span>
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ms-1 mt-1"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0"
                    aria-labelledby="page-header-user-dropdown">
                    <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                        <img class="img-avatar img-avatar48 img-avatar-thumb"
                            src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">
                        <p class="mt-2 mb-0 fw-medium">{{auth()->user()->name}}</p>
                        <p class="mb-0 text-muted fs-sm fw-medium">Registered
                            {{auth()->user()->created_at->diffForHumans()}}
                        </p>
                    </div>
                    <div class="p-2">
                        <a class="dropdown-item d-flex align-items-center justify-content-between"
                            href="{{route('profile.edit')}}">
                            <span class="fs-sm fw-medium">Profile</span>
                        </a>
                    </div>
                    <div role="separator" class="dropdown-divider m-0"></div>
                    <div class="p-2">
                        <a class="dropdown-item  justify-content-between">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="fs-sm fw-medium"
                                    style="padding: 0; margin: 0; border: none; background: none; width: 100%; text-align: left;">Log
                                    Out</button>
                            </form>
                        </a>
                    </div>
                </div>
            </div>
            <!-- END User Dropdown -->

            <!-- Notifications Dropdown -->
            <div class="dropdown d-inline-block ms-2">
                <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-notifications-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-bell"></i>
                    <span class="text-primary">•</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 border-0 fs-sm"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-2 bg-body-light border-bottom text-center rounded-top">
                        <h5 class="dropdown-header text-uppercase">Notifications</h5>
                    </div>
                    <ul class="nav-items mb-0">
                        <li>
                            <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                <div class="flex-shrink-0 me-2 ms-3">
                                    <i class="fa fa-fw fa-check-circle text-success"></i>
                                </div>
                                <div class="flex-grow-1 pe-2">
                                    <div class="fw-semibold">You have a new follower</div>
                                    <span class="fw-medium text-muted">15 min ago</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                <div class="flex-shrink-0 me-2 ms-3">
                                    <i class="fa fa-fw fa-plus-circle text-primary"></i>
                                </div>
                                <div class="flex-grow-1 pe-2">
                                    <div class="fw-semibold">1 new sale, keep it up</div>
                                    <span class="fw-medium text-muted">22 min ago</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                <div class="flex-shrink-0 me-2 ms-3">
                                    <i class="fa fa-fw fa-times-circle text-danger"></i>
                                </div>
                                <div class="flex-grow-1 pe-2">
                                    <div class="fw-semibold">Update failed, restart server</div>
                                    <span class="fw-medium text-muted">26 min ago</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                <div class="flex-shrink-0 me-2 ms-3">
                                    <i class="fa fa-fw fa-plus-circle text-primary"></i>
                                </div>
                                <div class="flex-grow-1 pe-2">
                                    <div class="fw-semibold">2 new sales, keep it up</div>
                                    <span class="fw-medium text-muted">33 min ago</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                <div class="flex-shrink-0 me-2 ms-3">
                                    <i class="fa fa-fw fa-user-plus text-success"></i>
                                </div>
                                <div class="flex-grow-1 pe-2">
                                    <div class="fw-semibold">You have a new subscriber</div>
                                    <span class="fw-medium text-muted">41 min ago</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                <div class="flex-shrink-0 me-2 ms-3">
                                    <i class="fa fa-fw fa-check-circle text-success"></i>
                                </div>
                                <div class="flex-grow-1 pe-2">
                                    <div class="fw-semibold">You have a new follower</div>
                                    <span class="fw-medium text-muted">42 min ago</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="p-2 border-top text-center">
                        <a class="d-inline-block fw-medium" href="javascript:void(0)">
                            <i class="fa fa-fw fa-arrow-down me-1 opacity-50"></i> Load More..
                        </a>
                    </div>
                </div>
            </div>
            <!-- END Notifications Dropdown -->

            <!-- Toggle Side Overlay -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-sm btn-alt-secondary ms-2" data-toggle="layout"
                data-action="side_overlay_toggle">
                <i class="fa fa-fw fa-list-ul fa-flip-horizontal"></i>
            </button>
            <!-- END Toggle Side Overlay -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Search -->
    <div id="page-header-search" class="overlay-header bg-body-extra-light">
        <div class="content-header">
            <form class="w-100" action="/dashboard" method="POST">
                @csrf
                <div class="input-group">
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-alt-danger" data-toggle="layout"
                        data-action="header_search_off">
                        <i class="fa fa-fw fa-times-circle"></i>
                    </button>
                    <input type="text" class="form-control" placeholder="Search or hit ESC.."
                        id="page-header-search-input" name="page-header-search-input">
                </div>
            </form>
        </div>
    </div>
    <!-- END Header Search -->

    <!-- Header Loader -->
    <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-body-extra-light">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-circle-notch fa-spin"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>
<!-- END Header -->

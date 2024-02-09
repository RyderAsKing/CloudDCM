<!doctype html>
<html lang="{{ config('app.locale') }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>{{ config('app.name', 'CLOUDDCM') }}</title>

        <meta name="description" content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="index, follow">

        <!-- Icons -->

        <!-- Modules -->
        @yield('css')
        @vite(['themes/oneui/sass/main.scss', 'themes/oneui/js/oneui.min.js'], 'oneui')

        <!-- Alternatively, you can also include a specific color theme after the main stylesheet to alter the default color theme of the template -->
        {{-- @vite(['resources/sass/main.scss', 'resources/sass/oneui/themes/amethyst.scss',
        'resources/js/oneui/app.js']) --}}
        @yield('js')
    </head>

    <body>
        <!-- Page Container -->
        <!--
    Available classes for #page-container:

    GENERIC

      'remember-theme'                            Remembers active color theme and dark mode between pages using localStorage when set through
                                                  - Theme helper buttons [data-toggle="theme"],
                                                  - Layout helper buttons [data-toggle="layout" data-action="dark_mode_[on/off/toggle]"]
                                                  - ..and/or One.layout('dark_mode_[on/off/toggle]')

    SIDEBAR & SIDE OVERLAY

      'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
      'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
      'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
      'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
      'sidebar-dark'                              Dark themed sidebar

      'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
      'side-overlay-o'                            Visible Side Overlay by default

      'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

      'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

    HEADER

      ''                                          Static Header if no class is added
      'page-header-fixed'                         Fixed Header

    HEADER STYLE

      ''                                          Light themed Header
      'page-header-dark'                          Dark themed Header

    MAIN CONTENT LAYOUT

      ''                                          Full width Main Content if no class is added
      'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
      'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)

    DARK MODE

      'sidebar-dark page-header-dark dark-mode'   Enable dark mode (light sidebar/header is not supported with dark mode)
    -->
        <div id="page-container"
            class="sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed main-content-narrow">
            <!-- Side Overlay-->
            <aside id="side-overlay" class="fs-sm">
                <!-- Side Header -->
                <div class="content-header border-bottom">
                    <!-- User Avatar -->
                    <a class="img-link me-1" href="javascript:void(0)">
                        <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">
                    </a>
                    <!-- END User Avatar -->

                    <!-- User Info -->
                    <div class="ms-2">
                        <a class="text-dark fw-semibold fs-sm" href="javascript:void(0)">{{auth()->user()->name}}</a>
                    </div>
                    <!-- END User Info -->

                    <!-- Close Side Overlay -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <a class="ms-auto btn btn-sm btn-alt-danger" href="javascript:void(0)" data-toggle="layout"
                        data-action="side_overlay_close">
                        <i class="fa fa-fw fa-times"></i>
                    </a>
                    <!-- END Close Side Overlay -->
                </div>
                <!-- END Side Header -->

                <!-- Side Content -->
                <div class="content-side">
                    <p>
                        You have access to the following modules
                    </p>
                    @can('view', App\Models\Rack::class)

                    <div class="alert alert-success" role="alert">
                        Colocation Manager
                    </div>
                    @endcan

                    @can('view', App\Models\Customer::class)
                    <div class="alert alert-success" role="alert">
                        Customer Relationship Manager
                    </div>
                    @endcan

                    @can('view', App\Models\VPS::class)
                    <div class="alert alert-success" role="alert">
                        VPS Manager
                    </div>
                    @endcan

                    @can('view', App\Models\Subnet::class)
                    <div class="alert alert-success" role="alert">
                        IP Manager
                    </div>
                    @endcan

                    @can('view', App\Models\Server::class)
                    <div class="alert alert-success" role="alert">
                        Server Manager
                    </div>
                    @endcan

                </div>
                <!-- END Side Content -->
            </aside>
            <!-- END Side Overlay -->

            @include('layouts.navigation')

            <!-- Main Container -->
            <main id="main-container">
                @yield('content')
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="bg-body-light">
                <div class="content py-3">
                    <div class="row fs-sm">
                        <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
                            Crafted with <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold"
                                href="https://pixelcave.com" target="_blank">pixelcave</a>
                        </div>
                        <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                            <a class="fw-semibold" href="https://pixelcave.com/products/oneui" target="_blank">OneUI</a>
                            &copy; <span data-toggle="year-copy"></span>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->
    </body>

</html>
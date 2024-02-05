<!doctype html>
<html lang="{{ config('app.locale') }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>OneUI - Bootstrap 5 Admin Template &amp; UI Framework</title>

        <meta name="description" content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="index, follow">

        <!-- Icons -->
        <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
        <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

        <!-- Modules -->
        @yield('css')
        @vite(['resources/sass/main.scss', 'resources/js/oneui/app.js'])

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
        <div id="page-container">
            <!-- Main Container -->
            <main id="main-container">
                @yield('content')
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
    </body>

</html>
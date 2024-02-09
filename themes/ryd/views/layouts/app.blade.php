<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CLOUDDCM') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['themes/ryd/css/app.css', 'themes/ryd/js/app.js'], 'ryd')

        <!-- Third party -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <!-- Include Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <!-- Include jQuery (required for Select2) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Include Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </head>


    <body class="font-sans antialiased">
        <div class="min-h-screen bg-blue-300" @if(file_exists(public_path('image/' . env('BACKGROUND_APP'))) &&
            env('BACKGROUND_APP') !=null)
            style="background-image: url({{ asset('image/' . env('BACKGROUND_APP')) }}); background-size: cover;"
            @endif>

            <!-- Page Heading -->


            <!-- Page Content -->
            <main>
                @include('layouts.new-navigation')

                <div class="pl-60">
                    @if (isset($header))
                    <header class="bg-white shadow">
                        <div class=" mx-auto py-8 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                    @endif
                    <div class="py-6 px-6">
                        {{ $slot }}
                    </div>
                </div>

                @impersonating
                <div x-data="{
                        bannerVisible: false,
                        bannerVisibleAfter: 300
                    }" x-show="bannerVisible" x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
                    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-y-0"
                    x-transition:leave-end="translate-y-full" x-init="
                        setTimeout(()=>{ bannerVisible = true }, bannerVisibleAfter);
                    "
                    class="fixed bottom-0 left-0 w-full h-auto py-2 duration-300 ease-out bg-black shadow-sm sm:py-0 sm:h-10"
                    x-cloak>
                    <div class="flex items-center justify-between w-full h-full px-3 mx-auto max-w-7xl ">
                        <a href="{{route('impersonate.leave')}}"
                            class="flex flex-col justify-center w-full h-full text-xs leading-6 text-white duration-150 ease-out sm:flex-row sm:items-center opacity-80 hover:opacity-100">
                            <span class="flex items-center">
                                <strong class="font-semibold">Currently Impersonating
                                    {{auth()->user()->name}}</strong><span
                                    class="hidden w-px h-4 mx-3 rounded-full sm:block bg-neutral-700"></span>
                            </span>
                            <span class="block pt-1 pb-2 leading-none sm:inline sm:pt-0 sm:pb-0">Click here to stop
                                impersonating</span>
                        </a>
                    </div>
                </div>
                @endImpersonating
            </main>
        </div>
    </body>

</html>
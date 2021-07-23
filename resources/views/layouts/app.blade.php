<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        {{-- <link rel="stylesheet" href="../../adminlte/dist/css/adminlte.min.css" /> --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        {{-- <script src="../../adminlte/dist/js/adminlte.min.js" defer></script> --}}

        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>

    </head>
    <body class="font-sans antialiased
     sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-closed sidebar-collapse">
        <x-jet-banner />
        @livewire('navigation-menu')

        <!-- Page Heading -->
        <header class="d-flex py-3  shadow-sm border-bottom">
            <div class="container">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main class="container my-5  ">
            {{ $slot }}
        </main>

        @stack('modals')

        @livewireScripts

        @stack('scripts')
    </body>
</html>

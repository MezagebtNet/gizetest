<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">




    <title>{{ config('app.name', 'Gize') }}</title>


    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/fontawesome-free/css/all.min.css') }}">

    <style>
        /*
     * Globals
     */

        /* Links */
        a,
        a:focus,
        a:hover {
            color: #fff;
        }

        /* Custom default button */
        .btn-secondary,
        .btn-secondary:hover,
        .btn-secondary:focus {
            color: #333;
            text-shadow: none;
            /* Prevent inheritance from `body` */
            background-color: #fff;
            border: .05rem solid #fff;
        }


        /*
     * Base structure
     */

        html,
        body {
            height: 100%;
            background-color: #333;
            background-image: radial-gradient(rgba(0, 0, 0, 0.13), rgba(0, 0, 0, 0.51), rgb(0, 0, 0)),
                url("{{ asset('assets/image/background.jpg') }}");
            /* width: 80%; */
            /* height: 400px; */
            background-size: cover;
            background-position-x: center;
            background-position-y: center;
        }

        #show_bg_2 {
            background-image:
                linear-gradient(to bottom, rgba(245, 246, 252, 0.52), rgba(117, 19, 93, 0.73)),
                url('images/background.jpg');
            width: 80%;
            height: 400px;
            background-size: cover;
            color: white;
            padding: 20px;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            color: #fff;
            text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
            box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
        }

        .cover-container {
            max-width: 90%;
        }


        /*
     * Header
     */
        .masthead {
            margin-bottom: 2rem;
        }

        .masthead-brand {
            margin-bottom: 0;
            margin-top: 1rem;
        }

        .nav-masthead .nav-link {
            margin-top: 1.5rem;
            padding: .25rem 0;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.849);
            background-color: transparent;
            border-bottom: .25rem solid transparent;
        }

        .nav-masthead .nav-link:hover,
        .nav-masthead .nav-link:focus {
            border-bottom-color: rgba(255, 255, 255, 0.849);
        }

        .nav-masthead .nav-link+.nav-link {
            margin-left: 1.8rem;
        }

        .nav-masthead .active {
            color: #fff;
            border-bottom-color: #fff;
        }

        @media (min-width: 48em) {
            .masthead-brand {
                float: left;
            }

            .nav-masthead {
                float: right;
            }


        }



        @media(max-width: 459px) {

            .card {
                min-width: fit-content !important;
            }
            .cover-container {
                max-width: 100%;
            }
        }
        @media(min-width: 460px) {

            .inner.cover {
                padding-left: 0%;
                padding-right: 0%;
            }
            .card {
                min-width: 460px;
            }
        }


        /*
     * Cover
     */
        .cover {
            /* padding: 0 1.5rem; */
        }

        .cover .btn-lg {
            padding: .75rem 1.25rem;
            font-weight: 700;
        }

        /*
      * Inner
      */

        .inner.cover {
            /* padding-left: 10%;
            padding-right: 10%; */
            margin-top: 2em;
            margin-bottom: 2em;
            text-align: left;
        }

        /*
     * Footer
     */
        .mastfoot {
            text-align: center;
            color: rgba(255, 255, 255, 0.76);
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }



            .cover {
                padding: 0 0.5rem;
            }
        }

        .card {
            box-shadow: black 0px 4px 8px;
        }

        .card-body {
            /* width: 40%; */
            color: #333;
            text-shadow: none;
        }

        .card-body .button {
            margin-top: 1em;
            margin-left: 1em;

        }

        .form-group {
            margin-top: 1.5em;
            margin-bottom: 1.5em;
        }


        .large-buttons {
            box-shadow: black 0px 4px 8px;
            border:none;
            background-color: #ccc;
            min-width: 130px;
            padding: .75rem 0.5rem;
            margin-top: 1rem;
        }

        a.large-buttons:hover {
            border:none;

            background-color: #fff;
        }


    </style>

    @livewireStyles

</head>

<body class="text-center">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            @yield('header-menu')
        </header>

        <main role="main" class="inner cover">

            @yield('main-content')
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">
                <p>Copyright &copy; {{ cur_year() }}. Gize</a>, Powered by <a href="https://mezagebtnet.com">Mezagebt
                        Net</a>.</p>
            </div>
        </footer>


        <!-- jQuery -->
        <script src="{{ asset('vendors/admin/plugins/jquery/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('vendors/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('vendors/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        @livewireScripts

</body>

</html>

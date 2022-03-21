<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @yield('seo')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <link rel="shortcut icon" href="{{ asset('storage/favicon.png') }}" >

    @php
        $csrf = json_encode([
            'csrfToken' => csrf_token(),
        ]);
    @endphp
    <script>
        window.Laravel = "{{ json_encode(['csrfToken' => csrf_token()]) }}";
        var module = {}; /*   <-----THIS LINE */
    </script>


    {{-- <script src="{{ asset('assets/js/dist/echo.iife.js') }}"></script> --}}
    <script src="{{ mix('js/app.js') }}" defer></script>


    <title>{{ config('app.name', 'Gize') }}</title>

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Flag Icons -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/flag-icon-css/css/flag-icon.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/dist/css/adminlte.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('vendors/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('vendors/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ asset('vendors/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('vendors/admin/plugins/summernote/summernote-bs4.min.css') }}">

    <!-- remodal-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.0/remodal.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.0/remodal-default-theme.min.css">

    <!-- animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


    @include('layouts.styles.globalstyles')

    <style>

        .navbar .badge {
            right: 4px !important;
        }

        .searchbar-container {
            margin-top: 5%;
        }

        /* Style to create scroll bar in dropdown */
        .scrollable-dropdown {
            height: auto;
            max-height: 320px;
            /* Increase / Decrease value as per your need */
            overflow-x: hidden;
        }

        /* ----------- 0 - 295px ----------- */
        @media screen and (max-width: 295px) {
            .content {
                margin-top: 96px !important  ;
            }
            .main-header.dropdown-legacy .dropdown-menu {
                top: 96px;
            }

            .navbar-no-expand .dropdown-menu {

                top: 96px !important;
            }


            .sticky-top {

                top: 96px;
            }
        }

        /* ----------- 0 - 426px ----------- */
        @media screen and (max-width: 436px) {

            .navbar-no-expand .dropdown-menu {
                /* top: 95px !important; */
            }

            .sticky-top {
                /* top: 96px; */

            }

        }


    </style>

    @yield('styles')

    @include('layouts.scripts.notification_styles')

</head>

<body class="
{{ auth()->user() != null ? (auth()->user()->theme_preference == 'dark-mode' ? 'dark-mode' : '' ): '' }}
hold-transition layout-top-nav layout-navbar-fixed ">
<div class="wrapper">

    <!-- Preloader -->
    <div style="display:none;" class="preloader dark-mode flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('vendors/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
            height="60" width="60">
    </div>

    <!-- Navbar -->
    @include('layouts.website.includes.navbar')
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content-header')
        <!-- /.content-header -->

        <!-- Main content -->
        {{-- <div class="container-fluid"> --}}
        <div class="">
            <!-- Main content -->
            <section class="content">
                @yield('content')

                @yield('modals')
            </section>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- /.content-wrapper -->
    <footer class="main-footer">
        @include('layouts.website.includes.footer')
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->



    </div>



    </div>



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

    <!-- daterangepicker -->
    <script src="{{ asset('vendors/admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('vendors/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <!-- AdminLTE App -->
    <script src="{{ asset('vendors/admin/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('vendors/admin/dist/js/demo.js') }}"></script> --}}

    <!-- Sweetalert2 -->
    <script src="{{ asset('vendors/admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('vendors/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

    <!-- Remodal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.0/remodal.min.js"></script>

    <!-- JQuery Fitvids -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fitvids/1.2.0/jquery.fitvids.min.js"></script>

    @yield('modals')

    @yield('js')

    @stack('modals')

    @stack('scripts_js')

    <script>
        $(document).ready(function(e) {
            $('.search-panel .dropdown-menu').find('a').click(function(e) {
                e.preventDefault();
                var param = $(this).attr("href").replace("#", "");
                var concept = $(this).text();
                $('.search-panel span#search_concept').text(concept);
                $('.input-group #search_param').val(param);
            });
        });


        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

    </script>

</div>
    @auth
    @include('layouts.scripts.notification_scripts')
    @include('layouts.scripts.userpreference_scripts')
    @endauth
</body>

</html>

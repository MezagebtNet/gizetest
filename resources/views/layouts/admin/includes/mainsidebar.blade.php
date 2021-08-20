<aside class="main-sidebar sidebar-dark-warning elevation-4">

    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="{{ asset('assets/image/logos/Gize App Logo Circle.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">GIZE</span>
    </a>

    <!-- Sidebar -->
    @yield('mainsidebar')

    <!-- /.sidebar -->
</aside>
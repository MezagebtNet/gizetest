   @auth
    <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img alt="{{ auth()->user()->full_name_first_chars }}" style="width: 32px; height: 32px;"
                src="{{ auth()->user()->profile_photo_url }}"
                class="ml-1 img-size-32 user-image img-circle elevation-0" title="Profile Image"
                alt="User Image">
            <span class="d-none d-md-inline">{{ auth()->user()->firstname }}</span>

        </a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            @if (auth()->user()->isSuperAdmin() ||
                auth()->user()->isAdmin())
                <li><a href="{{ route('admin.home') }}" class="dropdown-item">System Administration</a></li>

                <li><a href="{{ route('admin.home') }}" class="dropdown-item">Notifications</a></li>
                <li class="dropdown-divider"></li>
            @endif
            @if (auth()->user()->isDefaultUser() ||
                auth()->user()->isSuperAdmin() ||
                auth()->user()->isAdmin())
                <li><a href="{{ route('user.home') }}" class="dropdown-item">My Account</a></li>
            @endif

            @if (auth())
                <li><a href="{{ route('profile.show') }}" class="dropdown-item">Edit Profile</a></li>
            @endif


            <li class="dropdown-divider"></li>

            <li><a href="{{ route('logout') }}" class="dropdown-item">Logout</a></li>

        </ul>
    </li>


@endauth
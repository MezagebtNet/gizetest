{{-- <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>

        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">There are no notifications</a>
    </div>
</li> --}}

@php
    //All Notifications
    $notifications = auth()->user()->unreadNotifications;

    //New User Created Notifications only
    $newUserNotifications = array_filter($notifications->toArray(), function ($var) {return $var['type'] == 'App\Notifications\NewUserNotification';});

    //Notifications for user as a default user
    // $newUserNotifications = auth()->user()->unreadNotifications->where('data->type', 'new user');
    $newUserWelcomeNotifications = array_filter($notifications->toArray(), function ($var) {return $var['type'] == 'App\Notifications\NewUserWelcomeNotification';});
    // dd($newUserWelcomeNotifications);
    // $myNotifications = $notifications->data[]
@endphp

<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if($notifications->count())
            <span class="badge badge-warning navbar-badge notification-count">{{ $notifications->count() }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header notification-count">{{ $notifications->count() }} Notifications</span>
        {{-- New User Notifications --}}
        {{-- @forelse($newUserNotifications as $notification) --}}
        @if (count($newUserNotifications))
            <a href="{{ route('admin.notifications') }}" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> <span class="newuser-notification-count">{{ count($newUserNotifications) }}</span> new user registered.
                <span class="float-right text-muted text-sm"></span>
            </a>
            <div class="dropdown-divider"></div>
        @else
            <span class="text-center text-muted text-sm dropdown-item">
                There are no notifications</span>

        @endif
        {{-- @empty
        There are no new user registraions.
    @endforelse --}}
        <div class="dropdown-divider"></div>
        <a href="{{ route('admin.notifications') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>

</li>

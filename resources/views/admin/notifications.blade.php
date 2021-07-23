@extends('layouts.admin.index')

@section('title', 'Notifications')

@section('styles')
    @livewireStyles
@endsection

@section('navbar')
    @include('admin.navbar')
@endsection

@section('notifications-dropdown')
    @include('admin.notifications-dropdown')
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Notifications
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if (auth()->user()->isSuperAdmin())
                    @forelse($notifications as $notification)
                        <div id="notification-alert-{{ $notification->id }}" class="notification-alert alert alert-info alert-dismissible">
                            <button data-notification-id="{{ $notification->id }}" type="button" class="close notification-alert-dismiss" aria-hidden="true">×</button>
                            <h6><i class="icon fas fa-info"></i> New User!</h6>
                            <span>{{ $notification->data['name'] }} has just registered.</span><br/>
                            <span class="text-sm">{{ $notification->data['email'] }}</span> -
                            <span class="text-sm ">{{ $notification->created_at->diffForHumans() }}</span>

                        </div>

                        @if ($loop->last)
                            <a href="#" id="mark-all">
                                Mark all as read
                            </a>
                        @endif
                    @empty
                        There are no new notifications
                    @endforelse
                @else
                    You are logged in!
                @endif
            </div>
        </div>
    </div>
</div>

@endsection


@section('modals')

@endsection


@section('js')

@if (auth()->user()->isSuperAdmin())
<script>
    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('admin.markNotification') }}", {
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id
            }
        });
    }
    $(function() {
        $('.notification-alert-dismiss').click(function() {
            let id = $(this).data('notification-id');
            let request = sendMarkRequest(id);
            request.done(() => {
                //For General Notifications Counter
                let prevNotificationCount = $(".notification-count").html();
                if(prevNotificationCount==1){
                    // $(".notification-count").hide();
                    $(".notification-count:not([class*='d-none'])").addClass("d-none");

                    $(".notification-count:parent").closest("div.dropdown-menu").html(
                        '<span class="text-center text-muted text-sm dropdown-item">'+
                        'There are no notifications</span>');
                }
                else if(prevNotificationCount>1){
                    $(".notification-count").html(prevNotificationCount-1);
                    $(".notification-count.dropdown-item.dropdown-header").html(prevNotificationCount-1 + " Notifications");

                }

                //For Specific Notifications Group Type Countwe
                let prevNewUserNotificationCount = $(".newuser-notification-count").html();
                if(prevNewUserNotificationCount>1){
                    $(".newuser-notification-count").html(prevNewUserNotificationCount-1);

                }

                $('#notification-alert-'+id).alert('close');

            });
        });
        $('#mark-all').click(function() {
            let request = sendMarkRequest();
            request.done(() => {
                $(".notification-count:parent").closest("div.dropdown-menu").html(
                        '<span class="text-center text-muted text-sm dropdown-item">'+
                        'There are no notifications</span>');
                $(".notification-count:not([class*='d-none'])").addClass("d-none");

                $('.notification-alert').alert('close');
            })
        });
    });


</script>
@endif
@endsection

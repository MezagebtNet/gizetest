<script type="module">
    import Echo from '{{ asset('assets/js/dist/echo.js') }}'

    import {
        Pusher
    } from '{{ asset('assets/js/dist/pusher.js') }}'

    window.Pusher = Pusher

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: 'pusherkey',
        // cluster: 'mt1',
        // encrypted: true,
        wsHost: window.location.hostname,
        wsPort: 6001,
        forceTLS: false,
        disableStats: true,
    });

    // window.Echo.channel('your-channel')
    // .listen('your-event-class', (e) => {
    //         console.log(e)
    // });



    // console.log("websokets in use");





    $(function() {
        renderNotifications();

        window.Echo.private('App.Models.User.' + '{{ auth()->user()->id }}')
        .notification((notification) => {
            if (notification.type == "broadcast.message") {
                Swal.fire({
                    position: 'bottom-end',
                    // toast: true,
                    icon: 'success',
                    title: notification.message,
                    showConfirmButton: false,
                    timer: 5000
                });

                //update notification dropdown...
                renderNotifications();

            }
            // console.log(notification, "New user notification.");
            // alert(notification.name + " has just registered!")

        });

        // var myVar = setInterval(myTimer, 1000 * 10);

        function myTimer() {
            renderNotifications();
        }

        function renderNotifications() {
            // let user_id = '{{ auth()->user()->id }}';

            let url = "{{ route('web.rendernotifications', ['dropdown_state' => ':dropdown_state']) }}";
            let dropdown_state = $('.notifications-dropdown').hasClass('show');
            console.log(dropdown_state);
            url = url.replace(':dropdown_state', dropdown_state);

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'text',
                data: {
                    // user_id: user_id,
                    dropdown_state: dropdown_state,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    if (response) {
                        // alert(response);
                        $('.notifications-dropdown').html(response);
                        // $('.notifications-dropdown').dropdown();
                    }
                },
                error: function() {}
            });
        }

        $('.btn-mark-read').on('click', function(e) {
            alert('here');
            let notification_id = $(this).attr('notification_id');
            // let user_id = '{{ auth()->user()->id }}';
            let url =
                "{{ route('web.marknotification', ['notification_id' => ':notification_id', 'dropdown_state' => true]) }}";
            url = url.replace(':notification_id', notification_id);
            // url = url.replace(':user_id', user_id);
            alert(url);

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'text',
                data: {
                    notification_id: notification_id,
                    user_id: user_id,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    if (response) {
                        // renderNotifications();
                        // $('.notifications-dropdown').html(response);
                        $('.notifications-dropdown').html(response);
                        // $('.dropdown-toggle').dropdown();
                    }
                },
                error: function() {}
            });
        });

        $('.btn-mark-all').on('click', function(e) {
            alert('marking all');
            let user_id = '{{ auth()->user()->id }}';
            let url = "{{ route('web.markallnotification', ['dropdown_state' => true]) }}";
            // url = url.replace(':user_id', user_id);

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'text',
                data: {
                    // user_id: user_id,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    if (response) {
                        // renderNotifications();
                        // $('.notifications-dropdown').html(response);
                        $('.notifications-dropdown').html(response);
                        $('.dropdown-toggle').dropdown();
                    }
                },
                error: function() {}
            });
        });

    });
</script>

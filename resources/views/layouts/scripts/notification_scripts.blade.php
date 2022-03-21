<script type="module">

    // import Echo from "{{ asset('assets/js/dist/echo.js') }}"

    // import {
    //     Pusher
    // } from "{{ asset('assets/js/dist/pusher.js') }}"

    // window.Pusher = Pusher

    // window.Echo = new Echo({
    //     broadcaster: 'pusher',
    //     key: 'pusherkey',
    //     cluster: 'mt1',
    //     // encrypted: true,
    //     wsHost: window.location.hostname,
    //     wsPort: 6001,
    //     forceTLS: false,
    //     disableStats: false,
    // })




    $(function() {
        renderNotifications();


        // window.Echo.private('App.Models.User.' + '{{ auth()->user() != null ? auth()->user()->id : ''}}')
        //     .notification((notification) => {
        //         console.log(notification);
        //         if (notification.type == "broadcast.message") {
        //             Swal.fire({
        //                 position: 'bottom-end',
        //                 // toast: true,
        //                 icon: 'success',
        //                 title: notification.message,
        //                 showConfirmButton: false,
        //                 timer: 5000
        //             });

        //             //update notification dropdown...
        //             renderNotifications();

        //         }


        //     })


        var myVar = setInterval(myTimer, 1000 * 30);

        function myTimer() {
            //check if dropdown is open
            var is_open = $('.notifications-dropdown .dropdown-menu').hasClass('show');
            if(!is_open) {
                renderNotifications();
            }
            // notifyMe();
        }


        function notifyMe_firefox($message) {
            // Let's check if the browser supports notifications
            if (!("Notification" in window)) {
                alert("This browser does not support desktop notification");
            }

            // Let's check whether notification permissions have already been granted
            else if (Notification.permission === "granted") {
                // If it's okay let's create a notification
                var notification = new Notification($message);
            }

            // Otherwise, we need to ask the user for permission
            else if (Notification.permission !== "denied") {
                Notification.requestPermission(function(permission) {
                    // If the user accepts, let's create a notification
                    if (permission === "granted") {
                        var notification = new Notification($message);
                    }
                });
            }

            // At last, if the user has denied notifications, and you
            // want to be respectful there is no need to bother them any more.
        }

        function renderNotifications() {
            // let user_id = '{{ auth()->user() != null ? auth()->user()->id : ''}}';

            let url = "{{ route('web.rendernotifications', ['dropdown_state' => ':dropdown_state']) }}";
            let dropdown_state = $('.notifications-dropdown').hasClass('show');
            // console.log(dropdown_state);
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
                        mountDropdown();
                        // $('.notifications-dropdown').dropdown();
                    }
                },
                error: function() {}
            });
        }
        function mountDropdown() {
            $('.btn-mark-read').on('click', function(e) {
                let notification_id = $(this).attr('notification_id');
                // let user_id = '{{ auth()->user()->id }}';
                let url =
                    "{{ route('web.marknotification', ['notification_id' => ':notification_id', 'dropdown_state' => true]) }}";
                url = url.replace(':notification_id', notification_id);
                // url = url.replace(':user_id', user_id);
                // alert(url);
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'text',
                    data: {
                        notification_id: notification_id,
                        // user_id: user_id,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        if (response) {
                            renderNotifications();
                            // $('.notifications-dropdown').html(response);
                            // $('.notifications-dropdown').html(response);
                            // mountDropdown();

                            // $('.dropdown-toggle').dropdown();
                        }
                    },
                    error: function() {}
                });
            });

            $('.btn-mark-all').on('click', function(e) {
                // alert('marking all');
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
                            renderNotifications();
                            // $('.notifications-dropdown').html(response);
                            // $('.notifications-dropdown').html(response);
                            // mountDropdown();

                        }
                    },
                    error: function() {}
                });
            });
        }

    });
</script>

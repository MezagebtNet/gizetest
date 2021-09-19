@extends('layouts.website.index')

@section('title', 'Overview')

@section('styles')
    @livewireStyles

    <!--Video JS -->
    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />
    <link href="{{ asset('vendors/videojs/vim.css') }}" rel="stylesheet" />
    {{-- <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet"> --}}

    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" /> --}}
    <link href='{{ asset('vendors/fullcalendar/main.css') }}' rel='stylesheet' />

    <style>
        .video-js .vjs-control-bar {
            color: #fff3d3;
            font-size: 0.8rem;
            height: 40px;
            background-color: rgb(25 20 6 / 70%);

        }

        .vjs-menu-button-popup .vjs-menu .vjs-menu-content {
            background-color: #2B333F;
            background-color: rgba(31, 28, 22, 0.76);
            position: absolute;
            width: 100%;
            bottom: 1.5em;
            max-height: 20em;
            right: 60px;
        }

        .video-js .vjs-control {
            position: relative;
            text-align: center;
            margin: 0;
            padding: 0;
            height: 100%;
            width: 2.7em;
        }

        #schedule_calendar {
            max-width: 1100px;
            margin: 0 auto;
        }

    </style>
    <style>
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #3d3d3d;
            color: white;
        }

        .dark-mode .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            /* background-color: #3d3d3d; */
            color: orange;
        }

        .dark-mode .nav-pills .nav-link:hover,
        .nav-pills .show>.nav-link {
            /* background-color: #3d3d3d; */
            color: orange;
        }

        .nav-pills .nav-link {
            padding-left: 2px;
            padding-right: 2px;
        }

        .spin-8 svg {
            margin: 15px 20px;
            opacity: 0.3;
            width: 70px;
            display: inline;
        }

        @keyframes wipe-enter {
            0% {
                transform: scale(0, .025);
            }

            50% {
                transform: scale(1, .025);
            }
        }


        .video-card {
            /* min-width: 24rem; */
            /* max-width: 22rem; */

            opacity: 0;
            transform: scale(0.85);
        }

        .video-card .card {
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 4px rgba(0, 0, 0, 0.7);
            margin-bottom: 1rem;
        }

        .dark-mode .video-card .card {
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 6px rgba(0, 0, 0, 1);
            margin-bottom: 1rem;
        }

        @media (prefers-reduced-motion: no-preference) {

            .video-card {
                transition: opacity 1s ease, transform 0.8s ease;
                animation-delay: 1.8s;
            }

        }

        .square-transition {
            opacity: 1;
            transform: none;
        }


        /* ----------- 0 - 334x ----------- */
        @media screen and (max-width: 335px) {
            .banner-section-wrapper {
                margin-top: 96px !important;
                ;
            }

            #menuTab a {
                border-radius: 0;

                /* max-width: 100% !important; */
            }

            .sticky-top {
                position: sticky;
                position: -webkit-sticky;
                top: 96px;
                /* max-width: 100% !important; */

                background-color: #f4f6f9;
                box-shadow: 0 0px 12px #3b3b3bb0;
                margin-left: -7px !important;
                margin-right: -7px !important;
            }

            .dark-mode .sticky-top {
                background-color: black;
                box-shadow: 0 0px 12px #000;
            }

            .video-card {
                min-width: 100%;
                max-width: 22rem;
            }

            .videos-grid-wrapper {
                padding-left: 7px !important;
                padding-right: 7px !important;
            }

            .channel-title {
                color: aliceblue;
                font-size: 1.5rem;
                text-shadow: 0 1px 5px black;
                font-weight: 400;
            }

            .channel-description {
                color: rgb(235, 235, 235);
                font-size: 0.8rem;
                text-shadow: 0 1px 5px black;
                font-weight: 300;
            }
        }

        /* ----------- 336 - 450px ----------- */
        @media screen and (min-width: 336px) and (max-width: 499px) {
            #menuTab a {
                border-radius: 0;
                /* max-width: 100% !important; */
            }

            .sticky-top {
                position: sticky;
                position: -webkit-sticky;
                top: 56px;
                /* width:100%; */
                background-color: #f4f6f9;
                box-shadow: 0 0px 12px #3b3b3bb0;
                margin-left: -7px !important;
                margin-right: -7px !important;
            }

            .dark-mode .sticky-top {
                background-color: black;
                box-shadow: 0 0px 12px #000;
            }

            .video-card {
                min-width: 100%;
                max-width: 22rem;
            }

            .videos-grid-wrapper {
                padding-left: 7px !important;
                padding-right: 7px !important;
            }

            .channel-title {
                color: aliceblue;
                font-size: 1.5rem;
                text-shadow: 0 1px 5px black;
                font-weight: 400;
            }

            .channel-description {
                color: rgb(235, 235, 235);
                font-size: 0.8rem;
                text-shadow: 0 1px 5px black;
                font-weight: 300;
            }

        }

        /* ----------- 500 -  ----------- */
        @media screen and (min-width: 500) {
            #menuTab {


                max-width: 400px !important;
                margin: 0 auto;
            }
        }

        /* ----------- 450 - 650px ----------- */
        @media screen and (min-width: 501px) and (max-width: 650px) {
            #menuTab {


                max-width: 400px !important;
                margin: 0 auto;
            }
        }

        /* ----------- 450 - 650px ----------- */
        @media screen and (min-width: 451px) and (max-width: 650px) {
            .video-card {
                /* min-width: 100% !important; */
                max-width: 30rem !important;
            }

            .channel-title {
                color: aliceblue;
                font-size: 1.5rem;
                text-shadow: 0 1px 5px black;
                font-weight: 400;
            }

            .channel-description {
                color: rgb(235, 235, 235);
                font-size: 0.8rem;
                text-shadow: 0 1px 5px black;
                font-weight: 300;
            }
        }

        /* ----------- 650px - 950px ----------- */
        @media screen and (min-width: 651px) and (max-width: 950px) {
            .channel-title {
                color: aliceblue;
                font-size: 2.5rem;
                text-shadow: 0 1px 5px black;
                font-weight: 600;
            }

            .channel-description {
                color: rgb(235, 235, 235);
                font-size: 1rem;
                text-shadow: 0 1px 5px black;
                font-weight: 400;
            }

            #menuTab {


                max-width: 400px !important;
                margin: 0 auto;
            }

        }

        /* ----------- 950px - 1200px ----------- */
        @media screen and (min-width: 951px) and (max-width: 1200px) {
            .channel-title {
                color: aliceblue;
                font-size: 2.5rem;
                text-shadow: 0 1px 5px black;
                font-weight: 600;
            }

            .channel-description {
                color: rgb(235, 235, 235);
                font-size: 1rem;
                text-shadow: 0 1px 5px black;
                font-weight: 400;
            }

            #menuTab {


                max-width: 400px !important;
                margin: 0 auto;
            }

        }

        /* ----------- 1200px + ----------- */
        @media screen and (min-width: 1201px) {
            .channel-title {
                color: aliceblue;
                font-size: 2.5rem;
                text-shadow: 0 1px 5px black;
                font-weight: 600;
            }

            .channel-description {
                color: rgb(235, 235, 235);
                font-size: 1rem;
                text-shadow: 0 1px 5px black;
                font-weight: 400;
            }

            #menuTab {


                max-width: 400px !important;
                margin: 0 auto;
            }

        }

        @media(max-width: 115px) {
            .video-card {
                /* min-width: 100% !important; */
            }
        }

        @media(max-width: 600px) {


            .channel-logo {
                width: 60px !important;
                height: 60px !important;

            }

        }

        @media(max-width: 357px) {
            .video-card {
                min-width: 100% !important;
            }
        }

        .channel-menu {
            position: absolute;
            right: 15px;
            top: 245px;
        }


        .video-card .card {
            overflow: hidden;
            border-radius: 12px;
        }

        .video-js {
            border-radius: 12px 12px 12px 0px;
            overflow: hidden;
            filter: drop-shadow(0 0 0.2rem black);
        }




        .channel-banner {

            border-radius: 0;
            box-shadow: 0 0px 13px #000000cf;
        }

        .channel-logo {
            width: 100px;
            height: 100px;
            background-size: contain;
            background-position: center;
            background-color: black;
            border: 1px solid #ccc;
            background-image: url('{{ asset('assets/image/Addmes Logo.png') }}');
            border-radius: 5%;
            box-shadow: 0 4px 16px #000000de;

        }

        video {
            max-width: 100%;
        }

        .slow-spin {
            -webkit-animation: fa-spin 10s infinite linear;
        }

        .fa-refresh {
            transform: scaleX(-1);
            animation: spin-reverse 10s infinite linear;
        }

        @keyframes spin-reverse {
            0% {
                transform: scaleX(-1) rotate(-360deg);
            }

            100% {
                transform: scaleX(-1) rotate(0deg);
            }
        }

    </style>

@endsection

@section('navbar')
    @include('website.navbar')
@endsection

@section('notifications-dropdown')
    {{-- @include('admin.notifications-dropdown') --}}
@endsection


@section('content')

    <div class="banner-section-wrapper">
        <section style=" width: 100%; padding:0;
                                                        margin-top: -1px;
                                                        background-color: #faebd72e;
                                                        background-image: linear-gradient(to bottom, #000000a6, #3b3b3b63, #0000008f), url(http://localhost:8000/assets/image/Addmes_Cover.jpg);
                                                        height: 186px;
                                                        /* background-attachment: fixed; */
                                                        background-position: center center;
                                                        background-size: cover;

                                                                                        "
            class=" mb-3 pb-0 w:100 jumbotron text-center channel-banner">
            <div style="
                                                                                            >

                                                                <div class="



                         d-flex align-items-center flex-column bd-highlight ">
                <div class="mb-auto p-2 bd-highlight">
                    <h1 class="channel-title mb-auto">{{ $gize_channel->name }}</h1>
                    <p class="channel-description lead">{{ __('Producer') }} - {{ $gize_channel->producer }}</p>
                </div>
            </div>

            <div class="d-flex align-items-center flex-column bd-highlight ">
                <div class="pb-0 mb-n3 bd-highlight">
                    <div class="channel-logo"></div>
                </div>
            </div>
    </div>
    </section>
    </div>
    <div class="videos-grid-wrapper px-4 pt-4 pt-5 pb-4">

        {{-- @include('website.user.top-menu') --}}

        <div class="row">
            {{-- <div class="col-sm-4 order-sm-2 col-md-3 order-md-2 mb-xs-3 mb-2"> --}}

            {{-- @include('website.channel.group_stream.sidebar') --}}

            {{-- </div> --}}
            <div class="col-sm-12  order-sm-1 col-md-12  order-md-1 ">
                {{-- <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                    <hr>
                    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                </div> --}}
                <div class="row mt-n5 mb-3">

                </div>
                <ul class="nav nav-pills nav-justified sticky-top" style="margin-top: -1px;" id="menuTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="my-streams-tab" data-toggle="tab" href="#my-streams" role="tab"
                            aria-controls="my-streams" aria-selected="true">{{ __('My Videos') }}</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="schedule-tab" data-toggle="tab" href="#schedule" role="tab"
                            aria-controls="schedule" aria-selected="false">{{ __('Schedule') }}</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="archive-tab" data-toggle="tab" href="#archive" role="tab"
                            aria-controls="archive" aria-selected="false">{{ __('Archive') }}</a>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab"
                            aria-controls="settings" aria-selected="false">Settings</a>
                    </li> --}}
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="my-streams" role="tabpanel" aria-labelledby="my-streams-tab">

                        <h2 class="pt-2">{{ __('My Streamed Videos') }}</h2>
                        <h6 class="
                                    text-muted mb-0">
                            {{ __('Videos available for you to watch from this channel') }}
                            <button class="btn btn-xs btn-dark btn-refresh float-right">
                                <i class="fa fa-recycle"></i> {{ __('Reload') }}
                            </button>
                        </h6>
                        <hr />
                        <div style="text-align: center;" class="spin-8">
                            <svg class=" slow-spin fa-refresh" aria-hidden="true" focusable="false" data-prefix="fas"
                                data-icon="sun" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                class="svg-inline--fa fa-sun fa-w-16 fa-spin fa-lg">
                                <path fill="currentColor"
                                    d="M256 160c-52.9 0-96 43.1-96 96s43.1 96 96 96 96-43.1 96-96-43.1-96-96-96zm246.4 80.5l-94.7-47.3 33.5-100.4c4.5-13.6-8.4-26.5-21.9-21.9l-100.4 33.5-47.4-94.8c-6.4-12.8-24.6-12.8-31 0l-47.3 94.7L92.7 70.8c-13.6-4.5-26.5 8.4-21.9 21.9l33.5 100.4-94.7 47.4c-12.8 6.4-12.8 24.6 0 31l94.7 47.3-33.5 100.5c-4.5 13.6 8.4 26.5 21.9 21.9l100.4-33.5 47.3 94.7c6.4 12.8 24.6 12.8 31 0l47.3-94.7 100.4 33.5c13.6 4.5 26.5-8.4 21.9-21.9l-33.5-100.4 94.7-47.3c13-6.5 13-24.7.2-31.1zm-155.9 106c-49.9 49.9-131.1 49.9-181 0-49.9-49.9-49.9-131.1 0-181 49.9-49.9 131.1-49.9 181 0 49.9 49.9 49.9 131.1 0 181z"
                                    class=""></path></svg>
                                </div>

                                    <div class="
                                    streams-container">

                                    {{-- <div class="justify-content-sm-center"> --}}
                                    {{-- <center> --}}
                                    <div class=" grid-container">
                                        <div id="video-cards"
                                            class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 ">
                                            {{-- {{ dd($activevideos[0]->video->poster_image_url) }} --}}

                                            @for ($i = 0; $i < $activevideos->count(); $i++)

                                                @php
                                                    $active = $activevideos[$i]->video[0];
                                                    $key = $i;
                                                @endphp
                                                {{-- {{ dd($active->id) }} --}}

                                                <x-channels.player :vidid="$active->id" :viddomid="'v'.$key.$active->id"
                                                    :vidtitle="$active->title" :viddescription="$active->description"
                                                    :vidposter="$active->poster_image_url" :video="$active" />



                                            @endfor
                                        </div>
                                        {{-- </center> --}}
                                        {{-- </div> --}}
                                    </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">

                        <div id="schedule_calendar"></div>

                    </div>
                    <div class="tab-pane" id="archive" role="tabpanel" aria-labelledby="archive-tab">...</div>
                </div>



            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection


@section('modals')

@endsection


@section('js')

    <!-- Video JS -->

    <script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script>
    {{-- <script src="https://unpkg.com/video.js/dist/video.js"></script> --}}

    <script src="https://unpkg.com/@videojs/http-streaming@2.8.0/dist/videojs-http-streaming.min.js"></script>

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-quality-levels/2.1.0/videojs-contrib-quality-levels.min.js">
    </script>

    <script src="https://unpkg.com/videojs-hls-quality-selector@1.0.5/dist/videojs-hls-quality-selector.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/videojs-landscape-fullscreen@11.1.0/dist/videojs-landscape-fullscreen.min.js">
    </script>


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> --}}
    <script src='{{ asset('vendors/fullcalendar/main.js') }}'></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script> --}}

    <script>
        // alert("{{ \App::getLocale() }}")
        document.addEventListener('DOMContentLoaded', function() {
            // declare var FullCalendar: any;

            var calendarEl = document.getElementById('schedule_calendar');
            console.log({!! json_encode($events) !!});
            var calendar = new FullCalendar.Calendar(calendarEl, {
                height: 'auto',
                themeSystem: 'bootstrap',
                // stickyHeaderDates: false, // for disabling

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'listDay,listWeek,listMonth,listYear',
                },
                buttonText: {
                    today: "{{ __('today') }}",
                    // prev: '&lt;',
                    // next: '&gt;'
                },

                locale: '{{ \App::getLocale() }}',
                allDayText: "{{ __('all-day') }}",

                // customize the button names,
                // otherwise they'd all just say "list"
                views: {
                    today: {
                        buttonText: "{{ __('tday') }}"
                    },
                    listDay: {
                        buttonText: "{{ __('day') }}"
                    },
                    listWeek: {
                        buttonText: "{{ __('week') }}"
                    },
                    listMonth: {
                        buttonText: "{{ __('month') }}"
                    },
                    listYear: {
                        buttonText: "{{ __('year') }}"
                    }
                },

                initialView: 'listDay',
                initialDate: moment().format('YYYY-MM-DD'),
                navLinks: true, // can click day/week names to navigate views
                editable: false,
                events: {!! json_encode($events) !!}
                    // [{
                    //         title: 'Meeting',
                    //         start: '2021-08-17T14:30:00',
                    //         end: '2021-08-17T15:30:00',
                    //         duration: '2:00',
                    //         extendedProps: {
                    //             status: 'done'
                    //         }
                    //     },
                    //     {
                    //         title: "Meeting",
                    //         start: "2021-09-18T10:30:00+00:00",
                    //         end: "2021-09-18T12:30:00+00:00",
                    //     },
                    //     {
                    //         title: 'Birthday Party',
                    //         start: '2021-09-18T07:00:00',
                    //         backgroundColor: 'yellow',
                    //         borderColor: 'green'
                    //     }
                    // ]
                    ,
                eventDidMount: function(info) {
                    if (info.event.extendedProps.status === 'done') {

                        // Change background color of row
                        info.el.style.backgroundColor = 'red';

                        // Change color of dot marker
                        var dotEl = info.el.getElementsByClassName('fc-event-dot')[0];
                        if (dotEl) {
                            dotEl.style.backgroundColor = 'white';
                        }
                    }
                },
                // events: [{
                //     // end: "2021-09-01 22:06:21",​​
                //     // ends_at: "2021-09-01 22:06:21"​​,
                //     // id: 1​​,
                //     // start: "2021-08-27 22:06:21"​​,
                //     // starts_at: "2021-08-27 22:06:21"​​,
                //     title: "ipsam laboriosam a",
                //     // title: 'repeating event 1',
                //     daysOfWeek: [1, 2, 3],
                //     duration: '00:30',
                // }],
                // [

                //     {
                //         title: 'repeating event 1',
                //         daysOfWeek: [1, 2, 3],
                //         duration: '00:30'
                //     },
                //     {
                //         title: 'repeating event 2',
                //         daysOfWeek: [1, 2, 3],
                //         duration: '00:30'
                //     },
                //     {
                //         title: 'repeating event 3',
                //         daysOfWeek: [1, 2, 3],
                //         duration: '00:30'
                //     }
                // ]
            });

            calendar.render();
        });


        $(".video_player").each(function(videoIndex) {
            var videoId = $(this).attr("id");
            // plyr = videojs(videoId);

            videojs(videoId).ready(function() {

                videojs(videoId).hlsQualitySelector();
                videojs(videoId).landscapeFullscreen();
                // videojs(videoId, {});
                this.on("play", function(e) {
                    //     videojs(this.player, {
                    //     controlBar: {
                    //         volumePanel: {
                    //         inline: false,
                    //         vertical: true
                    //         }
                    //     }
                    // });
                    //pause other video

                    $(".video_player").each(function(index) {
                        if (videoIndex !== index) {
                            // this.posterImage.show();
                            this.player.pause();
                        }
                    });
                });



            });


        });

        // Remove the transition class
        const square = document.querySelector('.video-card');
        if (square != null)
            square.classList.remove('square-transition');

        // Create the observer, same as before:
        const observer = new IntersectionObserver(entries => {
            // if(entries.length){
            entries.forEach(entry => {

                if (entry.isIntersecting) {

                    // $(".video-card").each(function(index){

                    entry.target.classList.add('square-transition');

                    // });

                    return;
                }

                // square.classList.remove('square-transition');
            });
        });

        $(".video-card").each(function(index) {

            observer.observe(this);
        });

        $('.streams-container').hide();
        var spinnerTimer = setTimeout(function() {
            $('.spin-8').hide();
            $('.streams-container').show();
            clearTimeout(spinnerTimer);

        }, 2000);
    </script>

    <script>
        $(function() {

            // var myVar = setInterval(myTimer, 1000 * 10);

            $('.btn-refresh').on('click', function() {
                location.reload();
            });

            function myTimer() {
                removeExpiredVideos();
                // notifyMe();
            }

            function removeExpiredVideos() {
                cards = $('#video-cards .video-card-wrapper');

                $('#video-cards .video-card-wrapper:has(video-js#v22)').remove();

            }

            let rendered_vid = '<x-channels.player :vidid="$active->id" :viddomid="' +
                '.$key.$active->id"' +
                ' :vidtitle="$active->title" :viddescription="$active->description"' +
                ' :vidposter="$active->poster_image_url" :video="$active" />';

            // $('#video-cards').prepend("herleo");
        });
    </script>

@endsection

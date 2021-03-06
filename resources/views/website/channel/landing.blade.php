@extends('layouts.website.index')

@section('title', 'Channel')

@section('styles')
    @livewireStyles

    <!--Video JS -->
    {{-- <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" /> --}}
    <link href="{{ asset('vendors/videojs/video.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendors/videojs/vim.css') }}" rel="stylesheet" />
    {{-- <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet"> --}}

    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" /> --}}
    <link href='{{ asset('vendors/fullcalendar/main.css') }}' rel='stylesheet' />

    <style>
        #loading {
            display: none;
        }

        #calendar {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 10px;
        }

        .tzo {
            color: #000;
        }

        #top {
            /* background: #eee; */
            /* border-bottom: 1px solid #ddd; */
            text-align: center;
            padding: 0 10px;
            line-height: 40px;
            font-size: 12px;
        }

        .video-playing-indicator {
            /* color: rgb(255, 68, 21); */
            opacity: 1;
            font-size: 13px;
            position: absolute;
            height: 50%;
            top: 1px;
            width: 25%;
            left: 0px;
            color: #ffce71 !important;
            text-shadow: 0px 0 1px #000, 0px 0 3px #fff;
            /* bottom: 2px; */
            /* bottom: 0px; */
            /* border:2px solid black; */
            /* border-radius: 8px; */
        }

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

        #collection-text {
            color: black;
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


        /* ----------- 0 - 295px ----------- */
        @media screen and (max-width: 295px) {
            .banner-section-wrapper {
                margin-top: 96px !important;

            }

            #menuTab a {
                border-radius: 0;

                /* max-width: 100% !important; */
            }

            .sticky-top {
                position: sticky;
                position: -webkit-sticky;
                /* top: 96px; */
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

        /* ----------- 296 - 450px ----------- */
        @media screen and (min-width: 296px) and (max-width: 499px) {
            #menuTab a {
                border-radius: 0;
                /* max-width: 100% !important; */
            }

            .sticky-top {
                position: sticky;
                position: -webkit-sticky;
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


                max-width: @if ($gize_channel->has_batch_videos) 400px @else 250px @endif !important;
                margin: 0 auto;
            }
        }

        /* ----------- 450 - 650px ----------- */
        @media screen and (min-width: 501px) and (max-width: 650px) {
            #menuTab {


                max-width: @if ($gize_channel->has_batch_videos) 400px @else 250px @endif !important;
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
                font-size: 2.1rem;
                text-shadow: 0 1px 5px black;
                font-weight: 500;
            }

            .channel-description {
                color: rgb(235, 235, 235);
                font-size: 1rem;
                text-shadow: 0 1px 5px black;
                font-weight: 400;
            }

            #menuTab {


                max-width: @if ($gize_channel->has_batch_videos) 400px @else 250px @endif !important;
                margin: 0 auto;
            }

        }

        /* ----------- 950px - 1200px ----------- */
        @media screen and (min-width: 951px) and (max-width: 1200px) {
            .channel-title {
                color: aliceblue;
                font-size: 2.1rem;
                text-shadow: 0 1px 5px black;
                font-weight: 500;
            }

            .channel-description {
                color: rgb(235, 235, 235);
                font-size: 1rem;
                text-shadow: 0 1px 5px black;
                font-weight: 400;
            }

            #menuTab {


                max-width: @if ($gize_channel->has_batch_videos) 400px @else 250px @endif !important;
                margin: 0 auto;
            }

        }

        /* ----------- 1200px + ----------- */
        @media screen and (min-width: 1201px) {
            .channel-title {
                color: aliceblue;
                font-size: 2.1rem;
                text-shadow: 0 1px 5px black;
                font-weight: 500;
            }

            .channel-description {
                color: rgb(235, 235, 235);
                font-size: 1rem;
                text-shadow: 0 1px 5px black;
                font-weight: 400;
            }

            #menuTab {


                max-width: @if ($gize_channel->has_batch_videos) 400px @else 250px @endif !important;
                margin: 0 auto;
            }

        }

        @media(max-width: 115px) {
            .video-card {
                /* min-width: 100% !important; */
            }
        }

        @media(max-width: 300px) {
            .channel-logo {
                width: 60px !important;
                height: 60px !important;
            }
        }

        @media screen and (min-width: 301px) and (max-width: 600px) {


            .channel-logo {
                width: 80px !important;
                height: 80px !important;

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
            background-image: url("{{ asset('storage/' . $gize_channel->logo_image_url) }}");
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
        <section
            style=" width: 100%; padding:0;
                    margin-top: -1px;
                    background-color: #faebd72e;
                    background-image: linear-gradient(to bottom, #00000000, #00000012, #0000008f), url({{ asset('storage/' . $gize_channel->banner_image_url) }});
                    height: 186px;
                    /* background-attachment: fixed; */
                    background-position: center center;
                    background-size: cover;

                                                                                                                                                                                            "
            class=" mb-3 pb-0 w:100 jumbotron text-center channel-banner">
            <div style=" ">

                <div class="d-flex align-items-center flex-column bd-highlight ">
                    <div class="mb-auto p-2 bd-highlight">
                        <h3 class="channel-title my-auto mt-sm-3">
                            {{ app()->getLocale() == 'am' ? $gize_channel->name : $gize_channel->name_en }}</h3>

                        <p class="channel-description lead">@if ($gize_channel->producer != null || $gize_channel->producer != ''){{ __('Producer') }} - {{ $gize_channel->producer }}@endif</p>

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
    <ul class="nav nav-pills nav-justified sticky-top mt-4" id="menuTab" role="tablist">
        {{-- <li class="nav-item" role="presentation">
            <a class="nav-link active" id="my-streams-tab" data-toggle="tab" href="#my-streams" role="tab"
                aria-controls="my-streams" aria-selected="true">
                <i class="mr-1 mb-2 fa fa-minus d-none video-playing-indicator"></i>
                {{ __('My Videos') }}
            </a>
        </li> --}}
        {{-- @if ($gize_channel->has_batch_videos)

            <li class="nav-item" role="presentation">
                <a class="nav-link" id="schedule-tab" data-toggle="tab" href="#schedule" role="tab"
                    aria-controls="schedule" aria-selected="false">{{ __('Schedule') }}</a>
            </li>
        @endif --}}
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="archive-tab" data-toggle="tab" href="#archive" role="tab"
                aria-controls="archive" aria-selected="?????????">{{ __('Archive') }}</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab"
                aria-controls="about" aria-selected="false">{{ __('About Channel') }}</a>
        </li>
    </ul>


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













                <div class="tab-content">

                    <div class="tab-pane  mt-4" id="my-streams" role="tabpanel" aria-labelledby="my-streams-tab">
                        @auth
                            {{-- @if ($gize_channel->has_batch_videos)
                                <h4 class="">{{ __('My Streamed Videos') }}</h4>

                                <h6 class="
                                    text-muted mb-0">
                                    {{ __('Videos available for you to watch from this channel') }}
                                    <button class="btn btn-xs btn-outline-info btn-refresh float-right mr-2 mt-1">
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
                                            class=""></path>
                                    </svg>
                                </div>
                                <div class="
                                            streams-container">

                                    <div class=" grid-container">
                                        @if ($activevideos->count() == 0)
                                            <div>

                                                <p class="text-center text-muted">
                                                    {{ __('Videos not available for now') }}<br />
                                                    {{ __('If you have already subscribed please check your schedule.') }}
                                                </p>
                                                <p class="text-center text-muted">
                                                    <a class="btn btn-sm btn-outline-secondary"
                                                        href="{{ route('web.home') }}">
                                                        {{ __('Go back to home') }}
                                                    </a>
                                                    <button class="btn btn-refresh btn-sm btn-outline-secondary">
                                                        {{ __('Reload') }}
                                                    </button>
                                                </p>

                                            </div>
                                        @endif
                                        <div id="video-cards" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 ">

                                            @for ($i = 0; $i < $activevideos->count(); $i++)

                                                @php
                                                    $active = $activevideos[$i];
                                                    $key = $i;
                                                @endphp

                                                <x-channels.player :vidid="$active->id" :viddomid="'v'.$key.$active->id"
                                                    :vidtitle="$active->title" :viddescription="$active->description"
                                                    :vidposter="$active->poster_image_url" :video="$active" />



                                            @endfor
                                        </div>

                                    </div>

                                </div>
                            @endif --}}

                        @endauth

                        @guest
                            {{ __('Plase login to access this section.') }} <a href="{{ route('login') }}"></a>
                        @endguest

                    </div>
                    @if ($gize_channel->has_batch_videos)
                        <div class="tab-pane mt-4" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
                            @auth

                                <div class="container">
                                    @if (app()->getLocale() == 'am')
                                        <div style="opacity: 1; color: black;"
                                            class="text-center alert alert-info alert-dismissible">
                                            <button type="button" style="color: black;" class="close "
                                                data-dismiss="alert" aria-hidden="true">??</button>
                                            ????????????????????? ???????????? ?????? ?????? ???????????? 6???00 ???????????? ?????? ?????????????????? ????????? ??????????????? ???????????? 12???00 ???????????? ?????? ??????????????? 12???00
                                            ?????????
                                            ??????
                                            ?????????????????? ????????? ??????????????? ???????????? 6 ????????? ????????? ?????????????????? ?????? ????????????
                                        </div>
                                    @endif
                                </div>

                                <div id="schedule_calendar"></div>
                            @endauth
                            @guest
                                {{ __('Plase login to access this section.') }} <a href="{{ route('login') }}"></a>
                            @endguest
                        </div>
                    @endif
                    <div class="tab-pane active  mt-6" id="archive" role="tabpanel" aria-labelledby="archive-tab">
                        <div class="container">



                            <div class=" pt-4  pb-4">
                                <div class="">
                                    @if($collections->count())
                                    <h4 class="mt-5">{{ __('Bundle Videos From This Channel') }}</h4>
                                    <h6 class=" text-muted mb-0">
                                        {{ __('Series Video Collection Grouped in the form of a Book/Chapters or Season/Episoids') }}
                                        <button class="btn btn-xs btn-outline-info btn-refresh float-right mr-2 mt-1">
                                            <i class="fa fa-recycle"></i> {{ __('Reload') }}
                                        </button>
                                    </h6>
                                    <hr />
                                    @endif

                                    <div class="  flex-row justify-content-between">
                                            @foreach ($collections as $collection)

                                                <div style="">

                                                    <x-channels.collection-card :channel="$gize_channel"
                                                    :collection="$collection"
                                                    />

                                                </div>



                                            @endforeach
                                    </div>
                                </div>
                            </div>
                            <h4 class="mt-3">{{ __('Archive') }}</h4>
                            <h6 class=" text-muted mb-0">
                                {{ __('Video archives from this channel') }}
                                <button class="btn btn-xs btn-outline-info btn-refresh float-right mr-2 mt-1">
                                    <i class="fa fa-recycle"></i> {{ __('Reload') }}
                                </button>
                            </h6>
                            <hr />

                            <div class=" grid-container">
                                @if ($archives->count() == 0)
                                    <div>

                                        <p class="text-center text-muted">
                                            {{ __('There are no videos in archive') }}<br />
                                        </p>
                                        <p class="text-center text-muted">
                                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('web.home') }}">
                                                {{ __('Go back to home') }}
                                            </a>
                                            <button class="btn btn-refresh btn-sm btn-outline-secondary">
                                                {{ __('Reload') }}
                                            </button>
                                        </p>

                                    </div>
                                @endif

                                <div id="archive-cards" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 ">


                                    @for ($i = 0; $i < $archives->count(); $i++)
                                        @php
                                            $archive = $archives[$i];
                                            $key = $i;
                                        @endphp

                                        @if ($archive->is_free)


                                            <a href="{{ url('/play?v=' . $archive->hashid) }}" class=" "
                                                vid_id="{{ $archive->id }}" vid_title="{{ $archive->title }}"
                                                vid_duration="{{ $archive->duration }}" vid_host="{{ $archive->trainer }}"
                                                vid_image_url="{{ asset('storage/' . $archive->thumb_image_url) }}"
                                                vid_channel="{{ $archive->gize_channel_id }}"
                                                vid_channel_file_url="{{ $archive->file_url != null ? $archive->file_url : '' }}"
                                                vid_channel_name="{{ $archive->gizeChannel->name }}"
                                                vid_channel_logo="{{ $archive->gizeChannel->logo_image_url }}">

                                                <x-channels.archivecard :archivevid="$archive" />

                                            </a>

                                        @else
                                            {{-- <a href="javascript: void(0);" class="archivevid"
                                                vid_title="{{ $archive->title }}" vid_duration="{{ $archive->duration }}"
                                                vid_host="{{ $archive->trainer }}"
                                                vid_image_url="{{ asset('storage/' . $archive->thumb_image_url) }}"
                                                vid_channel="{{ $archive->gize_channel_id }}"
                                                vid_channel_name="{{ $archive->gizeChannel->name }}"
                                                vid_channel_logo="{{ $archive->gizeChannel->logo_image_url }}">

                                                <x-channels.archivecard :archivevid="$archive" />
                                            </a> --}}
                                        @endif



                                    @endfor
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane mt-4" id="about" role="tabpanel" aria-labelledby="about-tab">
                        <div class="container">

                            <div class="col-12  order-1 ">
                                <h4 class=""> {{ $gize_channel->name }}</h4>
                                <p class="
                                    text-muted">
                                    {{ $gize_channel->description }}</p>
                                <br>
                                <div class="text-muted">
                                    @if ($gize_channel->producer != null || $gize_channel->producer != '')
                                        <p class="text-sm">{{ __('Producer') }}
                                            <b class="d-block">{{ $gize_channel->producer }}</b>
                                        </p>
                                    @endif
                                    <p class="text-sm">{{ __('Phone Number') }}
                                        <b class="d-block">{{ $gize_channel->phone_number }}</b>
                                    </p>
                                    <p class="text-sm">{{ __('Contact Address') }}
                                        <b class="d-block">{{ $gize_channel->contact_address }}</b>
                                    </p>
                                    <p class="text-sm">{{ __('Website') }}
                                        <b class="d-block">{{ $gize_channel->website }}</b>
                                    </p>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection


@section('modals')






@endsection


@section('js')

    <!-- Video JS -->

    {{-- <script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script> --}}
    <script src="{{ asset('vendors/videojs/video.min.js') }}"></script>
    {{-- <script src="https://unpkg.com/video.js/dist/video.js"></script> --}}

    {{-- <script src="https://unpkg.com/@videojs/http-streaming@2.8.0/dist/videojs-http-streaming.min.js"></script> --}}
    <script src="{{ asset('vendors/videojs/videojs-http-streaming.min.js') }}"></script>

    <script
        {{-- src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-quality-levels/2.1.0/videojs-contrib-quality-levels.min.js"> --}}
        src="{{ asset('vendors/videojs/videojs-contrib-quality-levels.min.js') }}">
    </script>

    {{-- <script src="https://unpkg.com/videojs-hls-quality-selector@1.0.5/dist/videojs-hls-quality-selector.min.js"></script> --}}
    <script src="{{ asset('vendors/videojs/videojs-hls-quality-selector.min.js') }}"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/videojs-landscape-fullscreen@11.1.0/dist/videojs-landscape-fullscreen.min.js">
    </script> --}}
    <script src="{{ asset('vendors/videojs/videojs-landscape-fullscreen.min.js') }}">
    </script>


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> --}}
    <script src='{{ asset('vendors/fullcalendar/main.js') }}'></script>
    <script src='{{ asset('vendors/fullcalendar/locales/am-et.js') }}'></script>




    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script> --}}

    <script>
        // alert("{{ \App::getLocale() }}")
        let playstates = [];
        document.addEventListener('DOMContentLoaded', function() {
            // declare var FullCalendar: any;

            var initialTimeZone = 'local';
            var timeZoneSelectorEl = document.getElementById('time-zone-selector');
            var loadingEl = document.getElementById('loading');
            // var calendarEl = document.getElementById('calendar');

            var calendarEl = document.getElementById('schedule_calendar');
            // console.log({!! json_encode($events) !!});
            var calendar = new FullCalendar.Calendar(calendarEl, {
                height: 'auto',
                themeSystem: 'bootstrap',
                // stickyHeaderDates: false, // for disabling
                timeZone: initialTimeZone,
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
                noEventsText: "{{ __('There are no schedules available.') }}",

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

                initialView: 'listWeek',
                initialDate: moment().format('YYYY-MM-DD'),
                navLinks: true, // can click day/week names to navigate views
                editable: false,
                events: {!! json_encode($events) !!},
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

            });

            calendar.render();

            // load the list of available timezones, build the <select> options
            // it's highly encouraged to use your own AJAX lib instead of using FullCalendar's internal util
            // FullCalendar.requestJson('GET', 'https://fullcalendar.io/demo-timezones.json', {}, function(timeZones) {
            //     timeZones.forEach(function(timeZone) {
            //         var optionEl;

            //         if (timeZone !== 'UTC') { // UTC is already in the list
            //             optionEl = document.createElement('option');
            //             optionEl.value = timeZone;
            //             optionEl.innerText = timeZone;
            //             timeZoneSelectorEl.appendChild(optionEl);
            //         }
            //     });
            // }, function() {
            //     // failure
            // });

            // when the timezone selector changes, dynamically change the calendar option
            // timeZoneSelectorEl.addEventListener('change', function() {
            //     console.log('changing timezone');
            //     calendar.setOption('timeZone', this.value);
            // });
        });


        $(".video_player").each(function(videoIndex) {
            var videoId = $(this).attr("id");
            // plyr = videojs(videoId);

            videojs(videoId).ready(function() {

                videojs(videoId).hlsQualitySelector();
                videojs(videoId).landscapeFullscreen();

                let playstate = {};
                playstate.videoId = videoId;
                playstate.sent_started_status = false;
                playstate.sent_completed_status = false;
                playstate.started = false;
                playstate.completed = false;
                playstates.push(playstate);

                // videojs(videoId, {});
                this.on("pause", function(e) {
                    let some_player_is_playing = false;

                    $(".video_player").each(function(index) {

                        if (!this.player.paused()) {

                            some_player_is_playing = true;
                        }

                    });
                    if (some_player_is_playing) {
                        $(".video-playing-indicator").removeClass('d-none');
                        // $(".video-playing-indicator").addClass('d-none');
                        // $(".video-playing-indicator").show();

                    } else {
                        // $(".video-playing-indicator").removeClass('d-none');
                        $(".video-playing-indicator").addClass('d-none');
                        // $(".video-playing-indicator").hide();


                    }
                });
                // var seen = false;
                // var sent_seen_status = false;

                // var started = false;
                // var sent_started_status = false;
                // this.sent_seen_status = false;

                var user_id = "{{ auth()->user()->id }}";

                this.on('timeupdate', function() {

                    //get playstate
                    let playstate = playstates.find(playstate => playstate.videoId === videoId);

                    // console.log(playstate);
                    // $('.lbl-time').html(playstate);
                    // $('.lbl-time').html(this.currentTime() + ' / ' + this.duration());

                    //Mark Started
                    if (playstate.started == true && playstate.sent_started_status == false) {


                        //send started state
                        if (this.hasClass('rental_player')) {
                            console.log("Started!!!");
                            // alert('started');
                            sent_started_status = true;

                            // alert('started');
                            //Mark Started
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                }
                            });

                            let channelvideo_rental_id = this.tagAttributes.rid;
                            console.log(channelvideo_rental_id);


                            let url =
                                " {{ route('rental.markstarted', ['user_id' => ':user_id', 'channelvideo_rental_id' => ':channelvideo_rental_id']) }}";

                            url = url.replace(':user_id', user_id);
                            url = url.replace(':channelvideo_rental_id', channelvideo_rental_id);


                            $.ajax({
                                url: url,
                                type: 'POST',
                                success: function(res) {
                                    // console.log(res);
                                    if ($("video-js[rid='" + channelvideo_rental_id +
                                            "']").parents('.card')
                                        .find('.status-indicator').hasClass(
                                            'text-danger')) {
                                        $("video-js[rid='" + channelvideo_rental_id +
                                                "']").parents('.card')
                                            .find('.status-indicator')
                                            .removeClass('text-danger')
                                            .addClass('text-warning');
                                        $("video-js[rid='" + channelvideo_rental_id +
                                                "']").parents('.card')
                                            .find('.status-text').html("{{ __('Started Watching') }}");
                                    }


                                }
                            });


                            playstate.sent_started_status = true;
                            playstates.forEach((item, index) => {
                                if (item.videoId === playstate.videoId) {
                                    playstates[index] = playstate;
                                }
                            });
                            if ($("video-js[rid='" + channelvideo_rental_id + "']")
                                .parents('.card')
                                .find('.status-indicator')
                                .hasClass('text-danger')) {

                                $("video-js[rid='" + channelvideo_rental_id + "']")
                                    .parents('.card')
                                    .find('.status-indicator')
                                    .removeClass('text-danger')
                                    .addClass('text-warning');

                                $("video-js[rid='" + channelvideo_rental_id +
                                        "']").parents('.card')
                                    .find('.status-text').html("{{ __('Started Watching') }}");

                            }

                        } else if (this.hasClass('batch_player')) {
                            let url =
                                "{{ route('batchvideo.markstarted', ['batch_channelvideo_id' => ':batch_channelvideo_id']) }}";

                            let batch_channelvideo_id = this.tagAttributes.bsid;

                            url = url.replace(':batch_channelvideo_id', batch_channelvideo_id);

                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    batch_channelvideo_id: batch_channelvideo_id,
                                },
                                success: function(response) {

                                }
                            });
                            playstate.sent_started_status = true;
                            playstates.forEach((item, index) => {
                                if (item.videoId === playstate.videoId) {
                                    playstates[index] = playstate;
                                }
                            });
                        }


                    }
                    if (this.currentTime() > 15) {
                        playstate.started = true;
                        playstates.forEach((item, index) => {
                            if (item.videoId === playstate.videoId) {
                                playstates[index] = playstate;
                            }
                        });
                    }
                    //Mark Completed
                    if (playstate.completed == true && playstate.sent_completed_status == false) {

                        //send completed state
                        if (this.hasClass('rental_player')) {


                            //Mark Completed
                            // let user_id = "{{ auth()->user()->id }}";
                            let channelvideo_rental_id = this.tagAttributes.rid;
                            let url =
                                " {{ route('rental.markcompleted', ['user_id' => ':user_id', 'channelvideo_rental_id' => ':channelvideo_rental_id']) }}";

                            url = url.replace(':user_id', user_id);
                            url = url.replace(':channelvideo_rental_id', channelvideo_rental_id);

                            // alert(url);
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                }
                            });

                            $.ajax({
                                url: url,
                                type: 'POST',
                                success: function(res) {
                                    // console.log(res);

                                        $("video-js[rid='" + channelvideo_rental_id +"']")
                                            .parents('.card')
                                            .find('.status-indicator')
                                            .removeClass('text-warning')
                                            .removeClass('text-danger')
                                            .addClass('text-success');

                                        $("video-js[rid='" + channelvideo_rental_id +
                                            "']").parents('.card')
                                        .find('.status-text').html("{{ __('Watched') }}");

                                        // console.log('playing rental video');


                                }
                            });
                            playstate.sent_completed_status = true;
                            playstates.forEach((item, index) => {
                                if (item.videoId === playstate.videoId) {
                                    playstates[index] = playstate;
                                }
                            });

                            $("video-js[rid='" + channelvideo_rental_id +"']")
                                .parents('.card')
                                .find('.status-indicator')
                                .removeClass('text-warning')
                                .removeClass('text-danger')
                                .addClass('text-success');
                            $("video-js[rid='" + channelvideo_rental_id +
                            "']").parents('.card')
                                .find('.status-text').html("{{ __('Watched') }}");

                        } else if (this.hasClass('batch_player')) {
                            let url =
                                "{{ route('batchvideo.markcompleted', ['batch_channelvideo_id' => ':batch_channelvideo_id']) }}";

                            let batch_channelvideo_id = this.tagAttributes.bsid;

                            url = url.replace(':batch_channelvideo_id', batch_channelvideo_id);

                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    batch_channelvideo_id: batch_channelvideo_id,
                                },
                                success: function(response) {

                                }
                            });
                            playstate.sent_completed_status = true;
                            playstates.forEach((item, index) => {
                                if (item.videoId === playstate.videoId) {
                                    playstates[index] = playstate;
                                }
                            });
                        }


                    }
                    if ((this.duration() - this.currentTime()) < 30) {

                        playstate.completed = true;
                        playstates.forEach((item, index) => {
                            if (item.videoId === playstate.videoId) {
                                playstates[index] = playstate;
                            }
                        });
                    }
                });
                this.on('ended', function() {




                    $(".video-playing-indicator").addClass('d-none');




                });
                this.on("play", function(e) {



                    //pause other video

                    if (this.hasClass('rental_player')) {
                        // console.log('playing rental video');




                        // alert($("video-js[rid='"+channelvideo_rental_id+"']").parents('.card').find('.status-indicator').hasClass('text-danger'));
                        parentCardEl = $("video-js[rid='" + channelvideo_rental_id + "']").parents(
                            '.card');

                        if (parentCardEl.find('.status-indicator').hasClass('text-success') ||
                            parentCardEl.find('.status-indicator').hasClass('text-warning')) {


                            parentCardEl.find('.show-expiretime').addClass('d-none');
                            let url =
                                " {{ route('rental.getendtime', ['user_id' => ':user_id', 'channelvideo_rental_id' => ':channelvideo_rental_id']) }}";
                            url = url.replace(':user_id', user_id);
                            url = url.replace(':channelvideo_rental_id', channelvideo_rental_id);

                            $.ajax({
                                url: url,
                                delay: 250,
                                type: 'POST',
                                success: function(res) {
                                    console.log(res);
                                    $("video-js[rid='" + channelvideo_rental_id + "']")
                                        .parents('.card').find('.show-endtime .time')
                                        .html(res);

                                    $("video-js[rid='" + channelvideo_rental_id + "']")
                                        .parents('.card').find('.show-endtime')
                                        .removeClass('d-none');

                                }
                            });
                        }

                    }
                    let some_player_is_playing = false;

                    $(".video_player").each(function(index) {
                        if (videoIndex !== index) {
                            // this.posterImage.show();
                            this.player.pause();
                        }
                        if (!this.player.paused()) {

                            some_player_is_playing = true;
                        }
                    });
                    if (some_player_is_playing) {
                        $(".video-playing-indicator").removeClass('d-none');
                        // $(".video-playing-indicator").addClass('d-none');
                        // $(".video-playing-indicator").show();


                    } else {
                        // $(".video-playing-indicator").removeClass('d-none');
                        $(".video-playing-indicator").addClass('d-none');
                        // $(".video-playing-indicator").hide();


                    }
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

        }, 80);
    </script>

    <script>
        $(function() {

            $('.popover-dismiss').popover({
                trigger: 'focus'
            })

            // var player = videojs("my-video", {
            //     // autoplay: "muted",
            //     autoplay: false,
            //     fluid: true
            // });

            var modal_vidtitle;
            var modal_vidduration;
            var modal_vidhost;

            $('.archivevid').on('click', function(e) {
                e.preventDefault();
                vidtitle = $(this).attr('vid_title');
                vidid = $(this).attr('vid_id');
                // vidid = 7;
                // alert( $(this).attr('vid_title'));
                vidduration = $(this).attr('vid_title');
                vidhost = $(this).attr('vid_host');
                vidimage_baseurl = "{{ asset('storage/') }}";
                img_url = $(this).attr('vid_image_url');
                vidimage_url = vidimage_baseurl + (img_url != null && img_url != '') ? img_url :
                    'images/c/channelvideo.png';
                viddomid = "f" + vidid;

                source =
                    `{{ route('video.batch.playlist', [
                        'vid_id' => ':vidid',
                        'gize_channel_id' => $gize_channel->id,
                    ]) }}`;

                source = source.replace(':vidid', vidid);
                new_vidid = moment.now();

                file_url = $(this).attr('vid_channel_file_url');

                if (file_url != '') {
                    html = `<video-js
                                style="height: inherit;"
                                id="f${new_vidid}"
                                class="video-js free-video vim-css vjs-big-play-centered vjs-fluid"
                                controls
                                preload="auto"
                                width="auto"
                                height="264"
                                poster="${vidimage_url}"
                                data-setup="{}">
                                <source src="${source}" type="application/x-mpegURL">
                            </video-js>`;

                } else {
                    html = `<video
                                id="f${new_vidid}"
                                class="video-js video_player rental_player vjs-default-skin vjs-big-play-centered vjs-fluid"
                                controls
                                preload="auto"
                                width="auto"
                                height="264"
                                poster="${vidimage_url}"
                                data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "${file_url}"}], "youtube": { "customVars": { "wmode": "transparent" } } }'
                                >
                            </video>`;

                }
                // alert(html);

                if ($(this).hasClass('isfree')) {
                    // alert("isfree");

                    // var oldPlayer = $('.free-video');
                    // videojs(oldPlayer).dispose();

                    Swal.fire({
                        title: '<span style="font-size: 0.55em;color: #b7b6b6;font-weight: 600;">' +
                            vidtitle + '</span>',
                        // background: `#fff url(${vidimage_url}) `,
                        allowOutsideClick: false,
                        showCloseButton: true,
                        showConfirmButton: false,

                        backdrop: `
                            rgba(0,0,0,0.88)
                        `,
                        html: html,


                        showClass: {
                            popup: 'animate__faster animate__animated animate__fadeIn'
                        },
                        hideClass: {
                            popup: 'animate__faster animate__animated animate__fadeOut'
                        }
                    });

                    var parent_modal = $("#f" + new_vidid).parents('.swal2-popup .swal2-modal');
                    $("#f" + new_vidid).parents('.swal2-popup').css({
                        "background-color": "transparent",
                        "padding": "0",

                        "width": "100%",
                        "max-width": "50em"
                    });
                    $("#f" + new_vidid).parents('.swal2-popup .swal2-content').css({
                        // "height": "100%",
                        // "font-size": "200%",
                        "padding": "0"
                    });
                    $("#f" + new_vidid).parents('.swal2-popup').find('swal2-content').css({
                        "padding": "0 !important",
                        "width": "100%",
                    });
                    $("#f" + new_vidid).parents('.swal2-popup').find('.swal2-title').css({
                        "color": "#eee"
                    });


                    var player = videojs("f" + new_vidid, {
                        // autoplay: "muted",
                        autoplay: false,
                        fluid: true
                    });
                    videojs("f" + new_vidid).ready(function() {
                        videojs("f" + new_vidid).hlsQualitySelector();
                        videojs("f" + new_vidid).landscapeFullscreen();

                        this.on("play", function(e) {

                            $(".video_player").not(".free_video").each(function(index) {
                                if (!this.player.paused()) {
                                    // this.posterImage.show();
                                    this.player.pause();

                                    // some_player_is_playing = true;
                                    $(".video-playing-indicator").addClass(
                                        'd-none');

                                }
                            });
                        });
                    });

                } else {
                    // alert("not free");
                    Swal.fire({
                        // position: 'top-end',
                        // toast: true,
                        icon: 'warning',
                        title: window.modal_vidtitle,
                        confirmButtonText: "{{ __('OK') }}",

                        html: "(" + vidduration + ") {{ __('by') }} " + vidhost +
                            "<br/>  " +
                            ` <div>
                                            <p>{{ __('Would you like to watch this video?') }}</p>
                                            <hr/>
                                            <p class="px-2 ">
                                                <u>{{ __('Contact us') }}</u><br/>
                                                <span>{{ __('Phone Number') }}: {{ $gize_channel->phone_number }}</span><br/>
                                                <span>{{ __('Address') }}: {{ $gize_channel->contact_address }}</span>
                                            </p>

                                        </div>`,
                        showConfirmButton: true,
                        // timer: 1500
                    });
                }



                // $("#archiveDetailModal").modal('show');

                // alert($(this).attr('vid_title'));
            });


            function onHashChange() {
                var hash = window.location.hash;

                if (hash) {
                    // using ES6 template string syntax
                    $(`[data-toggle="tab"][href="${hash}"]`).trigger('click');
                }

            }

            window.addEventListener('hashchange', onHashChange, false);
            onHashChange();

            // if ({!! $activerentals->count() !!}) {
            //     var rentalcheker = setInterval(chkRentalTimer, 1000 * 15);
            //     var endtimecheker = setInterval(updateEndingTime, 1000 * 10);

            // }


            // var validStreamcheker = setInterval(chkValidStreamTimer, 1000 * 20);
            var validStreamcheker = setInterval(rond, 1000 * 20);

            function rond(){
                if ({!! $activerentals->count() !!}) {
                    chkRentalTimer();
                    updateEndingTime();
                }
                chkValidStreamTimer();
            }


            $('.btn-refresh').on('click', function() {
                location.reload();
            });

            function updateEndingTime(rid) {
                let user_id = "{{ auth()->user()->id }}";
                let rental_vids = $(".rental_player");
                // console.log(rental_vids);

                rental_vids.each(function(i) {
                    channelvideo_rental_id = $(this).attr('rid');

                    let url =
                        " {{ route('rental.getendtime', ['user_id' => ':user_id', 'channelvideo_rental_id' => ':channelvideo_rental_id']) }}";
                    url = url.replace(':user_id', user_id);
                    url = url.replace(':channelvideo_rental_id', channelvideo_rental_id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url,
                        delay: 250,
                        type: 'POST',
                        success: function(res) {
                            console.log(res);
                            $("video-js[rid='" + channelvideo_rental_id + "']")
                                .parents('.card').find(' .endtime')
                                .html(res);


                        }
                    });
                });
            }

            function chkRentalTimer() {
                // console.log("remoing");
                let rental_vids = $(".rental_player");

                active_rental_vids = [];


                // console.log(rental_vids);
                rental_vids.each(function(i) {

                    rid = $(this).attr('rid');

                    let url =
                        "{{ route('rental.check', ['user_id' => auth()->user()->id, 'channelvideo_rental_id' => ':channelvideo_rental_id']) }}";
                    url = url.replace(':channelvideo_rental_id', rid);

                    let that = this;
                    console.log(url);
                    $.ajax({
                        type: 'GET',
                        url: url,


                        success: function(response) {
                            console.log(response);
                            if (response == "0") {
                                console.log('clearing');
                                $(that).parents('.video-card').remove();
                                console.log('active_rental_vids.length: ' + active_rental_vids
                                    .length);

                                if (active_rental_vids.length ==
                                    0) { //if the removed one is the last one....
                                    text = `<div>

                                            <p class="text-center text-muted">
                                                {{ __('You have no rental videos available') }}<br />
                                                {{ __('If you would like to rent videos please contact the channel admin.') }}
                                            </p>
                                            <p class="text-center text-muted">
                                                <a class="btn btn-sm btn-outline-secondary"
                                                    href="{{ route('web.home') }}">
                                                    {{ __('Go back to home') }}
                                                </a>
                                                <button class="btn btn-refresh btn-sm btn-outline-secondary" >
                                                    {{ __('Reload') }}
                                                </button>
                                            </p>

                                            </div>`;
                                    $('.rentals-container').html(text);
                                }
                                // removeExpiredVideos(rid);
                                // clearInterval(chkRentalTimer);
                                // clearInterval(endtimecheker);

                            }
                        }

                    });

                });



                // notifyMe();
            }

            function chkValidStreamTimer() {
                // alert('here');
                let batch_stream_vids = $(".batch_player");

                active_vids = [];
                batch_stream_vids.each(function(i) {
                    active_vids.push($(this).attr('bsid'));
                });
                // console.log(active_vids);

                batch_stream_vids.each(function(i) {

                    batch_channelvideo_id = $(this).attr('bsid');
                    // alert(batch_channelvideo_id);

                    slug = '{{ $gize_channel->slug }}';
                    let url =
                        "{{ route('channel.validstream.check', ['slug' => ':slug', 'batch_channelvideo_id' => ':batch_channelvideo_id']) }}";
                    url = url.replace(':batch_channelvideo_id', batch_channelvideo_id);
                    url = url.replace(':slug', slug);

                    let that = this;

                    $.ajax({
                        type: 'GET',
                        url: url,

                        success: function(response) {
                            if (response == 0) {
                                target = $(that).parents('.video-card-wrapper');
                                target.hide('slow', function() {
                                    target.remove();
                                });
                                // .remove();
                                // removeExpiredVideos(rid);
                                // clearInterval(validStreamcheker);
                                // console.log(active_vids.length);
                                if (active_vids.length ==
                                    1) { //if the removed one is the last one....
                                    text = `<div>

                                        <p class="text-center text-muted">
                                            {{ __('Videos not available for now') }}<br />
                                            {{ __('If you have already subscribed please check your schedule.') }}
                                        </p>
                                        <p class="text-center text-muted">
                                            <a class="btn btn-sm btn-outline-secondary"
                                                href="{{ route('web.home') }}">
                                                {{ __('Go back to home') }}
                                            </a>
                                            <button class="btn btn-refresh btn-sm btn-outline-secondary" >
                                                {{ __('Reload') }}
                                            </button>
                                        </p>

                                        </div>`;
                                    $('.streams-container').html(text);
                                }

                            }
                        }
                    });

                });


            }


            function removeExpiredVideos(rid = 0) {
                if (rid) {

                    cards = $('#video-cards .video-card-wrapper');

                    $("#video-cards .video-card-wrapper:has(video-js[rid='" + rid + "'])").remove();
                }

            }

            let rendered_vid = '<x-channels.player :vidid="$active->id" :viddomid="' +
                '.$key.$active->id"' +
                ' :vidtitle="$active->title" :viddescription="$active->description"' +
                ' :vidposter="$active->poster_image_url" :video="$active" />';

            // $('#video-cards').prepend("herleo");
        });
    </script>

@endsection

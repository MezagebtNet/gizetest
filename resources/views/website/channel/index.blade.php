@extends('layouts.website.index')

@section('title', 'Overview')

@section('styles')
    @livewireStyles

    <!--Video JS -->
    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />

    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->

    <style>
        @media(max-width: 600px) {
            .video-card {
                /* min-width: 100% !important; */
                max-width: 100% !important;
            }

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

        .video-card {
            min-width: 18rem;
            max-width: 22rem;
        }

        .channel-card {
            min-width: 200px;
            max-width: 200px;
            /* margin: 0 auto; */
            /* Added */
            float: none;
            /* Added */
            margin-bottom: 10px;
            /* Added */
        }

        .channel-title {
            color: aliceblue;
            font-size: 1.5rem;
        }

        .channel-description {
            color: rgb(235, 235, 235);
            font-size: 1rem;
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

    </style>

@endsection

@section('navbar')
    @include('website.navbar')
@endsection

@section('notifications-dropdown')
    {{-- @include('admin.notifications-dropdown') --}}
@endsection


@section('content')

    <div class="">
        <section class="mb-3 pb-0 w:100 jumbotron text-center channel-banner" style=" width: 100%;
                                background-image: linear-gradient(to bottom, #0000006b, #0000007d, #000000d6), url({{ asset('assets/image/background.jpg') }});
                            " style="">
            <div class="d-flex align-items-center flex-column bd-highlight ">
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
            <div class="d-flex flex-column bd-highlight ">

                <div class="dropdown channel-menu ">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">{{ __('Streaming Schedule') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Rentals') }}</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="px-4 pt-4 pt-5 pb-4">

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

                <h2 class="pt-2">{{ __('My Streamed Videos') }}</h2>
                <h6 class="text-muted mb-0">{{ __('Videos available for you to watch from this channel') }}</h6>


                <hr />
                <div class="row grid-container">
                    {{-- <div class="justify-content-sm-center"> --}}
                    {{-- <center> --}}
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 ">
                        @foreach ($activevideos as $video)
                            <x-channels.player :vidid="'vid'.$video->id" :vidtitle="$video->title"
                                :viddescription="$video->description" />

                        @endforeach
                    </div>
                    {{-- </center> --}}
                    {{-- </div> --}}
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

    <script>
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
    </script>
@endsection

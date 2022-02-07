@extends('layouts.website.index')

@section('seo')

    {{-- {!! SEOMeta::generate() !!} --}}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}

    {!! SEO::generate(true) !!}

@endsection

@section('title', 'Home')

@section('styles')
    <!--Video JS -->
    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />
    <link href="{{ asset('vendors/videojs/vim.css') }}" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('storage/favicon.png') }}" >

    <style>
        .grow {
            transition: all .2s ease-in-out;
        }

        .grow:hover,
        .grow:focus {
            transform: scale(1.02);
        }

        .channel-card:hover,
        .channel-card:focus {
            border-color: rgba(255, 175, 2);
            /* border: red groove ; */
            box-shadow: 0 0px 7px rgba(248, 221, 164);
            /* box-shadow: 0 0px 12px rgba(205, 200, 185, 0.09); */
            cursor: pointer;
            text-decoration: none;
            background-color: rgba(255, 243, 134, 0.162);
            /* border:1px solid gray */
        }

        a.channel-card-link {
            text-decoration: none;
            color: black;
        }

        .channel-card {
            min-height: 230px;
            max-height: 230px;
            /* margin: 0 auto; */
            /* Added */
            float: none;
            /* Added */
            margin-bottom: 10px;
            /* Added */
            border-radius: 16px;

            max-width: 350px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 16px;

        }

        article.card-body {
            border-radius: 16px;
            border: 1px solid #c3c3c3;
            background-color: #fff;
        }

        .dark-mode .channel-card {
            border-radius: 16px;
            border: 1px solid #545454;
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

        .carousel-item{
            height: 230px;
        }




    </style>

@endsection

@section('navbar')
    @include('website.navbar')
@endsection




@section('content')
<div class="banner-section-wrapper">
    <section
        style=" width: 100%; padding:0;
                margin-top: -1px;
                background-color: #faebd72e;
                background-image: linear-gradient(to bottom, #0000, #fff0, #000000b5), url({{ asset('storage/images/bg3.jpg') }});
                height: 230px;
                /* background-attachment: fixed; */
                background-position: center center;
                background-size: cover;
                border-radius: 0;"

        class=" mb-3 pb-0 w:100 jumbotron text-center channel-banner">
        <div class="bd-highlight ">
            <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    {{-- <img src="..." class="d-block w-100" alt="..."> --}}
                    <div class="mt-4 mt-sm-5  bd-highlight">
                        <h5 class="px-5 channel-title   text-white">{{ __('banner_text_1') }}</h5>

                        {{-- <p class="channel-description lead text-white"></p> --}}

                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="mt-4 mt-sm-5  bd-highlight">
                        <h5 class="px-5 channel-title   text-white">{{ __('banner_text_2') }}</h5>

                        {{-- <p class="channel-description lead text-white"></p> --}}

                    </div>
                  </div>

                  <div class="carousel-item">
                    <div class="mt-4 mt-sm-5  bd-highlight">
                        <h5 class="px-5 channel-title   text-white">{{ __('banner_text_3') }}</h5>

                        {{-- <p class="channel-description lead text-white"></p> --}}

                    </div>
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>

        </div>
        <div style=" ">



        </div>
    </section>
</div>
    <div class="container mt-4 pb-4">
        <div class="container pt-4 ">

            <div class="container mt-2" style="background-color: #f0f8ff14;
                border: 1px solid #74747452;
                border-radius: 8px;">


                <div class="row" style="min-height: 200px;padding: 2rem 0;">
                    <div class=" col-12 col-sm-8"
                        style="padding: 1rem;display: inline-block !important;margin-top: auto;margin-bottom: auto;">
                        <p class="h4 text-right text-center text-sm-right" style="vertical-align: middle !important;">
                            {{ __("Have you subscribed to a regular series of 'Book of Addmes' videos?") }}</p>
                        <p class="text-sm pb-0 mb-0 text-muted font-italic text-center text-sm-right">
                            {{ __('For more info') }}: <a target="_blank" href="tel:+251911616155">(+251) 911616155</a>
                        </p>
                        {{-- <p class="text-sm pb-0 text-muted font-italic text-center text-sm-right">{{ __('Website') }}: <a
                                target="_blank"
                                href="https://addmes.mezagebtnet.com/courses">https://addmes.mezagebtnet.com/courses</a></p>
                        <p class="text-sm text-muted font-italic text-center text-sm-right">
                            {{ __('by Addmesh Book Trading') }} </p> --}}
                    </div>
                    <div class="col-12 col-sm-4 d-inline-block text-center text-sm-left"
                        style="margin-top: auto;margin-bottom: auto; padding: 1rem;display: block;display: inline-block !important;">
                        <span class=" justify-content-center align-middle">
                            <p style="mb-0" style="margin-bottom: 0;">{{ __('To watch the videos') }} </p>
                            <a href="{{ route('channel.landing', 'addmes') }}"
                                class="btn btn-block bg-gradient-warning btn-lg mx-atuo ">{{ __('Enter Here') }}!</a>

                        </span>

                    </div>
                </div>


            </div>
            {{-- <video
  id="vid1"
  class="video-js vjs-default-skin"
  controls
  autoplay
  width="640" height="264"
  data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "https://www.youtube.com/watch?v=xjS6SftYQaQ"}], "youtube": { "customVars": { "wmode": "transparent" } } }'
>
</video> --}}

            <div class="row pt-4">
                <div class="col">
                    <h4 class="mt-2">{{ __('Gize Channels') }}</h4>
                    <hr class="mt-0"/>
                </div>
            </div>
            <div class="grid-container">
                <div class="justify-content-center ">
                    {{-- <center> --}}
                    <div class=" row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 ">
                        @foreach ($gize_channels as $gize_channel)

                            <x-channels.card :channel="$gize_channel" :name="$gize_channel->name"
                                :producer="$gize_channel->producer" :id="$gize_channel->id" :slug="$gize_channel->slug" />

                        @endforeach
                    </div>
                    {{-- </center> --}}
                </div>
                {{-- <div class="justify-content-center ">
                    <div class=" row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 ">
                        <a href="{{ url('/fitrete-hibuat-1') }}">Fitrete Hebuat</a>
                    </div>
                </div> --}}
            </div>

        </div>


        <div class=" mb-4">
            <div class="row pt-4">
                <div class="col">
                    <h4 class="mt-2 ">{{ __('Featured') }}</h4>
                    <hr class="mt-0"/>
                </div>
                {{-- <a href="{{ route('play.index', ['v'=>'7']); }}">Play</a> --}}
            </div>

            <div id=" archive-cards" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 ">
                        {{-- {{ dd($activevideos[0]->video->poster_image_url) }} --}}
                        {{-- {{ dd($activerentals[0]->title) }} --}}


                        @for ($i = 0; $i < $featured_videos->count(); $i++)
                            @php
                                $archive = $featured_videos[$i];
                                $key = $i;
                            @endphp
                            {{-- {{ dd($active->id) }} --}}
                            @if ($archive->is_free)
                                {{-- <a href="#modal"
                                                data-vid_title = "{{ $archive->title }}"
                                                data-vid_duration = "{{ $archive->duration }}"
                                                data-vid_host = "{{ $archive->trainer }}">

                                                <x-channels.archivecard :archivevid="$archive"/>

                                            </a> --}}
                                <a href="{{ url('/play?v='.$archive->hashid) }}"  class=" " vid_id="{{ $archive->id }}"
                                    vid_title="{{ $archive->title }}" vid_duration="{{ $archive->duration }}"
                                    vid_host="{{ $archive->trainer }}" vid_channel="{{ $archive->gize_channel_id }}"
                                    vid_channel_name="{{ $archive->gizeChannel->name }}"
                                    vid_channel_logo="{{ $archive->gizeChannel->logo_image_url }}"
                                    vid_channel_phone_number="{{ $archive->gizeChannel->phone_number }}"
                                    vid_channel_contact_address="{{ $archive->gizeChannel->contact_address }}"
                                    vid_channel_website="{{ $archive->gizeChannel->website }}"
                                    vid_image_url="{{ asset('storage/' . $archive->thumb_image_url) }}">

                                    <x-channels.archivecard :archivevid="$archive" />

                                </a>

                            @else
                                <a href="javascript: void(0);" class="archivevid" vid_title="{{ $archive->title }}"
                                    vid_duration="{{ $archive->duration }}" vid_host="{{ $archive->trainer }}"
                                    vid_channel="{{ $archive->gize_channel_id }}"
                                    vid_channel_name="{{ $archive->gizeChannel->name }}"
                                    vid_channel_phone_number="{{ $archive->gizeChannel->phone_number }}"
                                    vid_channel_contact_address="{{ $archive->gizeChannel->contact_address }}"
                                    vid_channel_website="{{ $archive->gizeChannel->website }}"
                                    vid_image_url="{{ asset('storage/' . $archive->thumb_image_url) }}">

                                    <x-channels.archivecard :archivevid="$archive" />
                                </a>
                            @endif



                        @endfor
                </div>
            </div>



        </div>

        {{-- </div> --}}
        {{-- </div> --}}


    @endsection

    @section('js')
        <!-- Video JS -->

        <script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script>
        <script src="{{ asset('assets/js/dist/Youtube.min.js') }}"></script>


        <script src="https://unpkg.com/@videojs/http-streaming@2.8.0/dist/videojs-http-streaming.min.js"></script>

        <script
                src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-quality-levels/2.1.0/videojs-contrib-quality-levels.min.js">
        </script>

        <script src="https://unpkg.com/videojs-hls-quality-selector@1.0.5/dist/videojs-hls-quality-selector.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/videojs-landscape-fullscreen@11.1.0/dist/videojs-landscape-fullscreen.min.js">
        </script>




        <script>
            $(function() {
                $('.archivevid').on('click', function(e) {
                    e.preventDefault();
                    vidtitle = $(this).attr('vid_title');
                    vidid = $(this).attr('vid_id');
                    // vidid = 7;
                    // alert( $(this).attr('vid_title'));
                    vidduration = $(this).attr('vid_title');
                    vidhost = $(this).attr('vid_host');
                    vidchannel = $(this).attr('vid_channel');
                    vidchannel_name = $(this).attr('vid_channel_name');
                    vidchannel_logo_image_url = $(this).attr('vid_channel_logo_image_url');
                    vidchannel_phone_number = $(this).attr('vid_channel_phone_number');
                    vidchannel_contact_address = $(this).attr('vid_channel_contact_address');
                    vidchannel_website = $(this).attr('vid_channel_website');


                    vidimage_baseurl = "{{ asset('storage/') }}";
                    img_url = $(this).attr('vid_image_url');
                    vidimage_url = vidimage_baseurl + (img_url != null && img_url != '') ? img_url :
                        'images/c/channelvideo.png';
                    viddomid = "f" + vidid;

                    source =
                        `{{ route('video.batch.playlist', [
    'vid_id' => ':vidid',
    'gize_channel_id' => ':channelid',
]) }}`;

                    source = source.replace(':vidid', vidid);
                    source = source.replace(':channelid', vidchannel);

                    new_vidid = moment.now();

                    html = `<video-js
                                style="height: inherit;"
                                id="f${new_vidid}"
                                class="video-js free-video vim-css video_player vjs-big-play-centered vjs-fluid"
                                controls
                                preload="auto"
                                width="auto"
                                height="264"
                                poster="${vidimage_url}"
                                data-setup="{}"
                                >
                                <source src="${source}" type="application/x-mpegURL">


                            </video-js>`;
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
                                    <span>{{ __('Phone Number') }}:  ${vidchannel_phone_number}</span><br/>
                                    <span>{{ __('Address') }}: ${vidchannel_contact_address}</span>
                                </p>

                            </div>`,
                            showConfirmButton: true,
                            // timer: 1500
                        });
                    }



                    // $("#archiveDetailModal").modal('show');

                    // alert($(this).attr('vid_title'));
                });

            });
        </script>
    @endsection

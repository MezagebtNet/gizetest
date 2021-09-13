<div class="video-card-wrapper">
    <div class="py-0 video-card  square-animation">
        <div class="card mx-2">
            {{-- <video-js
                style="height: inherit;"
                id="{{ $vidid }}"
                class="video_player vjs-default-skin vjs-big-play-centered vjs-fluid"
                controls


                preload="auto"
                width="auto"
                height="264"


                data-setup="{}"
                poster="{{ isset($vidposter) && $vidposter!=null && $vidposter!=null ? asset('storage/'.$vidposter) : asset('assets/image/background.jpg') }}"
                responsive="true"
                >
                <source src="{{ route('video.playlist', ['vid_id' => $vidid ]) }}" type="application/x-mpegURL">

            </video-js> --}}
            <video-js
                style="height: inherit;"
                id="{{ $viddomid }}"
                class="video-js video_player vjs-default-skin vjs-big-play-centered vjs-fluid"
                controls
                preload="auto"
                width="auto"
                height="264"
                poster="{{ isset($vidposter) && $vidposter!=null && $vidposter!=null ? asset('storage/'.$vidposter) : asset('assets/image/background.jpg') }}"
                data-setup="{}"
                {{-- poster="{{ asset('storage/images/l/'.$vidposter) }}" --}}
                >
                <source src="{{ route('video.playlist', ['vid_id' => $vidid ]) }}" type="application/x-mpegURL">

                {{-- <source src="MY_VIDEO.webm" type="video/webm" /> --}}
                {{-- <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that
                    <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                </p> --}}
            </video-js>
            <div class="card-body pb-0">

                <span class="d-flex justify-content-start">
                    <h5 class="">{{ $vidtitle }}</h5>
                    <h6 class="text-gray" style="position: absolute; right:15px;">{{ $video->duration }}</h6>

                </span>

                {{-- <p class="card-text">{{ asset('storage/'.$vidposter) }}</p> --}}
                {{-- <p class="card-text">{{ $viddescription}}</p> --}}
                {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
            </div>
            <div class="card-footer bg-transparent">

                <span class="d-flex justify-content-start no-underline text-black" href="#">


                    <div class="ml-2">
                        <span style="color: #f59f0e; font-weight: bold;" class="uppercase tracking-wide text-sm font-semibold">
                            {{ $video->trainer }}
                        </span>

                        <span class="uppercase tracking-wide text-xs text-gray-400 font-semibold">|
                            {{ $video->created_at }}</span>
                    </div>
                </span>
                {{-- <a class="" href="#">
                    <span class="" style="display: none;">Like</span>
                    <i class="fa fa-eye"></i>
                </a> --}}

            </div>
        </div>
    </div>
</div>


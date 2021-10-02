<div class="video-card-wrapper">
    <div class="py-0 video-card fadeIn square-animation">
        <div class="card mx-2">
            <video-js
                style="height: inherit;"
                id="{{ $viddomid }}"
                bsid="{{ $video->batch_channelvideo_id }}"
                class="video-js batch_player vim-css video_player vjs-big-play-centered vjs-fluid"
                controls
                preload="auto"
                width="auto"
                height="264"
                poster="{{ isset($video->poster_image_url) && $video->poster_image_url!=null && $video->poster_image_url!=null ? asset('storage/'.$video->poster_image_url) : asset('storage/images/c/channelvideo.png') }}"
                data-setup="{}"
                >
                <source src="{{ route('video.batch.playlist', [
                    'vid_id' =>
                        $vidid,
                        // 7,
                    'gize_channel_id' => $video->gize_channel_id
                ]) }}" type="application/x-mpegURL">


            </video-js>
            <div class="card-body pb-0">

                <span class="d-flex justify-content-start">
                    <h5 class="">{{ $vidtitle }}</h5>
                    <h6 class="text-gray" style="position: absolute; right:15px;">{{ $video->duration }}</h6>

                </span>

            </div>
            <div class="card-footer bg-transparent">

                <span class="d-flex justify-content-start no-underline text-black" href="#">


                    <div class="ml-2">
                        <span style="color: #f59f0e; font-weight: bold;" class="uppercase tracking-wide text-sm font-semibold">
                            {{ $video->trainer }}
                        </span>

                        <span class="uppercase tracking-wide text-xs text-gray-400 font-semibold">|
                            {{ Jenssegers\Date\Date::createFromFormat('Y-m-d H:i:s', $video->created_at)->format('M d, Y'); }}</span>
                    </div>
                </span>


            </div>
        </div>
    </div>
</div>


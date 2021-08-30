<div class="py-0 px-2 video-card">
    <div class="card">
        <video id="{{ $vidid }}" class="video-js video_player vjs-default-skin vjs-big-play-centered vjs-fluid" controls preload="auto" width="auto" height="264"
            poster="{{ asset('assets/image/background.jpg') }}" data-setup="{}" >

            <source src="https://codingyaar.com/wp-content/uploads/video-in-bootstrap-card.mp4" type="video/mp4" />
            {{-- <source src="MY_VIDEO.webm" type="video/webm" /> --}}
            <p class="vjs-no-js">
                To view this video please enable JavaScript, and consider upgrading to a
                web browser that
                <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
            </p>
        </video>
        <div class="card-body">
            <h5 class="card-title">{{ $vidtitle }}</h5>
            <p class="card-text">{{ $viddescription}}</p>
            {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
        </div>
    </div>
</div>

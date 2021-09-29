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
                poster="{{ isset($video->poster_image_url) && $video->poster_image_url!=null && $video->poster_image_url!=null ? asset('storage/'.$video->poster_image_url) : asset('assets/image/background.jpg') }}"
                responsive="true"
                >
                <source src="{{ route('video.playlist', ['vid_id' => $vidid ]) }}" type="application/x-mpegURL">

            </video-js> --}}
            <video-js style="height: inherit;" id="{{ $viddomid }}"
                rid="{{ $video->rental_detail->id }}"
                class="video-js video_player rental_player vjs-default-skin vjs-big-play-centered vjs-fluid" controls preload="auto"
                width="auto" height="264"
                poster="{{ isset($video->poster_image_url) && $video->poster_image_url != null && $video->poster_image_url != null ? asset('storage/' . $video->poster_image_url) : asset('storage/images/c/channelvideo.png') }}"
                data-setup="{}" {{-- poster="{{ asset('storage/images/l/'.$video->poster_image_url) }}" --}}>
                <source
                    src="{{ route('video.rental.playlist', [
    'vid_id' =>
        $vidid,
        // 7,
    'gize_channel_id' => $video->gize_channel_id,
]) }}"
                    type="application/x-mpegURL">

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
                    <h6 class=" text-gray"
                        style="position: absolute; right:15px;">{{ $video->duration }}</h6>

                </span>

                {{-- <p class="card-text">{{ asset('storage/'.$video->poster_image_url) }}</p> --}}
                {{-- <p class="card-text">{{ $viddescription}}</p> --}}
                {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
            </div>
            <div class="card-footer bg-transparent">
                <dl>
                    @if ($video->rental_detail->status == 0 && $video->rental_detail->started_at == null)
                        <dt>{{ __('Status') }} <i class="status-indicator fa fa-circle text-danger"></i> </dt>
                        <dd>
                            {{-- <span>Video Not Played Yet</span> --}}

                            <span>{{ __('Once you start playing this vidio, it will be available for') }} {{ $video->rental_detail->for_hours }} {{ __('hours.') }}</span>
                            <br/>
                            <span class=" show-expiretime"><strong>{{ __('Rental Expires at') }}:</strong>
                                {{ Jenssegers\Date\Date::createFromFormat('Y-m-d H:i:s', $video->rental_detail->published_at)->add($video->rental_detail->within_days . ' days')->setTimezone(\Config::get('app.timezone'))->format('M d, Y H:i A') }}
                            </span>
                            <br  class="show-expiretime"/><span class="badge badge-secondary show-expiretime">{{ __('Timezone') }}: {{ \Config::get('app.timezone') }}</span>
                        </dd>
                    @endif
                    <dt class="show-endtime d-none">{{ __('Rental Ends At') }}</dt>
                    <dd class="show-endtime d-none">
                        <span class="time endtime">
                        </span>
                        <br /><span>{{ __('Timezone') }}: {{ \Config::get('app.timezone') }}</span>
                    </dd>

                    @if ($video->rental_detail->status != 0 && $video->rental_detail->started_at != null)
                        <dt>{{ __('Status') }} <i class="status-indicator fa fa-circle {{ $video->rental_detail->status == 1 ? 'text-warning' : 'text-success'}}"></i> </dt>
                        <dd>

                        </dd>
                        <dt>{{ __('Rental Ends At') }}</dt>
                        <dd>
                            <span class="endtime">
                                {{ Jenssegers\Date\Date::createFromFormat('Y-m-d H:i:s', $video->rental_detail->started_at)->addHours($video->rental_detail->for_hours)->setTimezone(\Config::get('app.timezone'))->format('M d, Y H:i A') }}
                                ({{ Jenssegers\Date\Date::createFromFormat('Y-m-d H:i:s', $video->rental_detail->started_at)->addHours($video->rental_detail->for_hours)->setTimezone(\Config::get('app.timezone'))->diffForHumans() }})
                            </span>
                            <br /><span class="badge badge-secondary ">{{ __('Timezone') }}: {{ \Config::get('app.timezone') }}</span>

                        </dd>
                    @endif
                </dl>
                <div>

                </div>
                <span class="d-flex justify-content-start no-underline text-black" href="#">


                    <div class="ml-2">
                        <span style="color: #f59f0e; font-weight: bold;"
                            class="uppercase tracking-wide text-sm font-semibold">
                            {{ $video->trainer }}
                        </span>

                        <span class="uppercase tracking-wide text-xs text-gray-400 font-semibold">|
                            {{ Jenssegers\Date\Date::createFromFormat('Y-m-d H:i:s', $video->created_at)->format('M d, Y') }}
                        </span>
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

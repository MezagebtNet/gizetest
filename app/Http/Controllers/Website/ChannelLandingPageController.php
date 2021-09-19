<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BatchChannelvideo;
use App\Models\BatchUser;
use App\Models\Channelvideo;
use App\Models\GizeChannel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChannelLandingPageController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $gize_channels = GizeChannel::all();

        return view('website.home', compact('gize_channels'));

    }

    public function find_by_slug($slug)
    {
        $gize_channel = GizeChannel::where('slug', $slug)->firstOrFail();
        $activevideos = $this->getActiveChannelVideos($slug);

        $events = $this->loadSchedule($slug);

        return view('website.channel.index', compact(['gize_channel', 'activevideos', 'events']));

    }

    public function loadSchedule($slug)
    {

        $gize_channel = GizeChannel::where('slug', $slug)->firstOrFail();
        $user_id = \Auth::user()->id;

        $user_batches = BatchUser::where('user_id', $user_id)
            ->where('active', 1)
            ->get()->pluck('batch_id');

        $active_batches = Batch::whereIn('id', $user_batches)->where('status', 1);
        // dd($batches->get()->pluck('id'));

        $batches = $active_batches->where('gize_channel_id', $gize_channel->id)->get();
        $schedules = BatchChannelvideo::whereIn('batch_id', $batches->pluck('id'))->get();

        foreach ($schedules as $schedule) {
            if (Channelvideo::find($schedule->channelvideo_id)) {
                $schedule->title = Channelvideo::find($schedule->channelvideo_id)->title;
            }

            // $schedule->start = $schedule->starts_at; //Carbon::createFromFormat('Y-m-d H', $schedule->starts_at)->toDateTimeString(); // 1975-05-21 22:00:00
            $schedule->start = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $schedule->starts_at)->format('Y-m-d\TH:i:s');
            $schedule->end = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $schedule->ends_at)->format('Y-m-d\TH:i:s');
            // $schedule->end = \Carbon\Carbon::createFromTimestampMs($schedule->ends_at)->format('Y-m-d\TH:i:s.uP');
            // $schedule->end = $schedule->ends_at; //Carbon::createFromFormat('Y-m-d H', $schedule->starts_at)->toDateTimeString(); // 1975-05-21 22:00:00
        }
        $events = $schedules->toArray();
        return $events;
        return response()->json($events);
    }

    /* Channel videos that are available to watch in the schedule */

    public function getActiveChannelVideos($slug)
    {
        $user = \Auth::user();

        $gize_channel = GizeChannel::where('slug', $slug)->firstOrFail();
        //get batches of the channel
        $user_id = \Auth::user()->id;

        $user_batches = BatchUser::where('user_id', $user_id)
            ->where('active', 1)
            ->get()->pluck('batch_id');

        $active_batches = Batch::whereIn('id', $user_batches)->where('status', 1);
        // dd($batches->get()->pluck('id'));

        $batches_in_channel = $active_batches->where('gize_channel_id', $gize_channel->id)->get();

        $channelvideos = collect([]);

        $videos = Channelvideo::where('active', 1)->get();

        foreach ($batches_in_channel as $batch) {

            $videos_in_batch = BatchChannelvideo::where('batch_id', $batch->id)
                ->whereIn('channelvideo_id', $videos->pluck('id'))
                ->whereDate('ends_at', '>=', now())
                ->whereDate('starts_at', '<=', now())->get();

            $channelvideos = $channelvideos->merge($videos_in_batch);

        }
        // dd($channelvideos);
        return $channelvideos;

    }

    public function renderVideoCard()
    {
        $video_card = "";

        $video_card .=
        '<div class="video-card-wrapper">' .
        '    <div class="py-0 video-card fadeIn square-animation">' .
        '        <div class="card mx-2">' .
        '            <video-js' .
        '                style="height: inherit;"' .
        '                id="' . $viddomid . '"' .
        '                class="video-js vim-css video_player vjs-big-play-centered vjs-fluid"' .
        '                controls' .
        '                preload="auto"' .
        '                width="auto"' .
        '                height="264"' .
        '                poster="' . isset($video->poster_image_url) && $video->poster_image_url != null && $video->poster_image_url != null ? asset('storage/' . $video->poster_image_url) : asset('storage/images/l/channelvideo.png') . '"' .
        '                data-setup="{}"' .
        '                >' .
        '                <source src="' . route('video.batch.playlist', ['vid_id' => 7]) . '" type="application/x-mpegURL">' .

        '            </video-js>' .
        '            <div class="card-body pb-0">' .

        '                <span class="d-flex justify-content-start">' .
        '                    <h5 class="">' . $vidtitle . '</h5>' .
        '                    <h6 class="text-gray" style="position: absolute; right:15px;">' . $video->duration . '</h6>' .

        '                </span>' .

        '            </div>' .
        '            <div class="card-footer bg-transparent">' .

        '                <span class="d-flex justify-content-start no-underline text-black" href="#">' .

        '                    <div class="ml-2">' .
        '                        <span style="color: #f59f0e; font-weight: bold;" class="uppercase tracking-wide text-sm font-semibold">' .
        '                            ' . $video->trainer . '' .
        '                        </span>' .

        '                        <span class="uppercase tracking-wide text-xs text-gray-400 font-semibold">|' .
        '                            ' . Jenssegers\Date\Date::createFromFormat('Y-m-d H:i:s', $video->created_at)->format('M d, Y') . '</span>' .
            '                    </div>' .
            '                </span>' .

            '            </div>' .
            '        </div>' .
            '    </div>' .
            '</div>';

    }

}

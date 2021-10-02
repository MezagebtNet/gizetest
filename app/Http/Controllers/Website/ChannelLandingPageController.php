<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BatchChannelvideo;
use App\Models\BatchUser;
use App\Models\Channelvideo;
use App\Models\GizeChannel;
use App\Http\Controllers\ChannelvideoRentalController;

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

        $gize_channels = GizeChannel::where('active', 1)->get();

        return view('website.channel.index', compact('gize_channels'));

    }


    public function find_by_slug($slug)
    {
        $gize_channel = GizeChannel::where('slug', $slug)->firstOrFail();

        return $gize_channel;
    }

    public function getChannelArchive($slug){
        $gize_channel = $this->find_by_slug($slug);

        $channelvideos = Channelvideo::with('gizeChannel')
            ->where('gize_channel_id', $gize_channel->id)
            ->where('active', 1)
            ->whereIn('video_available_for', [0, 2])->get(); //Where video is available for public.

        return $channelvideos;
    }

    public function loadChannel($slug){
        $gize_channel = $this->find_by_slug($slug);

        $activevideos = $this->getActiveChannelVideos($slug);

        $activerentals = ChannelvideoRentalController::getChannelActiveRentalsByUser($slug, \Auth::user()->id);

        $archives = $this->getChannelArchive($slug);

        $events = $this->loadSchedule($slug);

        return view('website.channel.landing', compact(['gize_channel', 'activevideos', 'activerentals', 'events', 'archives']));

    }

    public function loadSchedule($slug)
    {

        $tz = \Config::get('app.timezone');
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
            $schedule->start = \Carbon\Carbon::createFromTimestamp(strtotime($schedule->starts_at))
                ->timezone($tz)
                ->toDateTimeString();
            $schedule->end = \Carbon\Carbon::createFromTimestamp(strtotime($schedule->ends_at))
            ->timezone($tz)
            ->toDateTimeString();;
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
        // $slug = 'addmes';
        $user = \Auth::user();
        $tz = \Config::get('app.timezone'); //timezone;

        //Check Batch stream time slot
        $now = new \DateTime("now", new \DateTimeZone($tz) );

        // echo $now->format('Y-m-d H:i:s');
        //$now = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',  '2021-10-02 13:10:00');
        //return  $today->format('Y-m-d H:i:s');

        $gize_channel = GizeChannel::where('slug', $slug)->firstOrFail();

        //get batches of the channel
        $user_id = $user->id;

        $user_batches = BatchUser::where('user_id', $user_id)
            ->where('active', 1)
            ->get()->pluck('batch_id');

        $active_batches = Batch::whereIn('id', $user_batches)->where('status', 1);

        $batches_in_channel = $active_batches->where('gize_channel_id', $gize_channel->id)->get();

        $channelvideos = collect([]);

        $videos = Channelvideo::where('active', 1)
            ->whereIn('video_available_for', [1, 2])
            ->get();



        foreach ($batches_in_channel as $batch) {

            $videos_in_batch = BatchChannelvideo::where('batch_id', $batch->id)
                ->whereIn('channelvideo_id', $videos->pluck('id'))
			  ->get();


		  	foreach($videos_in_batch as $videos){
			  foreach($videos->video as $vid){
				if($vid->active == 1) {
				  	$batch_channelvideo_id = $videos->id;
				    $starts_at = $videos->starts_at;
				    $ends_at = $videos->ends_at;
				    $batch_id = $videos->batch_id;
				  	$vid->starts_at = $starts_at;
				  	$vid->ends_at = $ends_at;
				  	$vid->batch_id = $batch_id;
					$vid->batch_channelvideo_id = $batch_channelvideo_id;

					if(
					  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',  $starts_at, $tz)->lte($now) &&
					  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',  $ends_at, $tz)->gte($now)
					)
					$channelvideos = $channelvideos->add($vid);

				}
			  }

			}

        }

        // dd($channelvideos);
        return $channelvideos;

    }

    public function checkNewBatchChannelvideo($slug, $current_vids){
        // Check for newly added videos...
    }

    public function checkBatchChannelvideoValidity($slug, $batch_channelvideo_id){
        $activevideos = $this->getActiveChannelVideos($slug);
        $validity = false;
        foreach ($activevideos as $vid) {
            if($vid->batch_channelvideo_id == $batch_channelvideo_id){
                $validity = true;
            }
        }

        return $validity;
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

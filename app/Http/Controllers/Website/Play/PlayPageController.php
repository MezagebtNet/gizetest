<?php

namespace App\Http\Controllers\Website\Play;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BatchChannelvideo;
use App\Models\BatchUser;
use App\Models\Channelvideo;
use App\Models\GizeChannel;
use App\Http\Controllers\ChannelvideoRentalController;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\SoftDeletes;



use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Jenssegers\Date\Date;

// OR
use Artesaos\SEOTools\Facades\SEOTools;


class PlayPageController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hashid = '';
        $file_url = "";
        if($request->v){
            $hashid = $request->v;
            $vid_id = Channelvideo::decodeHashID($hashid);
            $channelvideo = Channelvideo::find($vid_id)->first();

        }

        // dd($file_url);
        $gize_channel = GizeChannel::where('id', $channelvideo->gize_channel_id)->where('active', 1)->get()[0];
        // dd($gize_channel[0]->slug);

        $featured_videos = Channelvideo::with('gizeChannel')
                    ->where('active', 1)
                    ->where('is_free', 1)
                    ->orderBy("is_featured", "Desc")
                    ->orderBy("id", "Desc")
                    ->take(4)
                    ->get();


        // $created_at_date = Date::createFromFormat('Y-m-d H:i:s', $channelvideo->created_at)->format('M d, Y');
        SEOMeta::setTitle($channelvideo->trainer . ' - ' . $channelvideo->title);
        SEOMeta::setDescription($channelvideo->description);
        SEOMeta::addMeta('video:published_time', $channelvideo->created_at->toW3CString(), 'property');
        // SEOMeta::addMeta('video:section', $post->category, 'property');
        SEOMeta::addKeyword([
            'gize',
            'gize video',
            'gizevideo',
            'gize app',
            'gizeapp',
            'mez',
            'meza',
            'mezagebt',
            'mezagibt',
            'video',
            $gize_channel->slug,
            $gize_channel->name,
            $gize_channel->name_en
        ]);


        OpenGraph::setType('video.other')
            ->setVideoOther([
                'actor' => $channelvideo->trainer,
                // 'actor:role' => 'string',
                // 'director' => 'profile /array',
                // 'writer' => $channelvideo->trainer,
                'duration' => 900,
                'release_date' => $channelvideo->created_at,
                // 'tag' => 'string / array'
            ]);

        OpenGraph::setDescription($channelvideo->description);
        OpenGraph::setTitle($channelvideo->trainer . ' - ' . $channelvideo->title);
        OpenGraph::setUrl(url('/play?v='. $channelvideo->hashid));
        OpenGraph::addProperty('type', 'video');
        // OpenGraph::addProperty('locale', \App::getLocale());
        // OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us'])
        // OpenGraph::addImage(asset('storage/images/gize-banner.jpg'));


        OpenGraph::addImage(asset('storage/'.$channelvideo->poster_image_url));
        // OpenGraph::addImage($post->images->list('url'));
        // OpenGraph::addImage(['url' => 'http://image.url.com/cover.jpg', 'size' => 300]);
        // OpenGraph::addImage('http://image.url.com/cover.jpg', ['height' => 300, 'width' => 300]);

        JsonLd::setTitle($channelvideo->trainer . ' - ' . $channelvideo->title);
        JsonLd::setDescription($channelvideo->description);
        JsonLd::setType('Video');
        JsonLd::addImage(asset('storage/'.$channelvideo->poster_image_url));


        // TwitterCard::addValue($key, $value); // value can be string or array
        // TwitterCard::setType($type); // type of twitter card tag
        TwitterCard::setTitle($channelvideo->trainer . ' - ' . $channelvideo->title); // title of twitter card tag
        TwitterCard::setSite(env('APP_NAME')); // site of twitter card tag
        TwitterCard::setDescription($channelvideo->description); // description of twitter card tag
        TwitterCard::setUrl(url('/play?v='. $channelvideo->hashid)); // url of twitter card tag
        TwitterCard::setImage(asset('storage/'.$channelvideo->poster_image_url)); // add image url


        return view('website.play.index', compact('featured_videos', 'channelvideo', 'gize_channel'));

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
            ->whereIn('video_available_for', [0, 2])
            ->orderBy('id', 'Desc')
            ->get(); //Where video is available for public.

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

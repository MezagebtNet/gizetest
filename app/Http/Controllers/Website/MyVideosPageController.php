<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ChannelvideoRentalController;
use Illuminate\Http\Request;
use App\Models\Channelvideo;
use App\Models\GizeChannel;
use App\Models\Batch;
use App\Models\BatchChannelvideo;
use App\Models\BatchUser;

class MyVideosPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $activevideos = $this->getActiveChannelVideos('addmes');
        $gize_channel = GizeChannel::where('slug', 'addmes')->firstOrFail();

        $activerentals = ChannelvideoRentalController::getChannelActiveRentalsByUser('addmes', \Auth::user()->id);

        return view('website.my_videos.index', compact(
            'activerentals',
            'activevideos',
            'gize_channel',



        ));

    }

    public function getActiveChannelVideos($slug)
    {
        // $slug = 'addmes';
        $user = \Auth::user();
        $tz = \Config::get('app.timezone'); //timezone;

        //Check Batch stream time slot
        $now = new \DateTime("now", new \DateTimeZone($tz));


        //search from each channel
        //for now choose addmes only

        $gize_channel = GizeChannel::where('slug', $slug)->firstOrFail();

        //get batches of the channel
        $user_id = $user->id;

        // $user_batches = BatchUser::where('user_id', $user_id)
        //     ->where('active', 1)
        //     ->get()->pluck('batch_id');

        $user_batches = BatchUser::select('id', 'batch_id', 'user_id')->where('user_id', $user_id)
            ->where('active', 1)->get();
        //return $user_batches;

        $active_batches = Batch::whereIn('id', $user_batches->pluck('batch_id'))->where('status', 1);
        //return $active_batches->get();

        // dd($user_batches);
        $batches_in_channel = $active_batches->where('gize_channel_id', $gize_channel->id)->get();

        $channelvideos = collect([]);

        $videos = Channelvideo::where('active', 1)
            ->whereIn('video_available_for', [1, 2])
            ->get();

        $video_ids = $videos->pluck('id');

        foreach ($batches_in_channel as $batch) {

            $videos_in_batch = BatchChannelvideo::where('batch_id', $batch->id)
                ->whereIn('channelvideo_id', $video_ids)
                ->get();
            // dd($videos_in_batch);
            foreach ($videos_in_batch as $videos) {
                foreach ($videos->video as $vid) {

                    $batch_channelvideo_id = $videos->id;
                    $starts_at = $videos->starts_at;
                    $ends_at = $videos->ends_at;
                    $batch_id = $videos->batch_id;
                    $vid->starts_at = $starts_at;
                    $vid->ends_at = $ends_at;
                    $vid->batch_id = $batch_id;
                    $vid->batch_channelvideo_id = $batch_channelvideo_id;

                    if (
                        \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $starts_at, $tz)->lte($now) &&
                        \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ends_at, $tz)->gte($now)
                    ) {
                        // return $vid->id;
                        //   if($vid->id == 41){
                        //     echo $ends_at;
                        //     echo \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',  $ends_at, $tz)->gte($now);
                        //   }

                        $new = $channelvideos->add($vid);
                        $channelvideos = $new;

                    }

                }

            }

        }

        // dd($channelvideos);
        return $channelvideos;

    }
}

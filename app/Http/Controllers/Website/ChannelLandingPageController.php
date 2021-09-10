<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\GizeChannel;
use App\Models\BatchChannelvideo;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

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
        return view('website.channel.index', compact(['gize_channel', 'activevideos']));

    }

    /* Channel videos that are available to watch in the schedule */

    public function getActiveChannelVideos($slug)
    {
        $user = \Auth::user();

        $gize_channel = GizeChannel::where('slug', $slug)->firstOrFail();
        //get batches of the channel
$batches_in_channel = Batch::where('gize_channel_id', $gize_channel->id)->get();



$channelvideos = collect([]);


        foreach ($batches_in_channel as $batch) {

$videos_in_batch = BatchChannelvideo::where('batch_id', $batch->id)
    ->whereDate('ends_at', '>=', now())
    ->whereDate('starts_at', '<=', now())->get();


            $channelvideos = $channelvideos->merge($videos_in_batch);

        }

return $channelvideos;


    }

}

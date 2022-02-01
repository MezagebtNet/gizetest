<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\GizeChannel;
use App\Models\Collection;

use Illuminate\Http\Request;

class CollectionDetailsPageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug, $col_slug)
    {
        $gize_channel = $this->find_by_slug($slug);
        $collection = $this->find_by_col_slug($col_slug);
        $collections =  $gize_channel->getTopVideoBundles()->where('active', 1)->get();
        // $channelvideos = $this->loadChannelvideos($collection->id)->get()->toArray();

        $child_collections = Collection::where('slug', $col_slug)->first()->childCollections()->get();

        //Itereate through childcollections to get channel videos.
        $channelvideos = [];
        foreach($child_collections as $child){



            $channelvideos = array_merge($channelvideos, $child->channelvideos()->get()->toArray());
        }

        // dd($channelvideos);

        return view('website.channel.collection.details', compact(
            'gize_channel',
            'collections',
            'collection',
            'channelvideos',
        ));

    }

    public function loadChannelvideos ($collection_id){
        $channelvideos = Collection::find($collection_id)->channelvideos()->get();

        return $channelvideos;
    }

    public function find_by_slug($slug)
    {
        $gize_channel = GizeChannel::where('slug', $slug)->firstOrFail();

        return $gize_channel;
    }


    public function find_by_col_slug($col_slug)
    {
        // dd('here');

        $gize_channel = Collection::where('slug', $col_slug)->firstOrFail();

        return $gize_channel;
    }




}

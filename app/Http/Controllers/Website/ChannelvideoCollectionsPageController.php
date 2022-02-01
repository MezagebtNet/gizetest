<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\GizeChannel;
use Illuminate\Http\Request;

class ChannelvideoCollectionsPageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $gize_channel = $this->find_by_slug($slug);
        $collections =  $gize_channel->getTopVideoBundles()->where('active', 1)->get();

        return view('website.channel.collection.index', compact(
            'collections',
            'gize_channel'
        ));

    }

    public function find_by_slug($slug)
    {
        $gize_channel = GizeChannel::where('slug', $slug)->firstOrFail();

        return $gize_channel;
    }




}

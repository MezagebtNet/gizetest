<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\GizeChannel;
use App\Models\Channelvideo;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomePageController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!\Auth::check()) {
            return view('welcome');
        }
        // $gize_channels = GizeChannel::all();
        $featured_videos = Channelvideo::with('gizeChannel')->where('active', 1)
            ->where('is_featured', 1)
            ->orderBy("is_free")
            ->get();

        return view('website.home', compact('featured_videos'));

    }

}

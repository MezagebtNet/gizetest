<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\GizeChannel;
use App\Models\Channelvideo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Date\Date;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;

// OR
use Artesaos\SEOTools\Facades\SEOTools;


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
        SEOMeta::setTitle('Home');
        // SEOMeta::setDescription('Gize');
        // SEOMeta::setCanonical(env('APP_URL'));

        // OpenGraph::setDescription('Gize');
        OpenGraph::setTitle('Home');
        OpenGraph::setUrl(env('APP_URL'));
        OpenGraph::addProperty('type', 'WebPage');
        OpenGraph::addImage(asset('storage/images/gize-banner.jpg'));
        // OpenGraph::addImage($post->images->list('url'));
        // OpenGraph::addImage(['url' => 'http://image.url.com/cover.jpg', 'size' => 300]);
        // OpenGraph::addImage('http://image.url.com/cover.jpg', ['height' => 300, 'width' => 300]);

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
            'video'
        ]);

        TwitterCard::setTitle('Home');
        TwitterCard::setSite('@gize');

        // JsonLd::setTitle('Home');
        // JsonLd::setDescription('Gize');
        // JsonLd::addImage(asset('storage/images/logo-SEO-jsonld.jpg'));


        if (!\Auth::check()) {

            // return $this->welcomePage();
        }



        $gize_channels = GizeChannel::where('active', 1)->orderBy('id', 'ASC')->take(4)->get();

        $featured_videos = Channelvideo::with('gizeChannel')->where('active', 1)
            ->where('is_featured', 1)
            ->orderBy("is_free")
            ->orderBy('id', 'desc')
            ->get()
            ->take(12);


        $gize_channel = GizeChannel::where('slug', 'Addmes')->firstOrFail();

        $collections =  $gize_channel->getTopVideoBundles()->where('active', 1)->get();


        return view('website.home', compact('featured_videos','gize_channels', 'collections'));

    }

    public function welcomePage(){
        return view('welcome');
    }

}

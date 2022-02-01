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


class FitreteHibuatChaptersController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEOMeta::setTitle('Fitrete Hibuat 1 Book Video Chapters');
        // SEOMeta::setDescription('Gize');
        // SEOMeta::setCanonical(env('APP_URL'));

        // OpenGraph::setDescription('Gize');
        OpenGraph::setTitle('Fitrete Hibuat 1 Book Video Chapters');
        OpenGraph::setUrl(env('APP_URL').'/fitrete-hibuat-1');
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
            'video',
            'fitrete hebuat',
            'hibuat'
        ]);

        TwitterCard::setTitle('Fitrete Hibuat 1 Book Video Chapters');
        TwitterCard::setSite('@gize');

        // JsonLd::setTitle('Home');
        // JsonLd::setDescription('Gize');
        // JsonLd::addImage(asset('storage/images/logo-SEO-jsonld.jpg'));


        if (!\Auth::check()) {

            return $this->welcomePage();
        }



        $gize_channels = GizeChannel::where('active', 1)->orderBy('id', 'ASC')->take(4)->get();

        $featured_videos = Channelvideo::with('gizeChannel')->where('active', 1)
            ->where('is_featured', 1)
            ->orderBy("is_free")
            ->orderBy('id', 'desc')
            ->get();

        return view('website.book_videos.index', compact('featured_videos','gize_channels'));

    }

    public function welcomePage(){
        return view('welcome');
    }

}

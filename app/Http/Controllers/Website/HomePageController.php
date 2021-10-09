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

        if (!\Auth::check()) {
            return $this->welcomePage();
        }

        SEOMeta::setTitle('Home');
        // SEOMeta::setDescription('Gize');
        SEOMeta::setCanonical(env('APP_URL'));

        // OpenGraph::setDescription('Gize');
        OpenGraph::setTitle('Home');
        OpenGraph::setUrl(env('APP_URL'));
        OpenGraph::addProperty('type', 'WebPage');

        TwitterCard::setTitle('Home');
        TwitterCard::setSite('@gize');

        JsonLd::setTitle('Home');
        // JsonLd::setDescription('Gize');
        JsonLd::addImage(asset('storage/images/logo-SEO-jsonld.jpg'));

        // OR
        // SEOTools::setTitle('Home');
        // SEOTools::setDescription('Gize');
        // SEOTools::opengraph()->setUrl(env('APP_URL'));
        // SEOTools::setCanonical(env('APP_URL'));
        // SEOTools::opengraph()->addProperty('type', 'articles');
        // SEOTools::twitter()->setSite('@GizeVideo');
        // SEOTools::jsonLd()->addImage(asset('storage/images/logo-SEO-jsonld.jpg'));


        $gize_channels = GizeChannel::where('active', 1)->orderBy('id', 'ASC')->take(4)->get();

        $featured_videos = Channelvideo::with('gizeChannel')->where('active', 1)
            ->where('is_featured', 1)
            ->orderBy("is_free")
            ->get();

        return view('website.home', compact('featured_videos','gize_channels'));

    }

    public function welcomePage(){
        return view('welcome');
    }

}

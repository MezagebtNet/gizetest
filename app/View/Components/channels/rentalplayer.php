<?php

namespace App\View\Components\channels;

use Illuminate\View\Component;

class rentalplayer extends Component
{
    /**
     * The player vidid.
     *
     * @var string
     */
    public $vidid;

    /**
     * The player video.
     *
     * @var Channelvideo
     */
    public $video;

    /**
     * The player viddomid.
     *
     * @var string
     */
    public $viddomid;

    /**
     * The player vidtitle.
     *
     * @var string
     */
    public $vidtitle;

    /**
     * The player viddescription.
     *
     * @var string
     */
    public $viddescription;

    /**
     * The player vidposter.
     *
     * @var string
     */
    public $vidposter;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($vidid, $video, $viddomid, $vidtitle, $viddescription, $vidposter = "images/l/channelvideo.png")
    {
        $this->vidid = $vidid;
        $this->video = $video;
        $this->viddomid = $viddomid;
        $this->vidtitle = $vidtitle;
        $this->viddescription = $viddescription;
        $this->vidposter = $vidposter;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.channels.rentalplayer');
    }
}

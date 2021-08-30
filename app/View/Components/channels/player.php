<?php

namespace App\View\Components\channels;

use Illuminate\View\Component;

class player extends Component
{

    /**
     * The player vidid.
     *
     * @var string
     */
    public $vidid;

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
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($vidid, $vidtitle, $viddescription)
    {
        $this->vidid = $vidid;
        $this->vidtitle = $vidtitle;
        $this->viddescription = $viddescription;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.channels.player');
    }
}

<?php

namespace App\View\Components\channels;

use Illuminate\View\Component;
use App\Models\Channelvideo;

class archivecard extends Component
{

    /**
    * The player producer.
    *
    * @var Channelvideo
    */
   public $archivevid;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($archivevid)
    {
        $this->archivevid = $archivevid;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.channels.archivecard');
    }
}

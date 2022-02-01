<?php

namespace App\View\Components\Channels;

use Illuminate\View\Component;

class CollectionCard extends Component
{

    /**
     * The player collection.
     *
     * @var string
     */
    public $collection;


    /**
     * The player seriesable.
     *
     * @var string
     */
    // public $seriesable;

    /**
     * The player series_no.
     *
     * @var string
     */
    // public $series_no;

    /**
     * The player description.
     *
     * @var string
     */
    // public $description;

    /**
     * The player image_url.
     *
     * @var string
     */
    // public $image_url;

    /**
    * The player producer.
    *
    * @var GizeChannel
    */
   public $channel;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($collection, /*$seriesable, $series_no, $description, $image_url,*/ $channel)
    {
        $this->collection = $collection;
        // $this->seriesable = $seriesable;
        // $this->series_no = $series_no;
        // $this->description = $description;
        // $this->image_url = $image_url;
        $this->channel = $channel;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.channels.collection-card');
    }
}

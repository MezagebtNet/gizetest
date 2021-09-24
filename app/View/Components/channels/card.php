<?php

namespace App\View\Components\channels;

use Illuminate\View\Component;
use App\Models\GizeChannel;

class card extends Component
{

     /**
     * The player id.
     *
     * @var string
     */
    public $id;
     /**
     * The player slug.
     *
     * @var string
     */
    public $slug;

     /**
     * The player name.
     *
     * @var string
     */
    public $name;


     /**
     * The player producer.
     *
     * @var string
     */
    public $producer;

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
    public function __construct($channel, $id, $slug, $name, $producer)
    {
        $this->channel = $channel;
        $this->id = $id;
        $this->slug = $slug;
        $this->name = $name;
        $this->producer = $producer;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.channels.card');
    }
}

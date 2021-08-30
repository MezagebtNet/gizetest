<?php

namespace App\View\Components\channels;

use Illuminate\View\Component;

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
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $slug, $name)
    {
        $this->id = $id;
        $this->slug = $slug;
        $this->name = $name;
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

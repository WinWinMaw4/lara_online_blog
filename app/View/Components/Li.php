<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Li extends Component
{

    public $routeName,$name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name="Nav Link",$routeName='home')
    {
        //
        $this->name = $name;
        $this->routeName = $routeName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.li');
    }
}

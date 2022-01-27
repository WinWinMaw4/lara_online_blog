<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{

    public $name,$title,$default,$formId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name="name",$title="Input Label",$default=" ",$formId=null)
    {
        //
        $this->name = $name;
        $this->title = $title;
        $this->default = $default;
        $this->formId = $formId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}

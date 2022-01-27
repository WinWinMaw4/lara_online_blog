<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $type,$margin,$date,$time;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type='success',$margin="mb-0")
    {
        //
        $this->type = $type;
        $this->margin = $margin;
    }

    public function isCloseAble(){
      return $this->type === 'danger';
    }

    public function getDateTime(){
        $d = date('Y-m-d');
        $t = date('H:i a');

        return $d." ".$t;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}

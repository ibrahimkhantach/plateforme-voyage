<?php

namespace App\View\Components\Aventure;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AllAventure extends Component
{
    /**
    
    
     * Create a new component instance.
     * 
     */
    public $aventures ;
    public function __construct($aventures)
    {
        //
        $this->aventures = $aventures ;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.aventure.all-aventure');
    }
}

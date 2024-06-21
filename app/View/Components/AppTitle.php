<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppTitle extends Component
{
    public $pageTitle;

    public function __construct($pageTitle=0)
    {
        $this->pageTitle = $pageTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.app-title');
    }
}

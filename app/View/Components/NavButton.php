<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavButton extends Component
{
    public $target;
    public $extraClass;
    public $title;
    public function __construct($title, $target, $extraClass = '')
    {
        $this->title = $title;
        $this->target = $target;
        $this->extraClass = $extraClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-button');
    }
}

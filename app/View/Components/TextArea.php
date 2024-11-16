<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextArea extends Component
{
    public $name;
    public $placeholder;
    public $disabled;
    public $value;
    public $divStyle;
    public $required;
    public $extraLabelClass;
    public $rows;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $placeholder = '', $disabled = false, $value = '', $divStyle = '', $required = false, $extraLabelClass = '', $rows="10")
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->disabled = $disabled;
        $this->value = $value;
        $this->divStyle = $divStyle;
        $this->required = $required;
        $this->extraLabelClass = $extraLabelClass;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text-area');
    }
}

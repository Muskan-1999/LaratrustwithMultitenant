<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ViewToggle extends Component
{
    public $view;     // Current view mode (list/grid/row)
    public $modes;    // Array of modes available
    public $property;
    /**
     * Create a new component instance.
     */
    public function __construct($view = 'list', $modes = ['list', 'grid', 'row'], $property = 'viewMode')
    {
        $this->view = $view ?? 'list';
        $this->modes = $modes;
        $this->property = $property;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.view-toggle');
    }
}

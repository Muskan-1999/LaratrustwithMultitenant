<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterBar extends Component
{
    public $search;
    public $filterable;
    public $showReset;
    public $resetMethod;

    public function __construct($search = '', $filterable = true, $showReset = true, $resetMethod = 'resetFilters')
    {
        $this->search = $search;
        $this->filterable = $filterable;
        $this->showReset = $showReset;
        $this->resetMethod = $resetMethod;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.filter-bar');
    }
}

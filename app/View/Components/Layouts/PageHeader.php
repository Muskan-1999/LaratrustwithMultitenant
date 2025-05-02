<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeader extends Component
{
    public $highlight;
    public $title;

    /**
     * Create a new component instance.
     */
    public function __construct($highlight = 'Explore', $title = 'the marbetsphere.')
    {
        $this->highlight = $highlight;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.page-header');
    }
}

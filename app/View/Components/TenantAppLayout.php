<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TenantAppLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('layouts.tenant-app');
    }
} 
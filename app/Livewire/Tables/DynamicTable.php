<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use Livewire\WithPagination;

class DynamicTable extends Component
{
    
    public $columns = [];
    public $rows = [];

    public function mount($columns = [], $rows = [])
    {
        $this->columns = $columns;
        $this->rows = $rows;
    }

    public function render()
    {
        return view('livewire.tables.dynamic-table');
    }
}

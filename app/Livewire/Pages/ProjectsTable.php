<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Project;

class ProjectsTable extends Component
{
    use WithPagination;

    public $breadcrumbs = [];
    public $columns = [];
    public $viewMode = 'list';
    public $openedItem = null;

    protected $queryString = ['viewMode'];

    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Projects', 'url' => '#'],
        ];

        $this->columns = ['Title', 'Status', 'Start', 'End', 'Time', 'Total', 'Open', 'Actions'];
    }

    public function setViewMode($mode)
    {
        $this->viewMode = $mode;
        $this->resetPage(); // reset pagination when switching views
    }

    public function toggleItem($itemId)
    {
        $this->openedItem = $this->openedItem === $itemId ? null : $itemId;
    }

    public function render()
    {
        // If in list mode, just paginate as usual
        $projects = Project::select('id', 'title', 'status', 'start_date', 'end_date') // Select only needed fields
            ->latest()
            ->paginate(10);

        return view('livewire.pages.projects-table', compact('projects'));
    }
}
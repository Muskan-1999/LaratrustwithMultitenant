<?php

namespace App\Livewire\Tenant;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tenant;

class TenantList extends Component
{ 
    use WithPagination;
    public $breadcrumbs = [];
    public $columns = [];
    public $rows = [];
    public $viewMode = 'list'; 
    protected $queryString = ['viewMode'];
    public $openedItem = null;
    
    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Tenant', 'url' =>route('tenant-list')],
        ];

       $this->columns = ['Name', 'Email', 'Domain','Actions'];
    }
    public function setViewMode($mode)
      {
    $this->viewMode = $mode;
      }

    public function toggleItem($itemId)
    {
        $itemId = (string) $itemId;
        $this->openedItem = $this->openedItem === $itemId ? null : $itemId;
    }

    public function render()
    {
        $tenants = Tenant::all();
        return view('livewire.tenant.tenant-list',compact('tenants'));
    }
}

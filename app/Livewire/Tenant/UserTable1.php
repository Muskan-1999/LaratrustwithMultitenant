<?php


namespace App\Livewire\Tenant;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;

class UserTable extends Component
{
    use WithPagination;

    public $layout = 'list';
    public $openedRole = null;

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function toggleRole($roleName)
    {
        if ($this->openedRole === $roleName) {
            $this->openedRole = null;
        } else {
            $this->openedRole = $roleName;
        }

        $this->resetPage();
    }

    public function render()
    {
        $roles = Role::withCount('users')->get();

        if ($this->openedRole) {
            $users = User::whereHas('roles', function($q) {
                $q->where('name', $this->openedRole);
            })->with('roles')->paginate(10);
        } else {
            // No accordion opened: load all users normally
            $users = User::with('roles')->paginate(10);
        }

        return view('livewire.tenant.user-table', compact('roles', 'users'));
    }
}
?>
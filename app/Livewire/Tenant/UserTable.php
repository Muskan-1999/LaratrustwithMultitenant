<?php

namespace App\Livewire\Tenant;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Role;


class UserTable extends Component
{
    use WithPagination;

    public $layout = 'list';

    public function render()
    {
        $users = User::with('roles')->paginate(10);    
        $roles = Role::withCount('users')->get();

        return view('livewire.tenant.user-table', compact('users', 'roles'));
    }
    
}

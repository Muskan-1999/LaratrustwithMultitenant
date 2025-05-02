<?php


namespace App\Livewire\Tenant;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Cache;

class UserTable extends Component
{

    use WithPagination;
    public $breadcrumbs = [];
    public $columns = [];
    public $rows = [];
    public $viewMode = 'list';
    protected $queryString = ['viewMode'];
    public $openedItem = null;
    public $roleUsers = [];
    public $showModal = false;
    public $editForm = [
        'name' => '',
        'email' => '',
        'roles' => [],
    ];
    public bool $showViewModal = false;
    public bool $showEditModal = false;
    public $selectedUser;
    public $confirmingDelete = false;
    public $userToDelete = null;

    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Manage Users', 'url' => '#'],
        ];

        $this->columns = ['Name', 'Email', 'Role', 'Created_At', 'Actions'];
       // $this->roles = Role::all();
       
    }

    public function setViewMode($mode)
    {
        $this->viewMode = $mode;
        $this->resetPage(); // Reset pagination
    }


    public function toggleItem($roleName)
    {
        $this->openedItem = $this->openedItem === $roleName ? null : $roleName;

        if (!isset($this->roleUsers[$roleName]) && $this->openedItem) {
            $this->roleUsers[$roleName] = Cache::remember("users_for_role_{$roleName}", 300, function () use ($roleName) {
                return Role::where('name', $roleName)
                    ->with(['users' => fn($query) => $query->select('id', 'name', 'email', 'created_at')->with('roles')])
                    ->first()?->users ?? collect();
            });
        }
    }

  
public function viewUser($userId)
{
    $this->selectedUser = User::with('roles')->findOrFail($userId);
    $this->showViewModal = true;
}

public function editUser($userId)
{
    $user = User::with('roles')->findOrFail($userId);
    $this->selectedUser = $user;
    $this->editForm = [
        'name' => $user->name,
        'email' => $user->email,
        'roles' => $user->roles->pluck('id')->toArray(),
    ];
   // dd($this->editForm);
    $this->showEditModal = true;
}

    public function updateUser()
    {
        $this->selectedUser->update([
            'name' => $this->editForm['name'],
            'email' => $this->editForm['email'],
        ]);

        $this->selectedUser->roles()->sync($this->editForm['roles']);

        $this->showModal = false;
        session()->flash('message', 'User updated successfully.');
    }

    public function confirmDelete($id)
    {
        $this->userToDelete = User::findOrFail($id);
        $this->confirmingDelete = true;
    }

    public function deleteUser()
    {
        if ($this->userToDelete) {
            $this->userToDelete->delete();
            $this->confirmingDelete = false;
            session()->flash('message', 'User deleted successfully.');
        }
    }
    public function render()
    {
        // Only load needed columns to reduce memory & SQL overhead
        $users = User::select('id', 'name', 'email', 'created_at')
            ->with('roles:id,name') // Only pull role ID and name
            ->paginate(10);

        $roles = Role::withCount('users')->get();

        return view('livewire.tenant.user-table', [
            'roles' => $roles,
            'roleUsers' => $this->roleUsers,
            'users' => $users,
        ]);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UserInformation extends Component
{
    public $user;
    public $layout = 'list';

    // The $user parameter will be passed automatically from the route
    public function mount(User $user)
    {
        // Log or handle the user as needed
        \Log::debug('User passed to mount:', ['user' => $user]);
        
        // Assign the user object to the public $user property
        $this->user = $user;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render()
    {
        // Get the user with the roles
        $user = User::with('roles')->findOrFail($this->user->id);

        // Access the user's name
        $userName = $user->name;

        // Access the roles associated with the user
        $userRoles = $user->roles->pluck('name'); // Assuming the role name is in the 'name' column

        // For debugging purposes, log the name and roles
        \Log::debug('User Name: ' . $userName);
        \Log::debug('User Roles: ' . $userRoles->implode(', '));

        return view('livewire.user-information', [
            'user' => $user,
            'userRoles' => $userRoles,
        ]);
    }
}

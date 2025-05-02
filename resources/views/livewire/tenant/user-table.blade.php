<div class="space-y-8">
    {{-- Breadcrumbs --}}
    <x-layouts.breadcrumbs1 :items="$breadcrumbs" />

    {{-- Page Header --}}
    <x-layouts.page-header 
    title="<span class='italic text-[#f43f1a]'>Together</span> the marbetsphere." 
/>
    <x-layouts.page-header highlight="Together" title="we are marbet." class="mb-6" />

    {{-- Filter Bar --}}
    <x-layouts.filter-bar
        :view="$viewMode"
        :modes="['list', 'grid','row']"
        property="viewMode"
        search="search"
        resetMethod="resetProjectFilters" />

    {{-- List View --}}
    @if ($viewMode === 'list')
    <x-layouts.dynamic-list
        :columns="['Name', 'Email', 'Role', 'Created At', 'Actions']"
        :rows="$users->map(fn($user) => [
        $user->name,
        $user->email,
        $user->roles->isNotEmpty() ? $user->roles->pluck('name')->join(', ') : 'No Role ',
        \Carbon\Carbon::parse($user->created_at)->format('d.m.Y   H:i'),
        'actions' => [
        'view' => ['method' => 'viewUser', 'param' => $user->id],
        'edit' => ['method' => 'editUser', 'param' => $user->id],
        'delete' => ['method' => 'confirmDelete', 'param' => $user->id],
    ],
    ])" />
    {{-- Grid View --}}
    @elseif ($viewMode === 'grid')
    <div class="grid gap-4 grid-cols-1">
        @foreach ($users as $user)
        <x-layouts.grid-card
            :avatar="$user->client->avatar ?? null"
            :title="$user->name"
            :badges="[ 
                        ['text' => 'ONGOING'], 
                        ['text' => 'COMPLETED'] 
                    ]"
            :meta="[ 
                    'Role' => $user->roles->isNotEmpty() ? $user->roles->pluck('name')->join(', ') : 'No Role Assigned', 
                    'Status' => $user->status ?? 'Account Director' 
                    ]"
            actionText="Go to User →" />
        @endforeach

        @elseif ($viewMode === 'row')
        @foreach ($roles as $role)
        @php
        $users = $roleUsers[$role->name] ?? collect();
        @endphp

        <x-layouts.row-card
            :title="$role->name"
            :meta="['Users' => $role->users_count]"
            :actionMethod="'toggleItem'"
            :actionParam="$role->name"
            :isOpen="$openedItem === $role->name">
            @if($users->isEmpty())
            <p class="text-gray-500 text-sm">No users found for this role.</p>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                @foreach ($users as $user)
                <x-layouts.card
                    :entity="$user"
                    :fields="[
                                'Role' => fn($e) => $e->roles->pluck('name')->join(', '),
                                'Status' => 'status'
                            ]"
                    :badges="['3 ONGOING', '2 COMPLETED']"
                    buttonLink="#"
                    buttonText="Go to User →" />
                @endforeach
            </div>
            @endif
        </x-layouts.row-card>
        @endforeach
        @endif
        @if($showViewModal)
        <x-layouts.user-view-modal
            :user="$selectedUser"
            wire:model="showViewModal" />
        @endif

        @if($showEditModal)
        <x-layouts.user-edit-modal
            :user="$selectedUser"
            :roles="$roles"
            wire:model="showEditModal" />
        @endif


        @if($confirmingDelete)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-xl shadow-md w-full max-w-md">
                <h2 class="text-lg font-bold mb-4 text-red-600">Delete User</h2>
                <p class="mb-6 text-gray-600">
                    Are you sure you want to delete <strong>{{ $userToDelete->name }}</strong>? This action cannot be undone.
                </p>
                <div class="flex justify-end space-x-2">
                    <button class="btn btn-outline" wire:click="$set('confirmingDelete', false)">Cancel</button>
                    <button class="btn btn-error" wire:click="deleteUser">Yes, Delete</button>
                </div>
            </div>
        </div>
        @endif
    </div>
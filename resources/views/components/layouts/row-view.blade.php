<div class="bg-white p-4 rounded shadow-md mb-6">
    <div class="space-y-4">
        @foreach($roles as $role)
            <div class="card bg-base-100 shadow border border-gray-200">
                <div class="card-body flex flex-row items-center justify-between p-4">
                    <div>
                        <h2 class="text-2xl font-bold text-neutral">{{ ucfirst($role->name) }}</h2>
                        <p class="text-sm text-gray-500 mt-1">
                            <span>{{ $role->users_count }}</span> Users
                        </p>
                    </div>

                    <!-- Expand Button -->
                    <button wire:click="toggleRole('{{ $role->name }}')" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>

                <!-- Accordion Content (only visible if opened) -->
                @if($openedRole === $role->name)
                    <div class="p-4 bg-gray-50">
                        @if($users->isEmpty())
                            <p class="text-gray-500 text-sm">No users found for this role.</p>
                        @else
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                                @foreach ($users as $user)
                                    <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col gap-4">
                                        <div class="flex items-center gap-4">
                                            <div class="avatar">
                                                <div class="w-14 rounded-full overflow-hidden">
                                                    <img src="https://i.pravatar.cc/100?u={{ $user->id }}" alt="User Avatar">
                                                </div>
                                            </div>
                                            <h3 class="font-bold text-xl">{{ $user->name }}</h3>
                                        </div>
                                        <div class="flex gap-2">
                                            <span class="badge text-xs px-3 py-1 border border-green-500 text-green-500 bg-white">3 ONGOING</span>
                                            <span class="badge text-xs px-3 py-1 border border-gray-400 text-black bg-white">2 COMPLETED</span>
                                        </div>
                                        <div class="flex flex-wrap gap-4 text-sm">
                                            <div>
                                                <p class="font-semibold">Role:</p>
                                                <p>{{ $user->roles->pluck('name')->join(', ') ?? 'N/A' }}</p>
                                            </div>
                                            <div>
                                                <p class="font-semibold">Status:</p>
                                                <p>Account Director</p>
                                            </div>
                                        </div>
                                        <hr class="my-2">
                                        <div class="text-right">
                                            <a href="#" class="bg-[#f43f1a] text-white text-sm btn btn-error">Go to User →</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-4">
                                {{ $users->links('pagination::tailwind') }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>

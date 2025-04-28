<div class="grid grid-cols-1 gap-4">
    @foreach ($users as $user)
        <div class="bg-white p-4 rounded-lg shadow flex items-center justify-between w-full">
            <!-- Left side: Avatar + Name + Role + Status -->
            <div class="flex items-center gap-6">
                <!-- Avatar -->
                <div class="avatar">
                    <div class="w-14 rounded-full overflow-hidden">
                        <img src="https://i.pravatar.cc/100?u={{ $user->id }}" alt="User Avatar">
                    </div>
                </div>

                <!-- Name, Role, Status -->
                <div class="flex flex-col gap-1">
                    <h3 class="font-bold text-lg">{{ $user->name }}</h3>
                    <div class="flex flex-wrap gap-6 text-sm text-gray-600">
                        <div>
                            <span class="font-semibold">Role:</span>
                            <span>{{ $user->roles->pluck('name')->join(', ') ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Status:</span>
                            <span>Account Director</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right side: Button -->
        <div class="text-right">
            <a 
        href="{{ request()->getHost() == 'central-domain.com' ? route('users-management.show', $user->id) : route('tenant.users-management.show', $user->id) }}"
        class="btn btn-error text-white text-sm bg-[#f43f1a] hover:bg-[#d43716]">
        Go to User →
        </a>
        </div>
        </div>
    @endforeach
</div>

<div class="mt-4">
    {{ $users->links('pagination::tailwind') }}
</div>

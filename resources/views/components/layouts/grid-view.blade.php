<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
    @foreach ($users as $user)
        <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col gap-4">
            <!-- Image and Name -->
            <div class="flex items-center gap-4">
                <div class="avatar">
                    <div class="w-14 rounded-full overflow-hidden">
                        <img src="https://i.pravatar.cc/100?u={{ $user->id }}" alt="User Avatar">
                    </div>
                </div>
                <h3 class="font-bold text-xl">{{ $user->name }}</h3>
            </div>

            <!-- Badges -->
            <div class="flex gap-2">
                <span class="badge text-xs px-3 py-1 border border-green-500 text-green-500 bg-white">3 ONGOING</span>
                <span class="badge text-xs px-3 py-1 border border-gray-400 text-black bg-white">2 COMPLETED</span>
            </div>

            <!-- Role & Status -->
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
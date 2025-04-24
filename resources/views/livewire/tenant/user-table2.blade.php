<div class="p-4 space-y-6">
    {{-- Breadcrumb --}}
    <div class="text-sm breadcrumbs mb-6">
        <ul>
            <li>
                <a href="{{ request()->routeIs('tenant.*') ? route('tenant.dashboard') : route('dashboard') }}" class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 4l9 5.75M4.5 10.5v6.75a.75.75 0 00.75.75H9v-3a1.5 1.5 0 013 0v3h3.75a.75.75 0 00.75-.75V10.5" />
                    </svg>
                    <span>Home</span>
                </a>
            </li>
            <li><span>Manage User</span></li>
        </ul>
    </div>

    {{-- Heading --}}
    <div class="mb-4">
        <h2 class="text-3xl font-bold">
            <span class="italic text-[#f43f1a]">Together</span> we are marbet.
        </h2>
    </div>

    {{-- Filters --}}
    <div class="bg-white p-4 rounded shadow-md space-y-4">
    <!-- Top Controls -->
    <div class="flex flex-wrap items-center justify-between gap-4">
        <!-- View buttons -->
        <div class="flex rounded overflow-hidden border">
    <!-- List View (Active) -->
    <button wire:click="setLayout('list')" class="px-4 py-2 rounded {{ $layout === 'list' ? 'bg-neutral text-white' : 'bg-gray-100 hover:bg-gray-200' }}">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z"/></svg>
        </button>

        <button wire:click="setLayout('grid')" class="px-4 py-2 rounded {{ $layout === 'grid' ? 'bg-neutral text-white' : 'bg-gray-100 hover:bg-gray-200' }}">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4h6v6H4V4zm10 0h6v6h-6V4zM4 14h6v6H4v-6zm10 0h6v6h-6v-6z"/></svg>
        </button>

        <button wire:click="setLayout('row')" class="px-4 py-2 rounded {{ $layout === 'row' ? 'bg-neutral text-white' : 'bg-gray-100 hover:bg-gray-200' }}">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M3 5h18v2H3V5zm0 6h18v2H3v-2zm0 6h18v2H3v-2z"/></svg>
        </button>
</div>

        <!-- Group and Sort -->
        <div class="flex flex-wrap gap-4">
            <div class="flex flex-col items-start">
                <span class="text-xs font-medium mb-1">Group</span>
                <select class="select select-sm select-bordered w-[160px]">
                    <option selected>Client</option>
                    <option>Internal</option>
                </select>
            </div>

            <div class="flex flex-col items-start">
                <span class="text-xs font-medium mb-1">Sort</span>
                <select class="select select-sm select-bordered w-[160px]">
                    <option selected>Most Projects</option>
                    <option>Least Projects</option>
                </select>
            </div>
        </div>

        <!-- Search and Action -->
        <div class="flex items-end gap-2">
            <div class="flex flex-col items-start">
                <span class="text-xs font-medium mb-1">Search</span>
                <input type="text" placeholder="Search..." class="input input-sm input-bordered w-[200px]" />
            </div>
            <button class="btn  btn-sm btn-outline " disabled>RESET</button>
            <button class="btn btn-sm btn-outline"><i class="fas fa-filter mr-1"></i> FILTER</button>
        </div>
    </div>

    <!-- Status & Account Manager + Apply Button -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="flex flex-col">
            <label class="text-sm font-medium mb-1">Status</label>
            <select class="select select-bordered w-full">
                <option selected>All</option>
                <option>Active</option>
                <option>Inactive</option>
            </select>
        </div>

        <div class="flex flex-col">
            <label class="text-sm font-medium mb-1">Account Manager</label>
            <select class="select select-bordered w-full">
                <option selected>All</option>
                <option>Manager A</option>
                <option>Manager B</option>
            </select>
        </div>

        <!-- Empty div for grid alignment -->
        <div class="md:col-span-2 flex justify-end">
            <button class="btn btn-disabled mt-2">APPLY</button>
        </div>
    </div>
</div>

    {{-- Grid View --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @foreach ($users as $user)
        <div class="bg-white p-4 rounded shadow flex flex-col gap-3">
            <!-- Image and Name -->
            <div class="flex items-center gap-4">
                <div class="avatar">
                    <div class="w-10 rounded-full overflow-hidden">
                        <img src="https://i.pravatar.cc/100?u={{ $user->id }}" alt="User Avatar">
                    </div>
                </div>
                <h3 class="font-bold text-lg">{{ $user->name }}</h3>
            </div>

            <!-- Ongoing and Completed Badges -->
            <div class="flex gap-2">
                <span class="badge text-xs px-2 py-0.5 border border-green-500 text-green-500 bg-white">3 ONGOING</span>
                <span class="badge text-xs px-2 py-0.5 border border-gray-400 text-black bg-white">2 COMPLETED</span>
            </div>

            <!-- Role and Status Labels Side by Side -->
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

            <!-- Divider and Button on Right -->
            <hr class="my-2">
            <div class="text-right">
                <a href="#" class="bg-[#f43f1a] text-white text-sm btn btn-error text-white">Go to User →</a>
            </div>
        </div>
    @endforeach
</div>
  <!-- Pagination Links -->
  <div class="mt-4">
    {{ $users->links('pagination::tailwind') }}
  </div>
</div>

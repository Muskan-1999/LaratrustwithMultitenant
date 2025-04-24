<div class="p-4 space-y-6">
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

    <div class="mb-4">
        <h2 class="text-3xl font-bold">
            <span class="italic text-[#f43f1a]">Together</span> we are marbet.
        </h2>
    </div>
    <div class="bg-white p-4 rounded shadow-md">
    <!-- Top Controls -->
    <div class="flex flex-wrap items-end justify-between gap-6">
        <!-- View Buttons -->
        <div class="flex rounded border overflow-hidden h-[40px]">
            <button wire:click="setLayout('list')" class="px-3 flex items-center justify-center {{ $layout === 'list' ? 'bg-neutral text-white' : 'bg-gray-100 hover:bg-gray-200' }}">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z"/>
                </svg>
            </button>
            <button wire:click="setLayout('grid')" class="px-3 flex items-center justify-center {{ $layout === 'grid' ? 'bg-neutral text-white' : 'bg-gray-100 hover:bg-gray-200' }}">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 4h6v6H4V4zm10 0h6v6h-6V4zM4 14h6v6H4v-6zm10 0h6v6h-6v-6z"/>
                </svg>
            </button>
            <button wire:click="setLayout('row')" class="px-3 flex items-center justify-center {{ $layout === 'row' ? 'bg-neutral text-white' : 'bg-gray-100 hover:bg-gray-200' }}">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M3 5h18v2H3V5zm0 6h18v2H3v-2zm0 6h18v2H3v-2z"/>
                </svg>
            </button>
        </div>

        <!-- Group and Sort -->
        <div class="flex gap-1 items-end"> <!-- reduced gap here -->
    <div class="flex flex-col">
        <label class="text-sm font-semibold mb-1">Group</label>
        <select class="select select-sm select-bordered w-[160px]">
            <option selected>Client</option>
            <option>Internal</option>
        </select>
    </div>
    <div class="flex flex-col">
        <label class="text-sm font-semibold mb-1">Sort</label>
        <select class="select select-sm select-bordered w-[160px]">
            <option selected>Most Projects</option>
            <option>Least Projects</option>
        </select>
    </div>
</div>

        <!-- Search and Filter -->
        <div class="flex gap-2 items-end">
            <div class="flex flex-col">
                <label class="text-sm font-semibold mb-1">Search</label>
                <input type="text" placeholder="Search..." class="input input-sm input-bordered w-[200px]" />
            </div>
            <button class="btn btn-sm btn-outline" disabled>RESET</button>
            <button class="btn btn-sm btn-outline"><i class="fas fa-filter mr-1"></i> FILTER</button>
        </div>
    </div>
</div>


{{-- Grid View --}}
<div class="bg-white p-4 rounded shadow-md mb-6">

    <div class="space-y-4">
        @foreach($roles as $role)
            <div class="card bg-base-100 shadow border border-gray-200">
                <div class="card-body flex flex-row items-center justify-between p-4">
                    <div>
                    <h2 class="text-2xl font-bold text-neutral">{{ ucfirst($role->name) }}</h2>
                        <p class="text-sm text-gray-500 mt-1">
                            <span >{{ $role->users_count }}</span> Users
                        </p>
                    </div>
                     <!-- Open Button -->
                     <button class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"  d="M19 9l-7 7-7-7" />
                </svg>
             </button>
                </div>
            </div>
        @endforeach
    </div>
</div>


</div>

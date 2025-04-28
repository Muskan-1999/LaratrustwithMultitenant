<!-- Top Layout Card -->
 <div>
 <div class="p-6">
        <!-- Breadcrumb -->
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
                <li><span>{{$user->name}}</span></li>
            </ul>
        </div>
    </div>
    <div class="p-6 bg-white rounded-lg shadow-lg mb-6">
        <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
        <div class="mt-6 flex gap-2">
            <span class="badge text-xs px-3 py-1 border border-green-500 text-green-500 bg-white">3 ONGOING</span>
            <span class="badge text-xs px-3 py-1 border border-gray-400 text-black bg-white">2 COMPLETED</span>
        </div>
        <div class="mt-4 flex flex-wrap gap-4 text-sm">
            <div>
                <span class="font-semibold">Role:</span>
                <span>{{ $user->roles->pluck('name')->join(', ') ?? 'N/A' }}</span>
            </div>
            <div>
                <span class="font-semibold">Status:</span>
                <span>Account Director</span>
            </div>
            <div>
                <span class="font-semibold">Email:</span>
                <span>{{ $user->email }}</span>
            </div>
            <div>
                <span class="font-semibold">Phone:</span>
                <span>0123456789</span> <!-- you can add a phone column if needed -->
            </div>
        </div>
    </div>

<div class="card bg-base-100 shadow-sm rounded-2xl p-4 mb-6">
    <div class="flex items-center gap-4">

        <!-- Layout Buttons -->
        <div class="flex bg-base-200 rounded-lg overflow-hidden items-center">
            <button wire:click="setLayout('list')" class="px-3 py-2 h-full {{ $layout === 'list' ? 'bg-neutral text-white' : 'hover:bg-base-300' }}">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z"/></svg>
            </button>
            <button wire:click="setLayout('grid')" class="px-3 py-2 h-full {{ $layout === 'grid' ? 'bg-neutral text-white' : 'hover:bg-base-300' }}">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4h6v6H4V4zm10 0h6v6h-6V4zM4 14h6v6H4v-6zm10 0h6v6h-6v-6z"/></svg>
            </button>
            <button wire:click="setLayout('row')" class="px-3 py-2 h-full {{ $layout === 'row' ? 'bg-neutral text-white' : 'hover:bg-base-300' }}">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M3 5h18v2H3V5zm0 6h18v2H3v-2zm0 6h18v2H3v-2z"/></svg>
            </button>
        </div>

        <!-- Group Dropdown -->
        <div class="flex flex-col justify-center">
            <label class="text-xs font-medium text-neutral-500 mb-1">Group</label>
            <select class="select select-sm bg-base-200 text-sm font-medium border-none focus:outline-none">
                <option selected>Client</option>
                <option>Internal</option>
            </select>
        </div>

        <!-- Divider -->
        <div class="h-8 w-px bg-base-300"></div>

        <!-- Search, Reset, Filter -->
        <div class="flex items-center gap-2 flex-1">
            <input type="text" wire:model.live="search" placeholder="Search..." class="input input-sm bg-base-200 border-none w-full max-w-lg" />
            <button wire:click="resetSearch" type="button" class="btn btn-sm text-xs font-semibold bg-base-200 text-neutral hover:bg-base-300">
                ✕ Reset
            </button>
            <button class="btn btn-sm btn-outline text-xs font-semibold gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 13.414V19a1 1 0 01-1.447.894l-4-2A1 1 0 019 17v-3.586L3.293 6.707A1 1 0 013 6V4z" />
                </svg>
                FILTER
            </button>
        </div>

    </div>
</div>

<!-- 🔥 BELOW THIS — Event Card (Website Redesign Launch Event) -->

<div class="card bg-base-100 shadow-sm rounded-2xl p-6">

    <!-- Top: Title and Time to Event -->
    <div class="flex justify-between items-start mb-4">
        <div>
            <p class="text-xs text-neutral-400 mb-1">Mercedes-Benz Consulting GmbH</p>
            <h2 class="text-lg font-semibold">Website Redesign Launch Event</h2>
        </div>
        <div class="flex items-center gap-2">
            <span class="badge badge-success badge-outline text-xs">ONGOING</span>
        </div>
    </div>

    <!-- Dates and Time to Event -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-6 text-sm text-neutral-500">
            <div class="flex items-center gap-2">
                <span class="font-medium text-neutral-700">Start:</span> 
                <span>12.01.2026</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="font-medium text-neutral-700">End:</span> 
                <span>30.05.2026</span>
            </div>
        </div>
        <div class="text-sm text-neutral-500">
            Time to Event <span class="font-bold text-neutral-700">35 days</span>
        </div>
    </div>

    <!-- User Avatars -->
    <div class="flex items-center gap-6 mb-4">
        <div class="flex items-center gap-2">
            <div class="avatar">
                <div class="w-10 rounded-full">
                    <img src="https://i.pravatar.cc/40?img=1" alt="User 1" />
                </div>
            </div>
            <div class="flex flex-col">
    <!-- Display user name -->
    <span class="font-semibold text-sm">{{ $user->name }}</span>
    
    <!-- Display user roles (joining roles into a single string) -->
    <span class="text-xs text-neutral-400">
        {{ $userRoles->implode(', ') }} <!-- This will display roles like 'Admin, Manager' -->
    </span>
</div>
        </div>
        <div class="flex items-center gap-2">
            <div class="avatar">
                <div class="w-10 rounded-full">
                    <img src="https://i.pravatar.cc/40?img=2" alt="User 2" />
                </div>
            </div>
            <div class="flex flex-col">
                <span class="font-semibold text-sm">Johnny Siebenschläfer-Schmidt</span>
                <span class="text-xs text-neutral-400">Client</span>
            </div>
        </div>
    </div>

    <!-- Progress Bar -->
    <div class="w-full bg-base-200 h-2 rounded-full mb-2">
        <div class="bg-green-500 h-2 rounded-full" style="width: 30%;"></div>
    </div>

    <!-- Stats: Confirmed, Declined, Open, Total -->
    <div class="flex justify-between text-sm text-neutral-500 mt-2">
        <div>Confirmed <span class="text-green-600 font-bold">10.000</span></div>
        <div>Declined <span class="text-red-500 font-bold">12.000</span></div>
        <div>Open <span class="text-neutral-700 font-bold">12.000</span></div>
        <div>Total <span class="text-neutral-700 font-bold">34.000</span></div>
    </div>

    <!-- Bottom Buttons -->
    <div class="flex justify-end items-center gap-4 mt-6">
    <!-- Registration Page button with red text and not bold -->
    <button class="btn btn-ghost text-sm text-red-500 font-normal">Registration Page</button>
    
    <!-- GO TO PROJECT button (remains as is) -->
    <button class="btn btn-error text-white text-sm bg-[#f43f1a] hover:bg-[#d43716]">
        GO TO PROJECT →
    </button>
</div>

</div>

</div>
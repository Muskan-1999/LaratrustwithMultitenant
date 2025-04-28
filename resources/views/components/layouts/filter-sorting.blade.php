<div class="card bg-base-100 shadow-sm rounded-2xl p-4 mb-6">
    <div class="flex flex-wrap items-center gap-4">
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

    <!-- Group -->
    <div class="flex flex-col justify-between h-[58px] w-[85px]">
        <label class="text-xs font-medium text-neutral-500">Group</label>
        <select class="select select-sm bg-base-200 text-sm font-medium border-none focus:outline-none">
            <option selected>Client</option>
            <option>Internal</option>
        </select>
    </div>

    <!-- Sort -->
    <div class="flex flex-col justify-between h-[56px] w-[150px]">
        <label class="text-xs font-medium text-neutral-500">Sort</label>
        <select class="select select-sm bg-base-200 text-sm font-medium border-none focus:outline-none">
            <option selected>Most Projects</option>
            <option>Least Projects</option>
        </select>
    </div>

        <!-- Search and Buttons -->
        <div class="flex items-end gap-2 ml-auto">
            <input type="text" wire:model.live="search" placeholder="Search..." class="input input-sm bg-base-200 border-none w-[200px]" />
            <button wire:click="resetSearch" type="button" class="btn btn-sm text-xs font-semibold bg-base-200 text-neutral hover:bg-base-300">✕ Reset</button>
            <button class="btn btn-sm btn-outline text-xs font-semibold gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 13.414V19a1 1 0 01-1.447.894l-4-2A1 1 0 019 17v-3.586L3.293 6.707A1 1 0 013 6V4z" />
                </svg>
                FILTER
            </button>
        </div>
    </div>
</div>

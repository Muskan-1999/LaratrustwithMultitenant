@props([
    'view' => 'list',
    'modes' => ['list', 'grid', 'row'],
    'property' => 'viewMode',
    'search' => 'search',
    'resetMethod' => 'resetFilters',
])
<div class="bg-white p-4 shadow rounded-lg flex items-center gap-4">
    {{-- View Toggle --}}
    <div class="flex space-x-1 border rounded-md overflow-hidden">
        @foreach ($modes as $mode)
            <button
                wire:click="$set('{{ $property }}', '{{ $mode }}')"
                class="btn btn-sm px-3 py-2 rounded-none border-0 {{ $view === $mode ? 'bg-black text-white' : 'bg-white text-black hover:bg-gray-100' }}"
                title="{{ ucfirst($mode) }}"
            >
                @switch($mode)
                    @case('list') <x-heroicon-o-list-bullet class="w-4 h-4" /> @break
                    @case('grid') <x-heroicon-o-view-columns class="w-4 h-4" /> @break
                    @case('row') <x-heroicon-o-table-cells class="w-4 h-4" /> @break
                    @default {{ ucfirst($mode) }}
                @endswitch
            </button>
        @endforeach
    </div>

    {{-- Group + Sort (sample dropdowns) --}}
    <div class="flex flex-col justify-between h-[58px] w-[85px]">
        <label class="label text-xs font-semibold">Group</label>
        <select class="select select-sm bg-base-200 text-sm font-medium border-none focus:outline-none">
            <option selected>Client</option>
            <option>Internal</option>
        </select>
    </div>

    <!-- Sort -->
    <div class="flex flex-col justify-between h-[56px] w-[150px]">
        <label class="label text-xs font-semibold">Sort</label>
        <select class="select select-sm bg-base-200 text-sm font-medium border-none focus:outline-none">
            <option selected>Most Projects</option>
            <option>Least Projects</option>
        </select>
    </div>


    {{-- Spacer --}}
    <div class="flex-1"></div>

    {{-- Search --}}
    <input type="text" placeholder="Search" wire:model.debounce.500ms="{{ $search }}" class="input input-bordered input-sm w-48" />

    {{-- Buttons --}}
    <button wire:click="{{ $resetMethod }}" class="btn btn-sm btn-disabled">✕ Reset</button>
    <button class="btn btn-sm btn-outline text-xs font-semibold gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 13.414V19a1 1 0 01-1.447.894l-4-2A1 1 0 019 17v-3.586L3.293 6.707A1 1 0 013 6V4z" />
                </svg>
                FILTER
            </button>
</div>
@php
    $view = $view ?? $attributes->get('view');
@endphp
<div class="flex space-x-2">
    @foreach ($modes as $mode)
        <button
            wire:click="$set('{{ $property }}', '{{ $mode }}')"
            class="btn btn-sm {{ $view === $mode ? 'btn-primary' : 'btn-outline' }}"
            title="{{ ucfirst($mode) }} View"
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

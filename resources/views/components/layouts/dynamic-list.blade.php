@props([
'columns' => [],
'rows' => [],
'perPage' => 10,
'emptyMessage' => 'No records found.',
'sortable' => false,
'sortColumn' => null,
'sortDirection' => 'asc',
])

<div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="table table-zebra w-full text-sm">
        <thead class="bg-base-200 text-base-content">
            <tr>
                @foreach ($columns as $index => $column)
                @php
                $isActionColumn = strtolower($column) === 'actions';
                @endphp
                <th class="{{ $isActionColumn ? '' : 'cursor-pointer select-none' }}">
                    <div class="flex items-center gap-1">
                        {{ $column }}

                        @if ($sortable && !$isActionColumn)
                        <button wire:click="$dispatch('sortColumn', { column: '{{ $column }}' })" class="text-xs">
                            @if ($sortColumn === $column && $sortDirection === 'asc')
                            <i class="fas fa-sort-up"></i>
                            @elseif ($sortColumn === $column && $sortDirection === 'desc')
                            <i class="fas fa-sort-down"></i>
                            @else
                            <i class="fas fa-sort text-gray-400"></i>
                            @endif
                        </button>
                        @elseif (!$sortable && !$isActionColumn)
                        <i class="fas fa-sort text-gray-300"></i> {{-- Static icon when sorting is disabled --}}
                        @endif
                    </div>
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
            <tr>
                @foreach ($row as $key => $cell)
                @if ($key === 'actions')
                {{-- Actions Column --}}
                <td class="flex gap-2">
                    {{-- View --}}
                    @if (!empty($cell['view']['method']) && isset($cell['view']['param']))
                    <button wire:click="{{ $cell['view']['method'] }}({{ $cell['view']['param'] }})" class="btn btn-sm btn-ghost" title="View">
                        <i class="fas fa-eye"></i>
                    </button>
                    @endif

                    {{-- Edit --}}
                    @if (!empty($cell['edit']['method']) && isset($cell['edit']['param']))
                    <button wire:click="{{ $cell['edit']['method'] }}({{ $cell['edit']['param'] }})" class="btn btn-sm btn-ghost" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    @endif

                    {{-- Delete --}}
                    @if (!empty($cell['delete']['method']) && isset($cell['delete']['param']))
                    <button wire:click="{{ $cell['delete']['method'] }}({{ $cell['delete']['param'] }})" class="btn btn-sm btn-ghost text-red-600" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                    @endif
                </td>
                @else
                <td>{!! $cell !!}</td>
                @endif
                @endforeach
            </tr>
            @empty
            <tr>
                <td colspan="{{ count($columns) }}" class="text-center py-4">
                    {{ $emptyMessage }}
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    @if(method_exists($rows, 'links'))
    <div class="p-4">
        {{ $rows->links() }}
    </div>
    @endif
</div>
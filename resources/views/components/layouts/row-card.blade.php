@props([ 
    'avatar' => null,
    'title',
    'badges' => [],
    'meta' => [],
    'actionMethod' => null,
    'actionParam' => null,
    'isOpen' => false,
])

<div class="bg-white p-4 rounded shadow-md mb-6">
    <div class="space-y-4">
        <div class="card bg-base-100 shadow border border-gray-200">
            <div class="card-body flex flex-row items-center justify-between p-4">
                <div>
                    <h2 class="text-2xl font-bold text-neutral">{{ $title }}</h2>
                    @foreach ($meta as $label => $value)
                        <p class="text-sm text-gray-500 mt-1"><span>{{ $value }}</span> {{ $label }}</p>
                    @endforeach
                </div>
                <button wire:click="{{ $actionMethod }}('{{ $actionParam }}')" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>

            @if($isOpen)
                <div class="p-4 bg-gray-50">
                    {{ $slot }}
                </div>
            @endif
        </div>
    </div>
</div>

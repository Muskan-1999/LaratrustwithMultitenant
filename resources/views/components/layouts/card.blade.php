@props([
    'entity',
    'fields' => [], // Array of ['label' => 'attribute'] or closures
    'badges' => [],
    'buttonLink' => '#',
    'buttonText' => 'View →',
])

<div class="bg-white p-6 rounded-lg shadow-lg flex flex-col gap-4">
    <div class="flex items-center gap-4">
        @if($entity?->id)
            <div class="avatar">
                <div class="w-14 rounded-full overflow-hidden">
                    <img src="https://i.pravatar.cc/100?u={{ $entity->id }}" alt="Avatar">
                </div>
            </div>
        @endif
        <h3 class="font-bold text-xl">{{ $entity->name ?? $entity->title }}</h3>
    </div>

    @if (!empty($badges))
        <div class="flex gap-2">
            @foreach ($badges as $badge)
                <span class="badge text-xs px-3 py-1 border border-gray-400 text-black bg-white">{{ $badge }}</span>
            @endforeach
        </div>
    @endif

    <div class="flex flex-wrap gap-4 text-sm">
        @foreach ($fields as $label => $value)
            <div>
                <p class="font-semibold">{{ $label }}:</p>
                <p>{{ is_callable($value) ? $value($entity) : data_get($entity, $value, 'N/A') }}</p>
            </div>
        @endforeach
    </div>

    <hr class="my-2">
    <div class="text-right">
        <a href="{{ $buttonLink }}" class="bg-[#f43f1a] text-white text-sm btn btn-error">{{ $buttonText }}</a>
    </div>
</div>

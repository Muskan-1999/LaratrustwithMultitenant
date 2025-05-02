@props([ 
    'avatar' => null,
    'title',
    'badges' => [],
    'meta' => [],
    'actionText' => 'Go to',
    'actionRoute' => '#'
])

<div class="grid grid-cols-1 gap-4">
    <div class="bg-white p-4 rounded-lg shadow flex flex-col justify-between w-full">
        <!-- Top section: Avatar + Content -->
        <div class="flex flex-col gap-2">
            <!-- Title with avatar -->
            <div class="flex items-center gap-2">
                <div class="avatar">
                    <div class="w-8 h-8 rounded-full overflow-hidden">
                        <img src="{{ $avatar ?? 'https://i.pravatar.cc/100?u=' }}" alt="avatar" />
                    </div>
                </div>
                <h3 class="font-bold text-lg">{{ $title }}</h3>
            </div>

            <!-- Smaller Badges -->
            <div class="flex gap-1 my-0.5">
                @foreach ($badges as $badge)
                    @if ($badge['text'] === 'ONGOING')
                        <span class="badge text-[10px] px-2 py-0.5 border border-green-500 text-green-500 bg-white">
                            {{ $badge['text'] }}
                        </span>
                    @elseif ($badge['text'] === 'COMPLETED')
                        <span class="badge text-[10px] px-2 py-0.5 border border-gray-400 text-black bg-white">
                            {{ $badge['text'] }}
                        </span>
                    @endif
                @endforeach
            </div>

            <!-- Meta Info + Action Button -->
            <div class="flex items-end justify-between mt-1">
                <div class="flex flex-wrap gap-6 text-sm text-gray-600">
                    @foreach ($meta as $label => $value)
                        <div>
                            <span class="font-semibold">{{ $label }}:</span>
                            <span>{{ $value }}</span>
                        </div>
                    @endforeach
                </div>

                <div>
                    <a href="{{ $actionRoute }}" class="btn btn-error text-white text-sm bg-[#f43f1a] hover:bg-[#d43716]">
                        {{ $actionText }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


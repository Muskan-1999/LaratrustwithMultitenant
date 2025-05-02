<nav class="text-sm mb-4" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-1 text-gray-600">
        @foreach ($items as $item)
            @if ($loop->first)
                <li class="flex items-center space-x-1">
                    <!-- Home Icon -->
                    <svg class="w-4 h-4 text-black" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2L2 8h2v8h4V12h4v4h4V8h2L10 2z" />
                    </svg>
                    <a href="{{ $item['url'] }}" class="ml-1 text-black font-medium">Home</a>
                </li>
            @elseif (!$loop->last)
                <li class="flex items-center space-x-1">
                    <span class="mx-1">›</span>
                    <a href="{{ $item['url'] }}" class="text-gray-600 hover:underline">
                        {{ $item['label'] }}
                    </a>
                </li>
            @else
                <li class="flex items-center space-x-1">
                    <span class="mx-1">›</span>
                    <span class="text-black font-medium">{{ $item['label'] }}</span>
                </li>
            @endif
        @endforeach
    </ol>
</nav>

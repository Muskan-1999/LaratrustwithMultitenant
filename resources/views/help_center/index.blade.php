<x-app-layout>
    <div class="p-6">
        <!-- Breadcrumb -->
        <div class="text-sm breadcrumbs mb-2"> {{-- reduced mb-6 to mb-2 --}}
            <ul>
                <li>
                    <a href="{{ request()->routeIs('tenant.*') ? route('tenant.dashboard') : route('dashboard') }}" class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 4l9 5.75M4.5 10.5v6.75a.75.75 0 00.75.75H9v-3a1.5 1.5 0 013 0v3h3.75a.75.75 0 00.75-.75V10.5" />
                        </svg>
                        <span>Home</span>
                    </a>
                </li>
                <li><span>Help Center</span></li>
            </ul>
        </div>

        <!-- Page Title -->
        <div class="card bg-base-100 shadow p-6 mb-6">
            <h2 class="text-2xl font-bold flex items-center gap-3">Help Center</h2>
        </div>

<!-- Support and FAQ Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
    <!-- Support Card -->
    <div class="card bg-base-100 shadow p-5">
        <h3 class="text-lg font-semibold mb-2">Support</h3>
        <p class="text-sm text-gray-600 mb-4 leading-snug line-clamp-2">
            If a dog chews shoes whose shoes does he choose? This is additional text to test the line limit behavior.
        </p>
        <div class="flex justify-end">
            <a href="#" class="bg-[#f43f1a] text-white text-sm font-semibold px-4 py-2 rounded shadow hover:bg-[#e63817] transition-all">
                RECEIVE HELP →
            </a>
        </div>
    </div>

    <!-- FAQ Card -->
    <div class="card bg-base-100 shadow p-5">
        <h3 class="text-lg font-semibold mb-2">FAQ</h3>
        <p class="text-sm text-gray-600 mb-4 leading-snug line-clamp-2">
            If a dog chews shoes whose shoes does he choose? This is extra text to test the clamping behavior.
        </p>
        <div class="flex justify-end">
            <a href="#" class="bg-[#f43f1a] text-white text-sm font-semibold px-4 py-2 rounded shadow hover:bg-[#e63817] transition-all">
                CHECK THE FAQ →
            </a>
        </div>
    </div>
</div>
        <!-- Quick Start Guide -->
        <div class="card bg-base-100 shadow p-6">
            <h3 class="text-xl font-semibold mb-4 flex items-center">
                <span class="mr-2 inline-flex items-center justify-center w-6 h-6 rounded-full bg-black text-white text-sm font-bold">?</span>
                Quick Start Guide
            </h3>

            <div class="space-y-4">
                @foreach ([
                    'Setting up your first event',
                    'Manage participants',
                    'Customize forms',
                    'Reports and analytics'
                ] as $item)
                    <div class="flex items-center justify-between bg-white p-4 rounded shadow-sm">
                        <span class="text-sm text-gray-800">{{ $item }}</span>
                        <a href="#" class="bg-[#f43f1a] text-white text-xs font-semibold px-4 py-2 rounded hover:bg-[#e63817] transition-all">
                            EXPLORE →
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
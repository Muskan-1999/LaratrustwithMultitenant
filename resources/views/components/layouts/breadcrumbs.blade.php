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
            </ul>
        </div>
    </div>
       <!-- Page Heading -->
       <div class="mb-4">
        <h2 class="text-3xl font-bold">
            <span class="italic text-[#f43f1a]">Explore</span> the marbetsphere.
        </h2>
    </div>

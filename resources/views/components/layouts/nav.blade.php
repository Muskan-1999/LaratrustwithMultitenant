<!-- Left side: Logo and Navigation -->
<div class="flex items-center">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 mr-12">
        <span class="text-red-600 font-bold text-xl">market</span>
        <span class="text-gray-800 font-bold text-xl">m.guest</span>
    </a>

    <nav class="flex items-center gap-4">
        <!-- Projects -->
        <a href="{{ request()->routeIs('tenant.*') ? route('tenant.project') : route('project') }}"
           class="text-sm font-semibold px-4 py-2 rounded transition-all
           {{ request()->routeIs('project') || request()->routeIs('tenant.project') ? 'bg-[#f43f1a] text-white' : 'text-gray-800 hover:text-[#f43f1a]' }}">
            Project
        </a>
        {{var_dump(tenant());}}
        <a href="{{ tenant() ? route('tenant.user-management.index') : route('user-management.index') }}"
           class="text-sm font-semibold px-4 py-2 rounded transition-all"
        >
            Manage User
        </a>
        <!-- Tenants (central only) -->
         @if (!tenant())
            <a href="{{ route('tenants.index') }}"
               class="text-sm font-semibold px-4 py-2 rounded transition-all
               {{ request()->routeIs('tenants.*') ? 'bg-[#f43f1a] text-white' : 'text-gray-800 hover:text-[#f43f1a]' }}">
                Tenants
            </a>
        @endif

        <!-- Users (tenant only) -->
        @if (tenant())
            <a href="{{ route('tenant.users.index') }}"
               class="text-sm font-semibold px-4 py-2 rounded transition-all
               {{ request()->routeIs('tenant.users.*') ? 'bg-[#f43f1a] text-white' : 'text-gray-800 hover:text-[#f43f1a]' }}">
                User
            </a>
        @endif

        <!-- Help Center -->
        <a href="{{ request()->routeIs('tenant.*') ? route('tenant.help-center') : route('help-center') }}"
           class="text-sm font-semibold px-4 py-2 rounded transition-all
           {{ request()->routeIs('help-center') || request()->routeIs('tenant.help-center') ? 'bg-[#f43f1a] text-white' : 'text-gray-800 hover:text-[#f43f1a]' }}">
            Help Center
        </a>

        @if (tenant())
        <a href="{{ url('/laratrust') }}"
             class="text-sm font-semibold px-4 py-2 rounded transition-all
           {{ request()->is('laratrust*') ? 'bg-[#f43f1a] text-white' : 'text-gray-800 hover:text-[#f43f1a]' }}">
           Roles and Permissions
           </a>
        @endif
    </nav>
</div>

<!-- Right side: Search and Profile -->
<div class="flex items-center gap-4">
    <div class="flex items-center gap-2">
        <input type="text" placeholder="Search..." class="input input-bordered w-48" />
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="cursor-pointer">
                <div class="avatar">
                    <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center p-2">
                        <span class="text-sm font-bold uppercase leading-none">{{ substr(auth()->user()->name ?? 'SU', 0, 2) }}</span>
                    </div>
                </div>
            </label>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52 mt-2">
                <li><a href="{{ request()->is('*/dashboard') ? route('profile.edit') : route('tenant.profile.edit') }}">Profile</a></li>
                <li>
                    <form method="POST" action="{{ request()->routeIs('tenant.*') ? route('tenant.logout') : route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left text-sm hover:bg-base-200">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
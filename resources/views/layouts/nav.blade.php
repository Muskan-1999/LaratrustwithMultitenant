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
            Projects
        </a>
        <a href="{{ request()->routeIs('tenant.*') ? route('tenant.user-management.index') : route('user-management.index') }}"
           class="text-sm font-semibold px-4 py-2 rounded transition-all
           {{ request()->routeIs('user-management.index') || request()->routeIs('tenant.user-management.index') ? 'bg-[#f43f1a] text-white' : 'text-gray-800 hover:text-[#f43f1a]' }}">
           ManageUser
        </a>

        <!-- Tenants (central only) -->
        @if (!tenant())
            <a href="{{ route('tenant-list') }}"
               class="text-sm font-semibold px-4 py-2 rounded transition-all
               {{ request()->routeIs('tenant-list') ? 'bg-[#f43f1a] text-white' : 'text-gray-800 hover:text-[#f43f1a]' }}">
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
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
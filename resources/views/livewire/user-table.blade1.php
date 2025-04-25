<div class="px-6 py-4">
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
            <li>
                <span>Manage User</span>
            </li>
        </ul>
    </div>
</div>

  <!-- Page Heading -->
  <div class="mb-4">
    <h2 class="text-3xl font-bold">
      <span class="italic text-[#f43f1a]">Explore</span> the marbetsphere.
    </h2>
  </div>

  <!-- Search and Filter Controls -->
  <div class="bg-white p-4 rounded shadow flex items-center gap-3 w-full">
    <!-- View Toggle Buttons -->
    <div class="flex rounded overflow-hidden border">
    <!-- List View (Active) -->
    <button wire:click="setLayout('list')" class="px-4 py-2 rounded {{ $layout === 'list' ? 'bg-neutral text-white' : 'bg-gray-100 hover:bg-gray-200' }}">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z"/></svg>
        </button>

        <button wire:click="setLayout('grid')" class="px-4 py-2 rounded {{ $layout === 'grid' ? 'bg-neutral text-white' : 'bg-gray-100 hover:bg-gray-200' }}">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4h6v6H4V4zm10 0h6v6h-6V4zM4 14h6v6H4v-6zm10 0h6v6h-6v-6z"/></svg>
        </button>

        <button wire:click="setLayout('row')" class="px-4 py-2 rounded {{ $layout === 'row' ? 'bg-neutral text-white' : 'bg-gray-100 hover:bg-gray-200' }}">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M3 5h18v2H3V5zm0 6h18v2H3v-2zm0 6h18v2H3v-2z"/></svg>
        </button>
</div>

    <!-- Search Input -->
    <input wire:model.live="search" type="text" placeholder="Search....." class="input input-bordered flex-1" />

    <!-- Reset Button -->
    <button wire:click="resetSearch" type="button" class="btn text-dark-400 font-semibold px-4">✕ Reset</button>

    <!-- Filter Button -->
    <button class="btn btn-outline font-semibold gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 13.414V19a1 1 0 01-1.447.894l-4-2A1 1 0 019 17v-3.586L3.293 6.707A1 1 0 013 6V4z" />
        </svg>
        FILTER
    </button>
</div>

  <!-- Projects Table -->
  <div class="overflow-x-auto">
  @if($layout === 'list')
    <table class="table w-full">
      <thead class="bg-base-200 text-sm font-semibold text-gray-700">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Created</th>
          <th>Updated</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Example row -->
        @forelse ($users as $user)
          <tr class="hover">
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach ($user->roles as $role)
                    <span class="badge badge-info text-white">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at}}</td>
            <td class="flex gap-2">
              <button class="btn btn-sm btn-ghost"><i class="fas fa-eye"></i></button>
              <button class="btn btn-sm btn-ghost"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-ghost text-red-600"><i class="fas fa-trash"></i></button>
            </td>
          </tr>
          @empty
            <tr>
                    <td colspan="5" class="text-center">No users found.</td>
            </tr>
            @endforelse
      </tbody>
    </table>
  </div>
    <!-- Pagination Links -->
    <div class="mt-4">
    {{ $users->links('pagination::tailwind') }}
  </div>
  @elseif($layout === 'grid')
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($users as $user)
            <div class="bg-white p-4 rounded shadow flex flex-col gap-2">
                <div class="flex items-center gap-3">
                    <div class="avatar">
                        <div class="w-12 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                            <img src="https://i.pravatar.cc/100?u={{ $user->id }}" alt="User Avatar">
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">{{ $user->name }}</h3>
                        <div class="flex gap-2 text-xs">
                            <span class="badge badge-success">3 ONGOING</span>
                            <span class="badge badge-neutral">2 COMPLETED</span>
                        </div>
                    </div>
                </div>

                <div class="text-sm">
                    <p><span class="font-semibold">Role:</span> {{ $user->roles->pluck('name')->join(', ') ?? 'N/A' }}</p>
                    <p><span class="font-semibold">Status:</span> Account Director</p>
                </div>

                <div class="mt-auto">
                    <a href="{{ route('users.show', $user) }}" class="btn btn-error text-white w-full">Go to User →</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
</div>
@elseif($layout === 'row')
<div></div>
@endif
</div>

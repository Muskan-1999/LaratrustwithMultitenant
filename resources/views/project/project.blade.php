<x-app-layout>
<div class="px-6 py-4">

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
                <span>Project</span>
            </li>
        </ul>
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
    <button class="bg-neutral text-white px-4 py-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z" />
        </svg>
    </button>

    <!-- Grid View (Inactive) -->
    <button class="bg-gray-100 hover:bg-gray-200 px-4 py-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M4 4h6v6H4V4zm10 0h6v6h-6V4zM4 14h6v6H4v-6zm10 0h6v6h-6v-6z" />
        </svg>
    </button>

    <!-- Row View (Inactive) -->
    <button class="bg-gray-100 hover:bg-gray-200 px-4 py-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M3 5h18v2H3V5zm0 6h18v2H3v-2zm0 6h18v2H3v-2z" />
        </svg>
    </button>
</div>

    <!-- Search Input -->
    <input type="text" placeholder="Search....." class="input input-bordered flex-1" />

    <!-- Reset Button -->
    <button class="btn  text-dark-400 font-semibold px-4">✕ Reset</button>

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
    <table class="table w-full">
      <thead class="bg-base-200 text-sm font-semibold text-gray-700">
        <tr>
          <th>Project</th>
          <th>Status</th>
          <th>Start</th>
          <th>End</th>
          <th>Created</th>
          <th>Owner</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Example row -->
        @for ($i = 0; $i < 20; $i++)
          <tr class="hover">
            <td>Website Redesign Launch</td>
            <td><span class="badge badge-success">Ongoing</span></td>
            <td>12.10.2025</td>
            <td>12.05.2025</td>
            <td>12.03.2025</td>
            <td>Stefan</td>
            <td class="flex gap-2">
              <button class="btn btn-sm btn-ghost"><i class="fas fa-eye"></i></button>
              <button class="btn btn-sm btn-ghost"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-ghost text-red-600"><i class="fas fa-trash"></i></button>
            </td>
          </tr>
        @endfor
      </tbody>
    </table>
  </div>
</div>
</x-app-layout>
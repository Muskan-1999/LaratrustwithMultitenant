<x-app-layout>
<div class="px-6 py-4">
  <!-- Page Heading -->
  <div class="mb-4">
    <h2 class="text-3xl font-bold">
      <span class="italic text-[#f43f1a]">Explore</span> the marbetsphere.
    </h2>
  </div>

  <!-- Search and Filter Controls -->
  <div class="flex items-center gap-4 mb-4">
    <button class="btn btn-square btn-outline">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <input type="text" placeholder="Search..." class="input input-bordered w-full max-w-xs" />

    <button class="btn btn-outline">Filter</button>
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
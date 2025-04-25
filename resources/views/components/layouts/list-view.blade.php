<div class="overflow-x-auto">
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

            <div class="mt-4">
                {{ $users->links('pagination::tailwind') }}
            </div>
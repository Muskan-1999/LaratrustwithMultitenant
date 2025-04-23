<x-app-layout>
    <div class="py-6">
        <div class="mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">{{ tenant()->name ?? 'Tenant' }} Dashboard</h2>
                <span class="badge badge-primary">{{ tenant()->plan ?? 'Free' }} Plan</span>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="stats shadow">
                    <div class="stat">
                        <div class="stat-title">Active Projects</div>
                        <div class="stat-value">{{ $activeProjects ?? 0 }}</div>
                        <div class="stat-desc">In your workspace</div>
                    </div>
                </div>

                <div class="stats shadow">
                    <div class="stat">
                        <div class="stat-title">Team Members</div>
                        <div class="stat-value">{{ $teamMembers ?? 0 }}</div>
                        <div class="stat-desc">Active users</div>
                    </div>
                </div>

                <div class="stats shadow">
                    <div class="stat">
                        <div class="stat-title">Storage Used</div>
                        <div class="stat-value">{{ $storageUsed ?? '0' }} GB</div>
                        <div class="stat-desc">of {{ $storageLimit ?? '10' }} GB</div>
                    </div>
                </div>

                <div class="stats shadow">
                    <div class="stat">
                        <div class="stat-title">Tasks Completed</div>
                        <div class="stat-value">{{ $completedTasks ?? 0 }}</div>
                        <div class="stat-desc">This month</div>
                    </div>
                </div>
            </div>

            <!-- Projects and Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Projects -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="card-title">Recent Projects</h3>
                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-plus mr-2"></i>New Project
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentProjects ?? [] as $project)
                                        <tr>
                                            <td>{{ $project->name }}</td>
                                            <td>
                                                <span class="badge badge-{{ $project->status_color }}">
                                                    {{ $project->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <progress class="progress progress-primary w-20" 
                                                    value="{{ $project->progress }}" max="100">
                                                </progress>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No projects yet</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Team Activity -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Team Activity</h3>
                        <div class="space-y-4">
                            @forelse($teamActivity ?? [] as $activity)
                                <div class="flex items-center gap-4">
                                    <div class="avatar">
                                        <div class="w-12 rounded-full">
                                            <img src="{{ $activity->user_avatar }}" alt="{{ $activity->user_name }}" />
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium">{{ $activity->user_name }}</p>
                                        <p class="text-sm opacity-70">{{ $activity->action }}</p>
                                    </div>
                                    <span class="text-sm opacity-50">{{ $activity->time_ago }}</span>
                                </div>
                            @empty
                                <p class="text-center">No recent activity</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 

<x-app-layout>
    <div class="py-6">
        <div class="mx-auto px-4">
            <h2 class="text-2xl font-semibold mb-6">Central Dashboard</h2>
            
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="stats shadow">
                    <div class="stat">
                        <div class="stat-title">Total Tenants</div>
                        <div class="stat-value">{{ $totalTenants ?? 0 }}</div>
                        <div class="stat-desc">Active tenants in the system</div>
                    </div>
                </div>

                <div class="stats shadow">
                    <div class="stat">
                        <div class="stat-title">Active Projects</div>
                        <div class="stat-value">{{ $activeProjects ?? 0 }}</div>
                        <div class="stat-desc">Across all tenants</div>
                    </div>
                </div>

                <div class="stats shadow">
                    <div class="stat">
                        <div class="stat-title">System Status</div>
                        <div class="stat-value text-success">Healthy</div>
                        <div class="stat-desc text-success">All systems operational</div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity and Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Activity -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title">Recent Activity</h3>
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tenant</th>
                                        <th>Action</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentActivity ?? [] as $activity)
                                        <tr>
                                            <td>{{ $activity->tenant_name }}</td>
                                            <td>{{ $activity->action }}</td>
                                            <td>{{ $activity->created_at }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No recent activity</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title">Quick Actions</h3>
                        <div class="space-y-4">
                        <a href="{{ route('tenants.create') }}" class="btn btn-primary w-full inline-flex items-center justify-center">
    <i class="fas fa-plus mr-2"></i>
    Create New Tenant
</a>
                            <button class="btn btn-secondary w-full">
                                <i class="fas fa-cog mr-2"></i>
                                System Settings
                            </button>
                            <button class="btn btn-accent w-full">
                                <i class="fas fa-download mr-2"></i>
                                Download Reports
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 

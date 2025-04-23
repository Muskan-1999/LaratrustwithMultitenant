<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get active projects count for current tenant
       // $activeProjects = \App\Models\Project::where('status', 'active')->count();

        // Get team members count
        $teamMembers = \App\Models\User::count();

        // Get storage usage (example implementation)
        $storageUsed = $this->calculateStorageUsage();
        $storageLimit = tenant()->plan === 'premium' ? 100 : 10;

        // Get completed tasks count for current month
       

        // Get recent projects
        // $recentProjects = \App\Models\Project::latest()
        //     ->take(5)
        //     ->get()
        //     ->map(function ($project) {
        //         return [
        //             'name' => $project->name,
        //             'status' => $project->status,
        //             'status_color' => $this->getStatusColor($project->status),
        //             'progress' => $project->progress,
        //         ];
        //     });

        // Get team activity
        // $teamActivity = \App\Models\Activity::with('user')
        //     ->latest()
        //     ->take(5)
        //     ->get()
        //     ->map(function ($activity) {
        //         return [
        //             'user_name' => $activity->user->name,
        //             'user_avatar' => $activity->user->avatar_url,
        //             'action' => $activity->description,
        //             'time_ago' => $activity->created_at->diffForHumans(),
        //         ];
        //     });

        return view('tenant.dashboard', compact(
            'teamMembers',
            'storageUsed',
            'storageLimit',
        ));
    }

    private function calculateStorageUsage()
    {
        // Example implementation - you should implement your own storage calculation logic
        return round(rand(1, 10), 1); // Returns a random number between 1 and 10 for demonstration
    }

    // private function getStatusColor($status)
    // {
    //     return match ($status) {
    //         'active' => 'success',
    //         'pending' => 'warning',
    //         'completed' => 'info',
    //         'cancelled' => 'error',
    //         default => 'ghost',
    //     };
    // }
} 
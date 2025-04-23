<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total number of tenants
        $totalTenants = \App\Models\Tenant::count();

        return view('dashboard', compact('totalTenants'));
    }
} 
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\Central\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Tenant\UserTable;
use App\Livewire\Tenant\TenantList;
use App\Livewire\UserInformation;
use App\Livewire\Pages\ProjectsTable;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/help-center', function () {
        return view('help_center.index');
     })->name('help-center');
    //  Route::get('/project', function () {
    //     return view('project.project');
    // })->name('project');
    Route::get('/tenant-list',TenantList::class)->name('tenant-list');
    Route::get('/project', ProjectsTable::class)->name('project');
    Route::get('/users-management/{user}', UserInformation::class)->name('users-management.show');
    Route::get('/users-management',UserTable::class)->name('user-management.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tenants', TenantController::class);
});

require __DIR__.'/auth.php';

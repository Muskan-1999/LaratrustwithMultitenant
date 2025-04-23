<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\Central\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/help-center', function () {
        return view('help_center.index');
     })->name('help-center');
     Route::get('/project', function () {
        return view('project.project');
    })->name('project');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tenants', TenantController::class);
});

require __DIR__.'/auth.php';

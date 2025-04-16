<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    // Guest routes
    Route::middleware('guest')->group(function () {
        Route::get('/', function () {
            return view('tenant.welcome');
        });

        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('tenant.login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);
    });

    // Authenticated routes
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            $users = User::paginate(10);
            return view('tenant.dashboard', compact('users'));
        })->name('tenant.dashboard');

        // Profile routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('tenant.profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('tenant.profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('tenant.profile.destroy');
        
        // Password routes
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('tenant.password.update');
        
        // Email verification routes
        Route::post('/email/verification-notification', [ProfileController::class, 'sendVerificationNotification'])
            ->name('tenant.verification.send');

        // User Management routes
        Route::prefix('users')->name('tenant.users.')->group(function () {
            Route::get('/', [UserManagementController::class, 'index'])->name('index');
            Route::get('/create', [UserManagementController::class, 'create'])->name('create');
            Route::post('/', [UserManagementController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [UserManagementController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserManagementController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserManagementController::class, 'destroy'])->name('destroy');
            Route::get('/{user}', [UserManagementController::class, 'show'])->name('show');
        });

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('tenant.logout');
    });
});

<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\TenantLaratrustController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Models\User;
use App\Http\Controllers\Tenant\DashboardController;
use App\Livewire\Tenant\UserTable;

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
        Route::get('/help-center', function () {
            return view('help_center.index');
        })->name('tenant.help-center');
        Route::get('/project', function () {
            return view('project.project');
        })->name('tenant.project');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('tenant.dashboard');
        Route::get('/users-management',UserTable::class)->name('tenant.user-management.index');

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
        Route::prefix('users')->name('tenant.users.')->middleware(['permission:users-read|users-create|users-update|users-delete'])->group(function () {
            Route::get('/', [UserManagementController::class, 'index'])->name('index');
            Route::get('/create', [UserManagementController::class, 'create'])->name('create')->middleware('permission:users-create');
            Route::post('/', [UserManagementController::class, 'store'])->name('store')->middleware('permission:users-create');
            Route::get('/{user}/edit', [UserManagementController::class, 'edit'])->name('edit')->middleware('permission:users-update');
            Route::put('/{user}', [UserManagementController::class, 'update'])->name('update')->middleware('permission:users-update');
            Route::delete('/{user}', [UserManagementController::class, 'destroy'])->name('destroy')->middleware('permission:users-delete');
            Route::get('/{user}', [UserManagementController::class, 'show'])->name('show')->middleware('permission:users-read');
        });

        // Article Management routes
        Route::prefix('articles')->name('tenant.articles.')->middleware(['permission:articles-read|articles-create|articles-update|articles-delete'])->group(function () {
            Route::get('/', [ArticleController::class, 'index'])->name('index');
            Route::get('/create', [ArticleController::class, 'create'])->name('create')->middleware('permission:articles-create');
            Route::post('/', [ArticleController::class, 'store'])->name('store')->middleware('permission:articles-create');
            Route::get('/{article}', [ArticleController::class, 'show'])->name('show')->middleware('permission:articles-read');
            Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('edit')->middleware('permission:articles-update');
            Route::put('/{article}', [ArticleController::class, 'update'])->name('update')->middleware('permission:articles-update');
            Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('destroy')->middleware('permission:articles-delete');
        });

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('tenant.logout');

        // Laratrust Panel Routes
        Route::group([
            'prefix' => config('laratrust.panel.path', 'laratrust'),
            'namespace' => 'Laratrust\Http\Controllers',
            'middleware' => [
                'web',
                InitializeTenancyByDomain::class,
                PreventAccessFromCentralDomains::class,
                'auth'
            ],
            'as' => 'laratrust.'
        ], function () {
            Route::get('/', function() {
                return redirect()->route('laratrust.roles-assignment.index');
            });
            
            Route::resource('/roles', 'RolesController')->except(['show']);
            Route::resource('/permissions', 'PermissionsController')->except(['show']);
            Route::resource('/roles-assignment', 'RolesAssignmentController')
                ->except(['show', 'create', 'store', 'destroy'])
                ->names([
                    'index' => 'roles-assignment.index',
                    'edit' => 'roles-assignment.edit',
                    'update' => 'roles-assignment.update'
                ]);
        });
    });
});

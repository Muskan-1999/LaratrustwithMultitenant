<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register the tenant-app-layout component
        Blade::component('tenant-app-layout', \App\View\Components\TenantAppLayout::class);

        foreach (config('tenancy.central_domains') as $domain) {
            Route::domain($domain)->group(function () use ($domain) {
                Route::middleware('web')
                    ->group(base_path('routes/web.php'));
            });
        }
    }
}

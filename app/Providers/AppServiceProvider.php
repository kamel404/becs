<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Share global site settings with all views
        View::composer('*', function ($view) {
            if (Schema::hasTable('settings')) {
                $view->with('globalSettings', Setting::allKeyed());
            }
        });
    }
}

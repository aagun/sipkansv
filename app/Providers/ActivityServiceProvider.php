<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ActivityService;
use App\Services\Impl\ActivityServiceImpl;

class ActivityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ActivityService::class, fn () => new ActivityServiceImpl());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

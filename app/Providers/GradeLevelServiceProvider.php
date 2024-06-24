<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GradeLevelService;
use App\Services\Impl\GradeLevelServiceImpl;

class GradeLevelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(GradeLevelService::class, fn () => new GradeLevelServiceImpl());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PositionService;
use App\Services\Impl\PositionServiceImpl;

class PositionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PositionService::class, fn ($app) => new PositionServiceImpl());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

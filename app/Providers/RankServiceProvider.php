<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RankService;
use App\Services\Impl\RankServiceImpl;

class RankServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(RankService::class, fn ($app) => new RankServiceImpl());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\KbliService;
use App\Services\Impl\KbliServiceImpl;

class KbliServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(KbliService::class, fn () => new KbliServiceImpl());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

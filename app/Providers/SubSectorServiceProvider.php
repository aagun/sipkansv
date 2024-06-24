<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SubSectorService;
use App\Services\Impl\SubSectorServiceImpl;

class SubSectorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app
            ->singleton(
                SubSectorService::class,
                fn () => new SubSectorServiceImpl()
            );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\VillageService;
use App\Services\Impl\VillageServiceImpl;

class VillageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app
            ->singleton(
                VillageService::class,
                fn () => new VillageServiceImpl()
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

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\InstitutionService;
use App\Services\Impl\InstitutionServiceImpl;

class InstitutionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(InstitutionService::class, fn () => new InstitutionServiceImpl());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

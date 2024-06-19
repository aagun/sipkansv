<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\EducationService;
use App\Services\Impl\EducationServiceImpl;

class EducationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(EducationService::class, fn ($app) => new EducationServiceImpl());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RecommendationService;
use App\Services\Impl\RecommendationServiceImpl;

class RecommendationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app
            ->singleton(
                RecommendationService::class,
                fn () => new RecommendationServiceImpl()
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

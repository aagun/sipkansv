<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ObservationService;
use App\Services\Impl\ObservationServiceImpl;

class ObservationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app
            ->singleton(
                ObservationService::class,
                fn () => new ObservationServiceImpl()
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

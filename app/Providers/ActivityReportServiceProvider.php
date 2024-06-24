<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ActivityReportService;
use App\Services\Impl\ActivityReportServiceImpl;

class ActivityReportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app
            ->singleton(
                ActivityReportService::class,
                fn () => new ActivityReportServiceImpl()
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

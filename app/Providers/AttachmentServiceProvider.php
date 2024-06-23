<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AttachmentService;
use App\Services\Impl\AttachmentServiceImpl;

class AttachmentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app
            ->singleton(
                AttachmentService::class,
                fn () => new AttachmentServiceImpl()
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

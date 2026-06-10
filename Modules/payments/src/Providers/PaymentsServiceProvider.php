<?php

namespace Modules\Payments\Providers;

use Illuminate\Support\ServiceProvider;

class PaymentsServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'payments');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
}

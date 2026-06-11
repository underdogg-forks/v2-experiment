<?php

namespace Modules\Invoices\Providers;

use Illuminate\Support\ServiceProvider;

class InvoicesServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'invoices');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
}

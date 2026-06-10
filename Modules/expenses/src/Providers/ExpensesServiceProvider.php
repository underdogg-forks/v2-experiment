<?php

namespace Modules\Expenses\Providers;

use Illuminate\Support\ServiceProvider;

class ExpensesServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'expenses');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
}

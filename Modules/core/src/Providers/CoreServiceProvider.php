<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'core');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
}

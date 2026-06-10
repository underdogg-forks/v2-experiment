<?php

namespace Modules\Clients\Providers;

use Illuminate\Support\ServiceProvider;

class ClientsServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'clients');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
}

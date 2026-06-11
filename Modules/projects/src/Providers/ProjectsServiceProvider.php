<?php

namespace Modules\Projects\Providers;

use Illuminate\Support\ServiceProvider;

class ProjectsServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'projects');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
}

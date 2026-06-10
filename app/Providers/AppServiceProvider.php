<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(static function (string $modelName): string {
            // Modules\Core\Models\User -> Modules\Core\Database\Factories\UserFactory
            if (str_starts_with($modelName, 'Modules\\')) {
                $parts  = explode('\\', $modelName);
                $module = $parts[1];
                $model  = $parts[array_key_last($parts)];

                return "Modules\\{$module}\\Database\\Factories\\{$model}Factory";
            }

            return Factory::resolveFactoryName($modelName);
        });
    }
}

<?php

namespace Modules\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Core\Models\Company;
use Modules\Core\Models\Setting;

class SettingFactory extends Factory
{
    protected $model = Setting::class;

    public function definition(): array
    {
        return [
            'company_id'    => Company::factory(),
            'setting_key'   => fake()->unique()->slug(2),
            'setting_value' => fake()->word(),
        ];
    }
}

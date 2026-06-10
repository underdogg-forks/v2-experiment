<?php

namespace Modules\Products\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Products\Models\Unit;

class UnitFactory extends Factory
{
    protected $model = Unit::class;

    public function definition(): array
    {
        return [
            'company_id'     => \Modules\Core\Models\Company::factory(),
            'unit_name'      => fake()->randomElement(['piece', 'hour', 'kg', 'meter']),
            'unit_name_plrl' => fake()->randomElement(['pieces', 'hours', 'kgs', 'meters']),
        ];
    }
}

<?php

namespace Modules\Products\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Products\Models\Family;

class FamilyFactory extends Factory
{
    protected $model = Family::class;

    public function definition(): array
    {
        return [
            'family_name' => fake()->words(2, true),
        ];
    }
}

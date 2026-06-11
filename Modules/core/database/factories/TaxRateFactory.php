<?php

namespace Modules\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Core\Models\Company;
use Modules\Core\Models\TaxRate;

class TaxRateFactory extends Factory
{
    protected $model = TaxRate::class;

    public function definition(): array
    {
        return [
            'company_id'       => Company::factory(),
            'tax_rate_name'    => fake()->word() . ' ' . fake()->numberBetween(0, 25) . '%',
            'tax_rate_percent' => fake()->randomFloat(2, 0, 25),
        ];
    }
}

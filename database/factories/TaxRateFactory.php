<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\TaxRate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\TaxRate>
 */
final class TaxRateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TaxRate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'       => \App\Models\Company::factory(),
            'tax_rate_name'    => fake()->optional()->text,
            'tax_rate_percent' => fake()->randomFloat(2, 0, 999),
        ];
    }
}

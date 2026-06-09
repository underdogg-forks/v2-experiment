<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\QuoteTaxRate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\QuoteTaxRate>
 */
final class QuoteTaxRateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuoteTaxRate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'            => \App\Models\Company::factory(),
            'quote_id'              => fake()->randomNumber(),
            'tax_rate_id'           => fake()->randomNumber(),
            'include_item_tax'      => fake()->randomNumber(1),
            'quote_tax_rate_amount' => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'quote_quote_id'        => \App\Models\Quote::factory(),
            'tax_rate_tax_rate_id'  => \App\Models\TaxRate::factory(),
        ];
    }
}

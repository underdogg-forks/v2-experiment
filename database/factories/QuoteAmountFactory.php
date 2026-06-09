<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\QuoteAmount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\QuoteAmount>
 */
final class QuoteAmountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuoteAmount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'           => \App\Models\Company::factory(),
            'quote_id'             => fake()->randomNumber(),
            'quote_item_subtotal'  => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'quote_item_tax_total' => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'quote_tax_total'      => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'quote_total'          => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'quote_quote_id'       => \App\Models\Quote::factory(),
        ];
    }
}

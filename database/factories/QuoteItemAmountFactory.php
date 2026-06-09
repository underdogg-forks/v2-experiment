<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\QuoteItemAmount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\QuoteItemAmount>
 */
final class QuoteItemAmountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuoteItemAmount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'     => \App\Models\Company::factory(),
            'item_id'        => \App\Models\Product::factory(),
            'item_subtotal'  => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'item_tax_total' => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'item_discount'  => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'item_total'     => fake()->optional()->randomFloat(2, 0, 999999999999999999),
        ];
    }
}

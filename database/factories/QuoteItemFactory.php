<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\QuoteItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\QuoteItem>
 */
final class QuoteItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuoteItem::class;

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
            'tax_rate_id'          => fake()->randomNumber(),
            'item_product_id'      => \App\Models\Product::factory(),
            'item_date_added'      => fake()->date(),
            'item_name'            => fake()->optional()->word,
            'item_description'     => fake()->optional()->text,
            'item_quantity'        => fake()->optional()->randomFloat(8, 0, 999999999999),
            'item_price'           => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'item_discount_amount' => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'item_order'           => fake()->randomNumber(),
            'item_product_unit'    => fake()->optional()->word,
            'item_product_unit_id' => \App\Models\Unit::factory(),
            'quote_quote_id'       => \App\Models\Quote::factory(),
            'tax_rate_tax_rate_id' => \App\Models\TaxRate::factory(),
        ];
    }
}

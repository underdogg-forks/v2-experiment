<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Product>
 */
final class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'           => \App\Models\Company::factory(),
            'family_id'            => fake()->optional()->randomNumber(),
            'product_sku'          => fake()->optional()->word,
            'product_name'         => fake()->optional()->word,
            'product_description'  => fake()->word,
            'product_price'        => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'purchase_price'       => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'provider_name'        => fake()->optional()->word,
            'tax_rate_id'          => fake()->optional()->randomNumber(),
            'unit_id'              => fake()->optional()->randomNumber(),
            'product_tariff'       => fake()->optional()->randomNumber(),
            'family_family_id'     => \App\Models\Family::factory(),
            'tax_rate_tax_rate_id' => \App\Models\TaxRate::factory(),
            'unit_unit_id'         => \App\Models\Unit::factory(),
        ];
    }
}

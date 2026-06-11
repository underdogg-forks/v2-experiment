<?php

namespace Modules\Products\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Products\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'company_id'          => \Modules\Core\Models\Company::factory(),
            'family_id'           => null,
            'product_sku'         => fake()->optional()->regexify('[A-Z]{3}-[0-9]{4}'),
            'product_name'        => fake()->words(3, true),
            'product_description' => fake()->sentence(),
            'product_price'       => fake()->randomFloat(2, 1, 1000),
            'purchase_price'      => null,
            'provider_name'       => null,
            'tax_rate_id'         => null,
            'unit_id'             => null,
        ];
    }
}

<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ItemLookup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ItemLookup>
 */
final class ItemLookupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemLookup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'       => \App\Models\Company::factory(),
            'item_name'        => fake()->word,
            'item_description' => fake()->word,
            'item_price'       => fake()->randomFloat(2, 0, 99999999),
        ];
    }
}

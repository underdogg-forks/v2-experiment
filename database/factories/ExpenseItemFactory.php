<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ExpenseItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ExpenseItem>
 */
final class ExpenseItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExpenseItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'    => \App\Models\Company::factory(),
            'expense_id'    => \App\Models\Expense::factory(),
            'item_id'       => \App\Models\Product::factory(),
            'unit_id'       => fake()->optional()->randomNumber(),
            'added_at'      => fake()->optional()->date(),
            'item_name'     => fake()->optional()->word,
            'is_recurring'  => fake()->randomNumber(1),
            'quantity'      => fake()->randomFloat(4, 0, 9999999999999999),
            'price'         => fake()->randomFloat(4, 0, 9999999999999999),
            'discount'      => fake()->optional()->randomFloat(4, 0, 9999999999999999),
            'subtotal'      => fake()->randomFloat(4, 0, 9999999999999999),
            'tax_1'         => fake()->optional()->randomFloat(4, 0, 9999999999999999),
            'tax_2'         => fake()->optional()->randomFloat(4, 0, 9999999999999999),
            'tax_total'     => fake()->optional()->randomFloat(4, 0, 9999999999999999),
            'total'         => fake()->optional()->randomFloat(4, 0, 9999999999999999),
            'tax_rate_id'   => fake()->optional()->randomNumber(),
            'tax_rate_2_id' => \App\Models\TaxRate::factory(),
            'display_order' => fake()->optional()->word,
            'description'   => fake()->optional()->text,
            'unit_unit_id'  => \App\Models\Unit::factory(),
        ];
    }
}

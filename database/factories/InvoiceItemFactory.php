<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\InvoiceItem>
 */
final class InvoiceItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'           => \App\Models\Company::factory(),
            'invoice_id'           => fake()->randomNumber(),
            'item_tax_rate_id'     => \App\Models\TaxRate::factory(),
            'item_product_id'      => \App\Models\Product::factory(),
            'item_task_id'         => \App\Models\Task::factory(),
            'item_date_added'      => fake()->date(),
            'item_name'            => fake()->optional()->word,
            'item_description'     => fake()->optional()->word,
            'item_quantity'        => fake()->optional()->randomFloat(8, 0, 999999999999),
            'item_price'           => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'item_discount_amount' => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'item_order'           => fake()->randomNumber(),
            'item_is_recurring'    => fake()->optional()->randomNumber(1),
            'item_product_unit'    => fake()->optional()->word,
            'item_product_unit_id' => \App\Models\Unit::factory(),
            'item_date'            => fake()->optional()->date(),
            'invoice_invoice_id'   => \App\Models\Invoice::factory(),
        ];
    }
}

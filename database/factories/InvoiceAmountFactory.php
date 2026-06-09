<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\InvoiceAmount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\InvoiceAmount>
 */
final class InvoiceAmountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceAmount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'             => \App\Models\Company::factory(),
            'invoice_id'             => fake()->randomNumber(),
            'invoice_sign'           => fake()->word,
            'invoice_item_subtotal'  => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'invoice_item_tax_total' => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'invoice_tax_total'      => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'invoice_total'          => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'invoice_paid'           => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'invoice_balance'        => fake()->optional()->randomFloat(2, 0, 999999999999999999),
        ];
    }
}

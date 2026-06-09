<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\InvoiceTaxRate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\InvoiceTaxRate>
 */
final class InvoiceTaxRateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceTaxRate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'              => \App\Models\Company::factory(),
            'invoice_id'              => fake()->randomNumber(),
            'tax_rate_id'             => fake()->randomNumber(),
            'include_item_tax'        => fake()->randomNumber(1),
            'invoice_tax_rate_amount' => fake()->randomFloat(2, 0, 99999999),
            'invoice_invoice_id'      => \App\Models\Invoice::factory(),
            'tax_rate_tax_rate_id'    => \App\Models\TaxRate::factory(),
        ];
    }
}

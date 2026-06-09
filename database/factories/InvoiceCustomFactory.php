<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\InvoiceCustom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\InvoiceCustom>
 */
final class InvoiceCustomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceCustom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'                => \App\Models\Company::factory(),
            'invoice_id'                => fake()->randomNumber(),
            'invoice_custom_fieldid'    => fake()->randomNumber(),
            'invoice_custom_fieldvalue' => fake()->optional()->text,
            'invoice_invoice_id'        => \App\Models\Invoice::factory(),
        ];
    }
}

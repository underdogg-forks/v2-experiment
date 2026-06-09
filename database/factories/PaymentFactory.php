<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Payment>
 */
final class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'         => \App\Models\Company::factory(),
            'invoice_id'         => fake()->randomNumber(),
            'payment_method_id'  => fake()->randomNumber(),
            'payment_date'       => fake()->date(),
            'payment_amount'     => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'payment_note'       => fake()->word,
            'invoice_invoice_id' => \App\Models\Invoice::factory(),
        ];
    }
}

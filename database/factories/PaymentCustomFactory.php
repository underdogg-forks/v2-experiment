<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PaymentCustom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\PaymentCustom>
 */
final class PaymentCustomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentCustom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'                => \App\Models\Company::factory(),
            'payment_id'                => fake()->randomNumber(),
            'payment_custom_fieldid'    => fake()->randomNumber(),
            'payment_custom_fieldvalue' => fake()->optional()->text,
            'payment_payment_id'        => \App\Models\Payment::factory(),
        ];
    }
}

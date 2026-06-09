<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\MerchantPayment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\MerchantPayment>
 */
final class MerchantPaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MerchantPayment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'driver'         => fake()->word,
            'payment_id'     => \App\Models\Payment::factory(),
            'merchant_key'   => fake()->word,
            'merchant_value' => fake()->word,
        ];
    }
}

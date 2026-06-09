<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\MerchantClient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\MerchantClient>
 */
final class MerchantClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MerchantClient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'driver'         => fake()->word,
            'client_id'      => \App\Models\Client::factory(),
            'merchant_key'   => fake()->word,
            'merchant_value' => fake()->word,
        ];
    }
}

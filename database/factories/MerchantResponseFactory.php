<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\MerchantResponse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\MerchantResponse>
 */
final class MerchantResponseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MerchantResponse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'                   => \App\Models\Company::factory(),
            'invoice_id'                   => fake()->randomNumber(),
            'merchant_response_successful' => fake()->optional()->randomNumber(1),
            'merchant_response_date'       => fake()->date(),
            'merchant_response_driver'     => fake()->word,
            'merchant_response'            => fake()->word,
            'merchant_response_reference'  => fake()->word,
            'invoice_invoice_id'           => \App\Models\Invoice::factory(),
        ];
    }
}

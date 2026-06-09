<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Quote>
 */
final class QuoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'                     => \App\Models\Company::factory(),
            'invoice_id'                     => fake()->randomNumber(),
            'user_id'                        => fake()->randomNumber(),
            'client_id'                      => fake()->randomNumber(),
            'invoice_group_id'               => fake()->randomNumber(),
            'quote_status_id'                => fake()->randomNumber(1),
            'quote_date_expires'             => fake()->date(),
            'quote_number'                   => fake()->optional()->word,
            'quote_discount_amount'          => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'quote_discount_percent'         => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'quote_url_key'                  => fake()->word,
            'quote_password'                 => fake()->optional()->word,
            'notes'                          => fake()->optional()->word,
            'quote_date_created'             => fake()->date(),
            'quote_date_modified'            => fake()->dateTime(),
            'client_client_id'               => \App\Models\Client::factory(),
            'invoice_group_invoice_group_id' => \App\Models\InvoiceGroup::factory(),
            'user_user_id'                   => \App\Models\User::factory(),
        ];
    }
}

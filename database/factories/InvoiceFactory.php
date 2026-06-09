<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Invoice>
 */
final class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'                     => \App\Models\Company::factory(),
            'client_id'                      => fake()->randomNumber(),
            'invoice_group_id'               => fake()->randomNumber(),
            'user_id'                        => fake()->randomNumber(),
            'invoice_status_id'              => fake()->randomNumber(1),
            'is_read_only'                   => fake()->optional()->randomNumber(1),
            'invoice_password'               => fake()->optional()->word,
            'invoice_date_created'           => fake()->date(),
            'invoice_time_created'           => fake()->time(),
            'invoice_date_modified'          => fake()->dateTime(),
            'invoice_date_due'               => fake()->date(),
            'invoice_number'                 => fake()->optional()->word,
            'invoice_discount_amount'        => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'invoice_discount_percent'       => fake()->optional()->randomFloat(2, 0, 999999999999999999),
            'invoice_terms'                  => fake()->word,
            'invoice_url_key'                => fake()->word,
            'payment_method'                 => fake()->randomNumber(),
            'creditinvoice_parent_id'        => \App\Models\Invoice::factory(),
            'client_client_id'               => \App\Models\Client::factory(),
            'invoice_group_invoice_group_id' => \App\Models\InvoiceGroup::factory(),
            'user_user_id'                   => \App\Models\User::factory(),
        ];
    }
}

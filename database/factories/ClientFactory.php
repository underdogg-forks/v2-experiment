<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Client>
 */
final class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'                => \App\Models\Company::factory(),
            'client_name'               => fake()->optional()->word,
            'client_company'            => fake()->optional()->word,
            'client_address_1'          => fake()->optional()->word,
            'client_address_2'          => fake()->optional()->word,
            'client_city'               => fake()->optional()->word,
            'client_state'              => fake()->optional()->word,
            'client_zip'                => fake()->optional()->word,
            'client_country'            => fake()->optional()->word,
            'client_phone'              => fake()->optional()->word,
            'client_fax'                => fake()->optional()->word,
            'client_mobile'             => fake()->optional()->word,
            'client_email'              => fake()->optional()->word,
            'client_web'                => fake()->optional()->word,
            'client_vat_id'             => fake()->optional()->word,
            'client_tax_code'           => fake()->optional()->word,
            'client_language'           => fake()->optional()->word,
            'client_active'             => fake()->randomNumber(1),
            'client_surname'            => fake()->optional()->word,
            'client_invoicing_contact'  => fake()->optional()->word,
            'client_title'              => fake()->optional()->word,
            'client_einvoicing_active'  => fake()->randomNumber(1),
            'client_einvoicing_version' => fake()->optional()->word,
            'client_avs'                => fake()->optional()->word,
            'client_insurednumber'      => fake()->optional()->word,
            'client_veka'               => fake()->optional()->word,
            'client_birthdate'          => fake()->optional()->date(),
            'client_gender'             => fake()->optional()->randomNumber(),
            'client_date_created'       => fake()->dateTime(),
            'client_date_modified'      => fake()->dateTime(),
        ];
    }
}

<?php

namespace Modules\Clients\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Clients\Models\Client;
use Modules\Core\Models\Company;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'company_id'               => Company::factory(),
            'client_name'              => fake()->firstName(),
            'client_surname'           => fake()->lastName(),
            'client_company'           => fake()->optional()->company(),
            'client_email'             => fake()->optional()->safeEmail(),
            'client_phone'             => fake()->optional()->phoneNumber(),
            'client_address_1'         => fake()->optional()->streetAddress(),
            'client_city'              => fake()->optional()->city(),
            'client_zip'               => fake()->optional()->postcode(),
            'client_country'           => fake()->optional()->countryCode(),
            'client_active'            => fake()->boolean(75),
            'client_einvoicing_active' => fake()->boolean(25),
            'client_date_created'      => now(),
            'client_date_modified'     => now(),
        ];
    }
}

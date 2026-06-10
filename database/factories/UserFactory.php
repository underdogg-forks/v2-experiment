<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\User>
 */
final class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_type'                => fake()->randomNumber(),
            'user_active'              => fake()->boolean(70),
            'user_language'            => fake()->optional()->word,
            'user_name'                => fake()->optional()->userName,
            'user_company'             => fake()->optional()->word,
            'user_address_1'           => fake()->optional()->word,
            'user_address_2'           => fake()->optional()->word,
            'user_city'                => fake()->optional()->word,
            'user_state'               => fake()->optional()->word,
            'user_zip'                 => fake()->optional()->word,
            'user_country'             => fake()->optional()->word,
            'user_invoicing_contact'   => fake()->optional()->word,
            'user_phone'               => fake()->optional()->word,
            'user_fax'                 => fake()->optional()->word,
            'user_mobile'              => fake()->optional()->word,
            'user_email'               => fake()->optional()->word,
            'user_password'            => fake()->word,
            'user_web'                 => fake()->optional()->word,
            'user_vat_id'              => fake()->optional()->word,
            'user_tax_code'            => fake()->optional()->word,
            'user_psalt'               => fake()->optional()->word,
            'user_all_clients'         => fake()->randomNumber(1),
            'user_passwordreset_token' => fake()->optional()->word,
            'user_subscribernumber'    => fake()->optional()->word,
            'user_bank'                => fake()->optional()->word,
            'user_iban'                => fake()->optional()->word,
            'user_bic'                 => fake()->optional()->word,
            'user_remittance_text'     => fake()->optional()->word,
            'user_gln'                 => fake()->optional()->randomNumber(),
            'user_rcc'                 => fake()->optional()->word,
            'user_date_created'        => fake()->dateTime(),
            'user_date_modified'       => fake()->dateTime(),
        ];
    }
}

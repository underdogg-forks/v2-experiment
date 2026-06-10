<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UserCustom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\UserCustom>
 */
final class UserCustomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserCustom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'             => \App\Models\Company::factory(),
            'user_id'                => \App\Models\User::factory(),
            'user_custom_fieldid'    => fake()->randomNumber(),
            'user_custom_fieldvalue' => fake()->optional()->text,
        ];
    }
}

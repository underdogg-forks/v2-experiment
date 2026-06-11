<?php

namespace Modules\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Modules\Core\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'user_name'          => fake()->name(),
            'user_email'         => fake()->unique()->safeEmail(),
            'user_password'      => Hash::make('password'),
            'user_active'        => fake()->boolean(90),
            'user_all_clients'   => fake()->boolean(90),
            'user_date_created'  => now(),
            'user_date_modified' => now(),
        ];
    }
}

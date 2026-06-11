<?php

namespace Modules\Core\Database\Seeders;

use Modules\Core\Enums\UserRole;
use Modules\Core\Models\User;

class UsersSeeder extends AbstractSeeder
{
    protected string $label = 'Users';

    protected int $defaultCount = 10;

    private int $adminsRemaining = 2;

    protected function beforeSeed(): void
    {
        $this->adminsRemaining = 2;
    }

    protected function buildOne(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['user_active' => true]);

        $role = $this->adminsRemaining > 0
            ? UserRole::CUSTOMER_ADMIN->value
            : UserRole::CUSTOMER->value;

        $user->assignRole($role);
        $user->companies()->attach($this->companyId);

        if ($this->adminsRemaining > 0) {
            $this->adminsRemaining--;
        }
    }
}

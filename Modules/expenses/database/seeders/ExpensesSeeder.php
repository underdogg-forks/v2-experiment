<?php

namespace Modules\Expenses\Database\Seeders;

use Modules\Core\Database\Seeders\AbstractSeeder;
use Modules\Expenses\Models\Expense;

class ExpensesSeeder extends AbstractSeeder
{
    protected string $label = 'Expenses';

    protected int $defaultCount = 15;

    protected function buildOne(): void
    {
        $user = $this->findOrCreateUser($this->companyId);

        Expense::factory()->create([
            'company_id' => $this->companyId,
            'user_id'    => $user->user_id,
        ]);
    }
}

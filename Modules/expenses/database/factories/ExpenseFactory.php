<?php

namespace Modules\Expenses\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Expenses\Models\Expense;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition(): array
    {
        return [
            'company_id'     => \Modules\Core\Models\Company::factory(),
            'expense_number' => fake()->unique()->numerify('EXP-####'),
            'expense_status' => 'draft',
            'expense_type'   => 'internal',
            'expensed_at'    => now(),
            'expense_amount' => fake()->randomFloat(2, 10, 1000),
            'description'    => fake()->optional()->sentence(),
        ];
    }
}

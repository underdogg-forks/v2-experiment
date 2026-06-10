<?php

namespace Modules\Expenses\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Expenses\Models\ExpenseCategory;

class ExpenseCategoryFactory extends Factory
{
    protected $model = ExpenseCategory::class;

    public function definition(): array
    {
        return [
            'company_id'    => \Modules\Core\Models\Company::factory(),
            'category_name' => fake()->words(2, true),
        ];
    }
}

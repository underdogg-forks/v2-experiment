<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Expense>
 */
final class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'         => \App\Models\Company::factory(),
            'invoice_invoice_id' => \App\Models\Invoice::factory(),
            'vendor_id'          => \App\Models\Client::factory(),
            'category_id'        => \App\Models\ExpenseCategory::factory(),
            'user_user_id'       => \App\Models\User::factory(),
            'expense_number'     => fake()->word,
            'expense_status'     => fake()->word,
            'expense_type'       => fake()->word,
            'expensed_at'        => fake()->date(),
            'expense_amount'     => fake()->randomFloat(4, 0, 9999999999999999),
            'description'        => fake()->optional()->text,
        ];
    }
}

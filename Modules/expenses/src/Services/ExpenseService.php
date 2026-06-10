<?php

namespace Modules\Expenses\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Expenses\Models\Expense;

class ExpenseService
{
    public function createExpense(array $data): Expense
    {
        return Expense::query()->create($data);
    }

    public function updateExpense(Expense $expense, array $data): Expense
    {
        $expense->update($data);

        return $expense->fresh();
    }

    public function deleteExpense(Expense $expense): bool
    {
        return (bool) $expense->delete();
    }

    public function listForCompany(int $companyId): Collection
    {
        return Expense::query()
            ->where('company_id', $companyId)
            ->with(['expense_category', 'client'])
            ->latest('expensed_at')
            ->get();
    }
}

<?php

namespace Modules\Expenses\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Models\Company;

/**
 * @property int                  $id
 * @property int                  $company_id
 * @property string               $category_name
 * @property Company              $company
 * @property Collection|Expense[] $expenses
 */
class ExpenseCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'expense_categories';

    protected $casts = [
        'company_id' => 'int',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'category_id');
    }

    protected static function newFactory(): Factory
    {
        return \Modules\Expenses\Database\Factories\ExpenseCategoryFactory::new();
    }
}

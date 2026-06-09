<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpenseCategory.
 *
 * @property int                  $id
 * @property int                  $company_id
 * @property string               $category_name
 * @property Company              $company
 * @property Collection|Expense[] $expenses
 */
class ExpenseCategory extends Model
{
    public $timestamps = false;

    protected $table = 'expense_categories';

    protected $casts = [
        'company_id' => 'int',
    ];

    protected $fillable = [
        'company_id',
        'category_name',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function expenses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Expense::class, 'category_id');
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Expense.
 *
 * @property int                      $id
 * @property int                      $company_id
 * @property int|null                 $invoice_id
 * @property int|null                 $customer_id
 * @property int|null                 $vendor_id
 * @property int|null                 $category_id
 * @property int|null                 $user_id
 * @property string                   $expense_number
 * @property string                   $expense_status
 * @property string                   $expense_type
 * @property Carbon                   $expensed_at
 * @property float                    $expense_amount
 * @property string|null              $description
 * @property Company                  $company
 * @property ExpenseCategory|null     $expense_category
 * @property Client|null              $client
 * @property Invoice|null             $invoice
 * @property User|null                $user
 * @property Collection|ExpenseItem[] $expense_items
 */
class Expense extends Model
{
    public $timestamps = false;

    protected $table = 'expenses';

    protected $casts = [
        'company_id'     => 'int',
        'invoice_id'     => 'int',
        'customer_id'    => 'int',
        'vendor_id'      => 'int',
        'category_id'    => 'int',
        'user_id'        => 'int',
        'expensed_at'    => 'datetime',
        'expense_amount' => 'float',
    ];

    protected $fillable = [
        'company_id',
        'invoice_id',
        'customer_id',
        'vendor_id',
        'category_id',
        'user_id',
        'expense_number',
        'expense_status',
        'expense_type',
        'expensed_at',
        'expense_amount',
        'description',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function expense_category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class, 'vendor_id');
    }

    public function invoice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace Modules\Expenses\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Clients\Models\Client;
use Modules\Core\Models\Company;
use Modules\Core\Models\User;
use Modules\Invoices\Models\Invoice;

/**
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
    use HasFactory;

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

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function expense_category(): BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'vendor_id');
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function expense_items(): HasMany
    {
        return $this->hasMany(ExpenseItem::class);
    }

    protected static function newFactory(): Factory
    {
        return \Modules\Expenses\Database\Factories\ExpenseFactory::new();
    }
}

<?php

namespace Modules\Expenses\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\Company;
use Modules\Core\Models\TaxRate;
use Modules\Products\Models\Product;
use Modules\Products\Models\Unit;

/**
 * @property int          $id
 * @property int          $company_id
 * @property int          $expense_id
 * @property int|null     $item_id
 * @property int|null     $unit_id
 * @property Carbon|null  $added_at
 * @property string|null  $item_name
 * @property bool         $is_recurring
 * @property float        $quantity
 * @property float        $price
 * @property float|null   $discount
 * @property float        $subtotal
 * @property float|null   $tax_1
 * @property float|null   $tax_2
 * @property float|null   $tax_total
 * @property float|null   $total
 * @property int|null     $tax_rate_id
 * @property int|null     $tax_rate_2_id
 * @property int|null     $display_order
 * @property string|null  $description
 * @property Company      $company
 * @property Expense      $expense
 * @property Product|null $product
 * @property TaxRate|null $tax_rate
 * @property Unit|null    $unit
 */
class ExpenseItem extends Model
{
    public $timestamps = false;

    protected $table = 'expense_items';

    protected $casts = [
        'company_id'    => 'int',
        'expense_id'    => 'int',
        'item_id'       => 'int',
        'unit_id'       => 'int',
        'added_at'      => 'datetime',
        'is_recurring'  => 'bool',
        'quantity'      => 'float',
        'price'         => 'float',
        'discount'      => 'float',
        'subtotal'      => 'float',
        'tax_1'         => 'float',
        'tax_2'         => 'float',
        'tax_total'     => 'float',
        'total'         => 'float',
        'tax_rate_id'   => 'int',
        'tax_rate_2_id' => 'int',
        'display_order' => 'int',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'item_id');
    }

    public function tax_rate(): BelongsTo
    {
        return $this->belongsTo(TaxRate::class, 'tax_rate_2_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}

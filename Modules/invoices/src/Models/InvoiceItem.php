<?php

namespace Modules\Invoices\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\Company;
use Modules\Core\Models\TaxRate;
use Modules\Products\Models\Product;
use Modules\Products\Models\Unit;
use Modules\Projects\Models\Task;

/**
 * @property int          $item_id
 * @property int          $company_id
 * @property int          $invoice_id
 * @property int          $item_tax_rate_id
 * @property int|null     $item_product_id
 * @property int|null     $item_task_id
 * @property Carbon       $item_date_added
 * @property string|null  $item_name
 * @property string|null  $item_description
 * @property float|null   $item_quantity
 * @property float|null   $item_price
 * @property float|null   $item_discount_amount
 * @property int          $item_order
 * @property bool|null    $item_is_recurring
 * @property string|null  $item_product_unit
 * @property int|null     $item_product_unit_id
 * @property Carbon|null  $item_date
 * @property Company      $company
 * @property Invoice      $invoice
 * @property Product|null $product
 * @property Unit|null    $unit
 * @property Task|null    $task
 * @property TaxRate      $tax_rate
 */
class InvoiceItem extends Model
{
    public $timestamps = false;

    protected $table = 'invoice_items';

    protected $primaryKey = 'item_id';

    protected $casts = [
        'company_id'           => 'int',
        'invoice_id'           => 'int',
        'item_tax_rate_id'     => 'int',
        'item_product_id'      => 'int',
        'item_task_id'         => 'int',
        'item_date_added'      => 'datetime',
        'item_quantity'        => 'float',
        'item_price'           => 'float',
        'item_discount_amount' => 'float',
        'item_order'           => 'int',
        'item_is_recurring'    => 'bool',
        'item_product_unit_id' => 'int',
        'item_date'            => 'datetime',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'item_product_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'item_product_unit_id');
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'item_task_id');
    }

    public function tax_rate(): BelongsTo
    {
        return $this->belongsTo(TaxRate::class, 'item_tax_rate_id');
    }
}

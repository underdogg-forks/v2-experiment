<?php

namespace Modules\Invoices\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\Company;

/**
 * @property int         $invoice_item_amount_id
 * @property int         $company_id
 * @property int         $item_id
 * @property int|null    $item_tax_rate_id
 * @property float|null  $item_tax_type_raw
 * @property float|null  $item_tax_total
 * @property float|null  $item_subtotal
 * @property float|null  $item_total
 * @property Company     $company
 * @property InvoiceItem $invoice_item
 */
class InvoiceItemAmount extends Model
{
    public $timestamps = false;

    protected $table = 'invoice_item_amounts';

    protected $primaryKey = 'invoice_item_amount_id';

    protected $casts = [
        'company_id'        => 'int',
        'item_id'           => 'int',
        'item_tax_rate_id'  => 'int',
        'item_tax_type_raw' => 'float',
        'item_tax_total'    => 'float',
        'item_subtotal'     => 'float',
        'item_total'        => 'float',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function invoice_item(): BelongsTo
    {
        return $this->belongsTo(InvoiceItem::class, 'item_id');
    }
}

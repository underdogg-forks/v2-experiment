<?php

namespace Modules\Invoices\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\Company;

/**
 * @property int        $invoice_amount_id
 * @property int        $company_id
 * @property int        $invoice_id
 * @property string     $invoice_sign
 * @property float|null $invoice_item_subtotal
 * @property float|null $invoice_item_tax_total
 * @property float|null $invoice_tax_total
 * @property float|null $invoice_total
 * @property float|null $invoice_paid
 * @property float|null $invoice_balance
 * @property Company    $company
 * @property Invoice    $invoice
 */
class InvoiceAmount extends Model
{
    public $timestamps = false;

    protected $table = 'invoice_amounts';

    protected $primaryKey = 'invoice_amount_id';

    protected $casts = [
        'company_id'             => 'int',
        'invoice_id'             => 'int',
        'invoice_item_subtotal'  => 'float',
        'invoice_item_tax_total' => 'float',
        'invoice_tax_total'      => 'float',
        'invoice_total'          => 'float',
        'invoice_paid'           => 'float',
        'invoice_balance'        => 'float',
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
}

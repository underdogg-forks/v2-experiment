<?php

namespace Modules\Invoices\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\Company;
use Modules\Core\Models\TaxRate;

/**
 * @property int     $invoice_tax_rate_id
 * @property int     $company_id
 * @property int     $invoice_id
 * @property int     $tax_rate_id
 * @property bool    $include_item_tax
 * @property float   $invoice_tax_rate_amount
 * @property Company $company
 * @property Invoice $invoice
 * @property TaxRate $tax_rate
 */
class InvoiceTaxRate extends Model
{
    public $timestamps = false;

    protected $table = 'invoice_tax_rates';

    protected $primaryKey = 'invoice_tax_rate_id';

    protected $casts = [
        'company_id'              => 'int',
        'invoice_id'              => 'int',
        'tax_rate_id'             => 'int',
        'include_item_tax'        => 'bool',
        'invoice_tax_rate_amount' => 'float',
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

    public function tax_rate(): BelongsTo
    {
        return $this->belongsTo(TaxRate::class);
    }
}

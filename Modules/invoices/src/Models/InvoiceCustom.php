<?php

namespace Modules\Invoices\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\Company;

/**
 * @property int         $invoice_custom_id
 * @property int         $company_id
 * @property int         $invoice_id
 * @property int         $invoice_custom_fieldid
 * @property string|null $invoice_custom_fieldvalue
 * @property Company     $company
 * @property Invoice     $invoice
 */
class InvoiceCustom extends Model
{
    public $timestamps = false;

    protected $table = 'invoice_custom';

    protected $primaryKey = 'invoice_custom_id';

    protected $casts = [
        'company_id'             => 'int',
        'invoice_id'             => 'int',
        'invoice_custom_fieldid' => 'int',
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

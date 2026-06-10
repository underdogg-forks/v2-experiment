<?php

namespace Modules\Invoices\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\Company;

/**
 * @property int         $invoice_recurring_id
 * @property int         $company_id
 * @property int         $invoice_id
 * @property string|null $invoice_recurring
 * @property Carbon|null $invoice_recurring_next
 * @property Carbon|null $invoice_recurring_last
 * @property Company     $company
 * @property Invoice     $invoice
 */
class InvoicesRecurring extends Model
{
    public $timestamps = false;

    protected $table = 'recurring_invoices';

    protected $primaryKey = 'invoice_recurring_id';

    protected $casts = [
        'company_id'             => 'int',
        'invoice_id'             => 'int',
        'invoice_recurring_next' => 'datetime',
        'invoice_recurring_last' => 'datetime',
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

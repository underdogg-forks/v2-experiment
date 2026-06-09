<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InvoicesRecurring.
 *
 * @property int         $invoice_recurring_id
 * @property int         $company_id
 * @property int         $invoice_id
 * @property Carbon      $recur_start_date
 * @property Carbon|null $recur_end_date
 * @property string      $recur_frequency
 * @property Carbon|null $recur_next_date
 * @property Company     $company
 * @property Invoice     $invoice
 */
class InvoicesRecurring extends Model
{
    public $timestamps = false;

    protected $table = 'invoices_recurring';

    protected $primaryKey = 'invoice_recurring_id';

    protected $casts = [
        'company_id'       => 'int',
        'invoice_id'       => 'int',
        'recur_start_date' => 'datetime',
        'recur_end_date'   => 'datetime',
        'recur_next_date'  => 'datetime',
    ];

    protected $fillable = [
        'company_id',
        'invoice_id',
        'recur_start_date',
        'recur_end_date',
        'recur_frequency',
        'recur_next_date',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function invoice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}

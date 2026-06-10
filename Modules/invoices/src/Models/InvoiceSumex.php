<?php

namespace Modules\Invoices\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\Company;

/**
 * @property int         $sumex_id
 * @property int         $company_id
 * @property int         $sumex_invoice
 * @property int         $sumex_reason
 * @property string      $sumex_diagnosis
 * @property string      $sumex_observations
 * @property Carbon      $sumex_treatmentstart
 * @property Carbon      $sumex_treatmentend
 * @property Carbon      $sumex_casedate
 * @property string|null $sumex_casenumber
 * @property Company     $company
 * @property Invoice     $invoice
 */
class InvoiceSumex extends Model
{
    public $timestamps = false;

    protected $table = 'invoice_sumex';

    protected $primaryKey = 'sumex_id';

    protected $casts = [
        'company_id'           => 'int',
        'sumex_invoice'        => 'int',
        'sumex_reason'         => 'int',
        'sumex_treatmentstart' => 'datetime',
        'sumex_treatmentend'   => 'datetime',
        'sumex_casedate'       => 'datetime',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'sumex_invoice');
    }
}

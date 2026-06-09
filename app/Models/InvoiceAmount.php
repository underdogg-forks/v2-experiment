<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InvoiceAmount.
 *
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

    protected $fillable = [
        'company_id',
        'invoice_id',
        'invoice_sign',
        'invoice_item_subtotal',
        'invoice_item_tax_total',
        'invoice_tax_total',
        'invoice_total',
        'invoice_paid',
        'invoice_balance',
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

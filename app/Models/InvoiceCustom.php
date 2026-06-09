<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InvoiceCustom.
 *
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

    protected $fillable = [
        'company_id',
        'invoice_id',
        'invoice_custom_fieldid',
        'invoice_custom_fieldvalue',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}

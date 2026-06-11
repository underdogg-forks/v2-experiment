<?php

namespace Modules\Payments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\Company;

/**
 * @property int         $payment_custom_id
 * @property int         $company_id
 * @property int         $payment_id
 * @property int         $payment_custom_fieldid
 * @property string|null $payment_custom_fieldvalue
 * @property Company     $company
 * @property Payment     $payment
 */
class PaymentCustom extends Model
{
    public $timestamps = false;

    protected $table = 'payment_custom';

    protected $primaryKey = 'payment_custom_id';

    protected $casts = [
        'company_id'             => 'int',
        'payment_id'             => 'int',
        'payment_custom_fieldid' => 'int',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}

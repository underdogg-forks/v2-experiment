<?php

namespace Modules\Payments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\Company;

/**
 * @property int    $id
 * @property string $driver
 * @property int    $payment_id
 * @property string $merchant_key
 * @property string $merchant_value
 */
class MerchantPayment extends Model
{
    public $timestamps = false;

    protected $table = 'merchant_payments';

    protected $casts = [
        'payment_id' => 'int',
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MerchantPayment.
 *
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

    protected $fillable = [
        'driver',
        'payment_id',
        'merchant_key',
        'merchant_value',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function payment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentCustom.
 *
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

    protected $fillable = [
        'company_id',
        'payment_id',
        'payment_custom_fieldid',
        'payment_custom_fieldvalue',
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

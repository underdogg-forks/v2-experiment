<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment.
 *
 * @property int                        $payment_id
 * @property int                        $company_id
 * @property int                        $invoice_id
 * @property int                        $payment_method_id
 * @property Carbon                     $payment_date
 * @property float|null                 $payment_amount
 * @property string                     $payment_note
 * @property Company                    $company
 * @property Invoice                    $invoice
 * @property Collection|PaymentCustom[] $payment_customs
 */
class Payment extends Model
{
    public $timestamps = false;

    protected $table = 'payments';

    protected $primaryKey = 'payment_id';

    protected $casts = [
        'company_id'        => 'int',
        'invoice_id'        => 'int',
        'payment_method_id' => 'int',
        'payment_date'      => 'datetime',
        'payment_amount'    => 'float',
    ];

    protected $fillable = [
        'company_id',
        'invoice_id',
        'payment_method_id',
        'payment_date',
        'payment_amount',
        'payment_note',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function invoice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function payment_customs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PaymentCustom::class);
    }
}

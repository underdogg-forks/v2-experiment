<?php

namespace Modules\Payments\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Models\Company;
use Modules\Core\Traits\TenantAware;
use Modules\Invoices\Models\Invoice;

/**
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
    use HasFactory;
    use TenantAware;

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

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function payment_customs(): HasMany
    {
        return $this->hasMany(PaymentCustom::class);
    }

    public function merchant_payments(): HasMany
    {
        return $this->hasMany(MerchantPayment::class);
    }

    protected static function newFactory(): Factory
    {
        return \Modules\Payments\Database\Factories\PaymentFactory::new();
    }
}

<?php

namespace Modules\Invoices\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Clients\Models\Client;
use Modules\Core\Models\Company;
use Modules\Core\Traits\TenantAware;
use Modules\Core\Models\InvoiceGroup;
use Modules\Core\Models\TaxRate;
use Modules\Core\Models\User;
use Modules\Expenses\Models\Expense;
use Modules\Payments\Models\MerchantResponse;
use Modules\Payments\Models\Payment;

/**
 * @property int                            $invoice_id
 * @property int                            $company_id
 * @property int                            $client_id
 * @property int                            $invoice_group_id
 * @property int                            $user_id
 * @property int                            $invoice_status_id
 * @property bool|null                      $is_read_only
 * @property string|null                    $invoice_password
 * @property Carbon                         $invoice_date_created
 * @property Carbon                         $invoice_time_created
 * @property Carbon                         $invoice_date_modified
 * @property Carbon                         $invoice_date_due
 * @property string|null                    $invoice_number
 * @property float|null                     $invoice_discount_amount
 * @property float|null                     $invoice_discount_percent
 * @property string                         $invoice_terms
 * @property string                         $invoice_url_key
 * @property int                            $payment_method
 * @property int|null                       $creditinvoice_parent_id
 * @property Client                         $client
 * @property Company                        $company
 * @property Invoice|null                   $parent_invoice
 * @property InvoiceGroup                   $invoice_group
 * @property User                           $user
 * @property Collection|Expense[]           $expenses
 * @property Collection|InvoiceCustom[]     $invoice_customs
 * @property Collection|InvoiceItem[]       $invoice_items
 * @property Collection|InvoiceSumex[]      $invoice_sumexes
 * @property Collection|TaxRate[]           $tax_rates
 * @property Collection|Invoice[]           $credit_invoices
 * @property Collection|InvoicesRecurring[] $invoices_recurrings
 * @property Collection|MerchantResponse[]  $merchant_responses
 * @property Collection|Payment[]           $payments
 */
class Invoice extends Model
{
    use HasFactory;
    use TenantAware;

    public $timestamps = false;

    protected $table = 'invoices';

    protected $primaryKey = 'invoice_id';

    protected $casts = [
        'company_id'               => 'int',
        'client_id'                => 'int',
        'invoice_group_id'         => 'int',
        'user_id'                  => 'int',
        'invoice_status_id'        => 'int',
        'is_read_only'             => 'bool',
        'invoice_date_created'     => 'datetime',
        'invoice_time_created'     => 'datetime',
        'invoice_date_modified'    => 'datetime',
        'invoice_date_due'         => 'datetime',
        'invoice_discount_amount'  => 'float',
        'invoice_discount_percent' => 'float',
        'payment_method'           => 'int',
        'creditinvoice_parent_id'  => 'int',
    ];

    protected $hidden = [
        'invoice_password',
    ];

    protected $guarded = [];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function parent_invoice(): BelongsTo
    {
        return $this->belongsTo(self::class, 'creditinvoice_parent_id');
    }

    public function invoice_group(): BelongsTo
    {
        return $this->belongsTo(InvoiceGroup::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function invoice_amounts(): HasMany
    {
        return $this->hasMany(InvoiceAmount::class);
    }

    public function invoice_customs(): HasMany
    {
        return $this->hasMany(InvoiceCustom::class);
    }

    public function invoice_items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function invoice_sumexes(): HasMany
    {
        return $this->hasMany(InvoiceSumex::class, 'sumex_invoice');
    }

    public function tax_rates(): BelongsToMany
    {
        return $this->belongsToMany(TaxRate::class, 'invoice_tax_rates')
            ->withPivot('invoice_tax_rate_id', 'company_id', 'include_item_tax', 'invoice_tax_rate_amount');
    }

    public function credit_invoices(): HasMany
    {
        return $this->hasMany(self::class, 'creditinvoice_parent_id');
    }

    public function invoices_recurrings(): HasMany
    {
        return $this->hasMany(InvoicesRecurring::class);
    }

    public function merchant_responses(): HasMany
    {
        return $this->hasMany(MerchantResponse::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Invoice.
 *
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
 * @property Invoice|null                   $invoice
 * @property InvoiceGroup                   $invoice_group
 * @property User                           $user
 * @property Collection|Expense[]           $expenses
 * @property Collection|InvoiceCustom[]     $invoice_customs
 * @property Collection|InvoiceItem[]       $invoice_items
 * @property Collection|InvoiceSumex[]      $invoice_sumexes
 * @property Collection|TaxRate[]           $tax_rates
 * @property Collection|Invoice[]           $invoices
 * @property Collection|InvoicesRecurring[] $invoices_recurrings
 * @property Collection|MerchantResponse[]  $merchant_responses
 * @property Collection|Payment[]           $payments
 */
class Invoice extends Model
{
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

    protected $fillable = [
        'company_id',
        'client_id',
        'invoice_group_id',
        'user_id',
        'invoice_status_id',
        'is_read_only',
        'invoice_password',
        'invoice_date_created',
        'invoice_time_created',
        'invoice_date_modified',
        'invoice_date_due',
        'invoice_number',
        'invoice_discount_amount',
        'invoice_discount_percent',
        'invoice_terms',
        'invoice_url_key',
        'payment_method',
        'creditinvoice_parent_id',
    ];

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function invoice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(self::class, 'creditinvoice_parent_id');
    }

    public function invoice_group(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(InvoiceGroup::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function expenses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function invoice_items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function invoice_sumexes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InvoiceSumex::class, 'sumex_invoice');
    }

    public function tax_rates(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(TaxRate::class, 'invoice_tax_rates')
            ->withPivot('invoice_tax_rate_id', 'company_id', 'include_item_tax', 'invoice_tax_rate_amount');
    }

    public function invoices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(self::class, 'creditinvoice_parent_id');
    }

    public function payments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Payment::class);
    }
}

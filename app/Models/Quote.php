<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Quote.
 *
 * @property int                      $quote_id
 * @property int                      $company_id
 * @property int                      $invoice_id
 * @property int                      $user_id
 * @property int                      $client_id
 * @property int                      $invoice_group_id
 * @property int                      $quote_status_id
 * @property Carbon                   $quote_date_expires
 * @property string|null              $quote_number
 * @property float|null               $quote_discount_amount
 * @property float|null               $quote_discount_percent
 * @property string                   $quote_url_key
 * @property string|null              $quote_password
 * @property string|null              $notes
 * @property Carbon                   $quote_date_created
 * @property Carbon                   $quote_date_modified
 * @property Client                   $client
 * @property Company                  $company
 * @property InvoiceGroup             $invoice_group
 * @property User                     $user
 * @property Collection|QuoteAmount[] $quote_amounts
 * @property Collection|QuoteCustom[] $quote_customs
 * @property Collection|QuoteItem[]   $quote_items
 * @property Collection|TaxRate[]     $tax_rates
 */
class Quote extends Model
{
    public $timestamps = false;

    protected $table = 'quotes';

    protected $primaryKey = 'quote_id';

    protected $casts = [
        'company_id'             => 'int',
        'invoice_id'             => 'int',
        'user_id'                => 'int',
        'client_id'              => 'int',
        'invoice_group_id'       => 'int',
        'quote_status_id'        => 'int',
        'quote_date_expires'     => 'datetime',
        'quote_discount_amount'  => 'float',
        'quote_discount_percent' => 'float',
        'quote_date_created'     => 'datetime',
        'quote_date_modified'    => 'datetime',
    ];

    protected $hidden = [
        'quote_password',
    ];

    protected $fillable = [
        'company_id',
        'invoice_id',
        'user_id',
        'client_id',
        'invoice_group_id',
        'quote_status_id',
        'quote_date_expires',
        'quote_number',
        'quote_discount_amount',
        'quote_discount_percent',
        'quote_url_key',
        'quote_password',
        'notes',
        'quote_date_created',
        'quote_date_modified',
    ];

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function invoice_group(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(InvoiceGroup::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quote_amounts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuoteAmount::class);
    }

    public function quote_customs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuoteCustom::class);
    }

    public function quote_items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function tax_rates(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(TaxRate::class, 'quote_tax_rates')
            ->withPivot('quote_tax_rate_id', 'company_id', 'include_item_tax', 'quote_tax_rate_amount');
    }
}

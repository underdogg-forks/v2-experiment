<?php

namespace Modules\Quotes\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Clients\Models\Client;
use Modules\Core\Models\Company;
use Modules\Core\Models\InvoiceGroup;
use Modules\Core\Models\TaxRate;
use Modules\Core\Models\User;
use Modules\Quotes\Database\Factories\QuoteFactory;

/**
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
    use HasFactory;

    public $timestamps = false;

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

    protected $guarded = [];

    #region Static Methods
    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    #endregion
    #region Relationships
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function invoice_group(): BelongsTo
    {
        return $this->belongsTo(InvoiceGroup::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quote_amounts(): HasMany
    {
        return $this->hasMany(QuoteAmount::class);
    }

    public function quote_customs(): HasMany
    {
        return $this->hasMany(QuoteCustom::class);
    }

    public function quote_items(): HasMany
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function tax_rates(): BelongsToMany
    {
        return $this->belongsToMany(TaxRate::class, 'quote_tax_rates')
            ->withPivot('quote_tax_rate_id', 'company_id', 'include_item_tax', 'quote_tax_rate_amount');
    }
    #endregion
    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    #endregion
    #region Mutators
    /*
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------
    */

    #endregion
    #region Scopes
    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    #endregion
    #region Factory
    /*
    |--------------------------------------------------------------------------
    | Factory
    |--------------------------------------------------------------------------
    */
    protected static function newFactory(): Factory
    {
        return QuoteFactory::new();
    }
    #endregion
}

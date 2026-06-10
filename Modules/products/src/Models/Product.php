<?php

namespace Modules\Products\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Models\Company;
use Modules\Core\Models\TaxRate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Expenses\Models\ExpenseItem;
use Modules\Invoices\Models\InvoiceItem;
use Modules\Invoices\Models\InvoiceItemAmount;
use Modules\Quotes\Models\QuoteItem;
use Modules\Quotes\Models\QuoteItemAmount;

/**
 * @property int                            $product_id
 * @property int                            $company_id
 * @property int|null                       $family_id
 * @property string|null                    $product_sku
 * @property string|null                    $product_name
 * @property string                         $product_description
 * @property float|null                     $product_price
 * @property float|null                     $purchase_price
 * @property string|null                    $provider_name
 * @property int|null                       $tax_rate_id
 * @property int|null                       $unit_id
 * @property int|null                       $product_tariff
 * @property Company                        $company
 * @property Family|null                    $family
 * @property TaxRate|null                   $tax_rate
 * @property Unit|null                      $unit
 * @property Collection|ExpenseItem[]       $expense_items
 * @property Collection|InvoiceItemAmount[] $invoice_item_amounts
 * @property Collection|InvoiceItem[]       $invoice_items
 * @property Collection|QuoteItemAmount[]   $quote_item_amounts
 * @property Collection|QuoteItem[]         $quote_items
 */
class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'products';

    protected $primaryKey = 'product_id';

    protected $casts = [
        'company_id'     => 'int',
        'family_id'      => 'int',
        'product_price'  => 'float',
        'purchase_price' => 'float',
        'tax_rate_id'    => 'int',
        'unit_id'        => 'int',
        'product_tariff' => 'int',
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
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function tax_rate(): BelongsTo
    {
        return $this->belongsTo(TaxRate::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function expense_items(): HasMany
    {
        return $this->hasMany(ExpenseItem::class, 'item_id');
    }

    public function invoice_item_amounts(): HasMany
    {
        return $this->hasMany(InvoiceItemAmount::class, 'item_id');
    }

    public function invoice_items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class, 'item_product_id');
    }

    public function quote_item_amounts(): HasMany
    {
        return $this->hasMany(QuoteItemAmount::class, 'item_id');
    }

    public function quote_items(): HasMany
    {
        return $this->hasMany(QuoteItem::class, 'item_product_id');
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
        return \Modules\Products\Database\Factories\ProductFactory::new();
    }
    #endregion
}

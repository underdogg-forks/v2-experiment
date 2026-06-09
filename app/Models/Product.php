<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product.
 *
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

    protected $fillable = [
        'company_id',
        'family_id',
        'product_sku',
        'product_name',
        'product_description',
        'product_price',
        'purchase_price',
        'provider_name',
        'tax_rate_id',
        'unit_id',
        'product_tariff',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function family(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function tax_rate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TaxRate::class);
    }

    public function unit(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function expense_items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ExpenseItem::class, 'item_id');
    }

    public function invoice_item_amounts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InvoiceItemAmount::class, 'item_id');
    }

    public function invoice_items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InvoiceItem::class, 'item_product_id');
    }

    public function quote_item_amounts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuoteItemAmount::class, 'item_id');
    }

    public function quote_items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuoteItem::class, 'item_product_id');
    }
}

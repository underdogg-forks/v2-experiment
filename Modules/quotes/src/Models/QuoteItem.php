<?php

namespace Modules\Quotes\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\Company;
use Modules\Core\Models\TaxRate;
use Modules\Products\Models\Product;
use Modules\Products\Models\Unit;

/**
 * @property int          $item_id
 * @property int          $company_id
 * @property int          $quote_id
 * @property int          $tax_rate_id
 * @property int|null     $item_product_id
 * @property Carbon       $item_date_added
 * @property string|null  $item_name
 * @property string|null  $item_description
 * @property float|null   $item_quantity
 * @property float|null   $item_price
 * @property float|null   $item_discount_amount
 * @property int          $item_order
 * @property string|null  $item_product_unit
 * @property int|null     $item_product_unit_id
 * @property Company      $company
 * @property Product|null $product
 * @property Unit|null    $unit
 * @property Quote        $quote
 * @property TaxRate      $tax_rate
 */
class QuoteItem extends Model
{
    public $timestamps = false;

    protected $table = 'quote_items';

    protected $primaryKey = 'item_id';

    protected $casts = [
        'company_id'           => 'int',
        'quote_id'             => 'int',
        'tax_rate_id'          => 'int',
        'item_product_id'      => 'int',
        'item_date_added'      => 'datetime',
        'item_quantity'        => 'float',
        'item_price'           => 'float',
        'item_discount_amount' => 'float',
        'item_order'           => 'int',
        'item_product_unit_id' => 'int',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'item_product_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'item_product_unit_id');
    }

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function tax_rate(): BelongsTo
    {
        return $this->belongsTo(TaxRate::class);
    }
}

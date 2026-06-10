<?php

namespace Modules\Quotes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\Company;

/**
 * @property int        $quote_item_amount_id
 * @property int        $company_id
 * @property int        $item_id
 * @property int|null   $item_tax_rate_id
 * @property float|null $item_tax_type_raw
 * @property float|null $item_tax_total
 * @property float|null $item_subtotal
 * @property float|null $item_total
 * @property Company    $company
 * @property QuoteItem  $quote_item
 */
class QuoteItemAmount extends Model
{
    public $timestamps = false;

    protected $table = 'quote_item_amounts';

    protected $primaryKey = 'quote_item_amount_id';

    protected $casts = [
        'company_id'        => 'int',
        'item_id'           => 'int',
        'item_tax_rate_id'  => 'int',
        'item_tax_type_raw' => 'float',
        'item_tax_total'    => 'float',
        'item_subtotal'     => 'float',
        'item_total'        => 'float',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function quote_item(): BelongsTo
    {
        return $this->belongsTo(QuoteItem::class, 'item_id');
    }
}

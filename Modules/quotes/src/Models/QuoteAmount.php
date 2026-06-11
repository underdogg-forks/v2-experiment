<?php

namespace Modules\Quotes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\Company;

/**
 * @property int        $quote_amount_id
 * @property int        $company_id
 * @property int        $quote_id
 * @property string     $quote_sign
 * @property float|null $quote_item_subtotal
 * @property float|null $quote_item_tax_total
 * @property float|null $quote_tax_total
 * @property float|null $quote_total
 * @property Company    $company
 * @property Quote      $quote
 */
class QuoteAmount extends Model
{
    public $timestamps = false;

    protected $table = 'quote_amounts';

    protected $primaryKey = 'quote_amount_id';

    protected $casts = [
        'company_id'           => 'int',
        'quote_id'             => 'int',
        'quote_item_subtotal'  => 'float',
        'quote_item_tax_total' => 'float',
        'quote_tax_total'      => 'float',
        'quote_total'          => 'float',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }
}

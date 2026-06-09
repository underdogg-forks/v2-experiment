<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class QuoteAmount.
 *
 * @property int        $quote_amount_id
 * @property int        $company_id
 * @property int        $quote_id
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

    protected $fillable = [
        'company_id',
        'quote_id',
        'quote_item_subtotal',
        'quote_item_tax_total',
        'quote_tax_total',
        'quote_total',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function quote(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }
}

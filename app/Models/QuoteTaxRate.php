<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class QuoteTaxRate.
 *
 * @property int        $quote_tax_rate_id
 * @property int        $company_id
 * @property int        $quote_id
 * @property int        $tax_rate_id
 * @property bool       $include_item_tax
 * @property float|null $quote_tax_rate_amount
 * @property Company    $company
 * @property Quote      $quote
 * @property TaxRate    $tax_rate
 */
class QuoteTaxRate extends Model
{
    public $timestamps = false;

    protected $table = 'quote_tax_rates';

    protected $primaryKey = 'quote_tax_rate_id';

    protected $casts = [
        'company_id'            => 'int',
        'quote_id'              => 'int',
        'tax_rate_id'           => 'int',
        'include_item_tax'      => 'bool',
        'quote_tax_rate_amount' => 'float',
    ];

    protected $fillable = [
        'company_id',
        'quote_id',
        'tax_rate_id',
        'include_item_tax',
        'quote_tax_rate_amount',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function quote(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function tax_rate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TaxRate::class);
    }
}

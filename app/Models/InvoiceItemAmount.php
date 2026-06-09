<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InvoiceItemAmount.
 *
 * @property int        $item_amount_id
 * @property int        $company_id
 * @property int        $item_id
 * @property float|null $item_subtotal
 * @property float|null $item_tax_total
 * @property float|null $item_discount
 * @property float|null $item_total
 * @property Company    $company
 * @property Product    $product
 */
class InvoiceItemAmount extends Model
{
    public $timestamps = false;

    protected $table = 'invoice_item_amounts';

    protected $primaryKey = 'item_amount_id';

    protected $casts = [
        'company_id'     => 'int',
        'item_id'        => 'int',
        'item_subtotal'  => 'float',
        'item_tax_total' => 'float',
        'item_discount'  => 'float',
        'item_total'     => 'float',
    ];

    protected $fillable = [
        'company_id',
        'item_id',
        'item_subtotal',
        'item_tax_total',
        'item_discount',
        'item_total',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function invoice_items(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(InvoiceItem::class);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'item_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Unit.
 *
 * @property int                      $unit_id
 * @property int                      $company_id
 * @property string|null              $unit_name
 * @property string|null              $unit_name_plrl
 * @property Company                  $company
 * @property Collection|ExpenseItem[] $expense_items
 * @property Collection|InvoiceItem[] $invoice_items
 * @property Collection|Product[]     $products
 * @property Collection|QuoteItem[]   $quote_items
 */
class Unit extends Model
{
    public $timestamps = false;

    protected $table = 'units';

    protected $primaryKey = 'unit_id';

    protected $casts = [
        'company_id' => 'int',
    ];

    protected $fillable = [
        'company_id',
        'unit_name',
        'unit_name_plrl',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function expense_items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ExpenseItem::class);
    }

    public function invoice_items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InvoiceItem::class, 'item_product_unit_id');
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function quote_items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuoteItem::class, 'item_product_unit_id');
    }
}

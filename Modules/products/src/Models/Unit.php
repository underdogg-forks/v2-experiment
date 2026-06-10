<?php

namespace Modules\Products\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Expenses\Models\ExpenseItem;
use Modules\Invoices\Models\InvoiceItem;
use Modules\Quotes\Models\QuoteItem;

/**
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
    use HasFactory;

    public $timestamps = false;

    protected $table = 'units';

    protected $primaryKey = 'unit_id';

    protected $casts = [
        'company_id' => 'int',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function expense_items(): HasMany
    {
        return $this->hasMany(ExpenseItem::class);
    }

    public function invoice_items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class, 'item_product_unit_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function quote_items(): HasMany
    {
        return $this->hasMany(QuoteItem::class, 'item_product_unit_id');
    }

    protected static function newFactory(): Factory
    {
        return \Modules\Products\Database\Factories\UnitFactory::new();
    }
}

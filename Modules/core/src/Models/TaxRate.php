<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Expenses\Models\ExpenseItem;
use Modules\Invoices\Models\Invoice;
use Modules\Invoices\Models\InvoiceItem;
use Modules\Products\Models\Product;
use Modules\Projects\Models\Task;
use Modules\Quotes\Models\Quote;
use Modules\Quotes\Models\QuoteItem;

/**
 * @property int                      $tax_rate_id
 * @property int                      $company_id
 * @property string|null              $tax_rate_name
 * @property float                    $tax_rate_percent
 * @property Company                  $company
 * @property Collection|ExpenseItem[] $expense_items
 * @property Collection|InvoiceItem[] $invoice_items
 * @property Collection|Invoice[]     $invoices
 * @property Collection|Product[]     $products
 * @property Collection|QuoteItem[]   $quote_items
 * @property Collection|Quote[]       $quotes
 * @property Collection|Task[]        $tasks
 */
class TaxRate extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tax_rates';

    protected $primaryKey = 'tax_rate_id';

    protected $casts = [
        'company_id'       => 'int',
        'tax_rate_percent' => 'float',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function expense_items(): HasMany
    {
        return $this->hasMany(ExpenseItem::class, 'tax_rate_2_id');
    }

    public function invoice_items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class, 'item_tax_rate_id');
    }

    public function invoices(): BelongsToMany
    {
        return $this->belongsToMany(Invoice::class, 'invoice_tax_rates')
            ->withPivot('invoice_tax_rate_id', 'company_id', 'include_item_tax', 'invoice_tax_rate_amount');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function quote_items(): HasMany
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function quotes(): BelongsToMany
    {
        return $this->belongsToMany(Quote::class, 'quote_tax_rates')
            ->withPivot('quote_tax_rate_id', 'company_id', 'include_item_tax', 'quote_tax_rate_amount');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TaxRate.
 *
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
    public $timestamps = false;

    protected $table = 'tax_rates';

    protected $primaryKey = 'tax_rate_id';

    protected $casts = [
        'company_id'       => 'int',
        'tax_rate_percent' => 'float',
    ];

    protected $fillable = [
        'company_id',
        'tax_rate_name',
        'tax_rate_percent',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function expense_items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ExpenseItem::class, 'tax_rate_2_id');
    }

    public function invoice_items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InvoiceItem::class, 'item_tax_rate_id');
    }

    public function invoices(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Invoice::class, 'invoice_tax_rates')
            ->withPivot('invoice_tax_rate_id', 'company_id', 'include_item_tax', 'invoice_tax_rate_amount');
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function quote_items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function quotes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Quote::class, 'quote_tax_rates')
            ->withPivot('quote_tax_rate_id', 'company_id', 'include_item_tax', 'quote_tax_rate_amount');
    }

    public function tasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Task::class);
    }
}

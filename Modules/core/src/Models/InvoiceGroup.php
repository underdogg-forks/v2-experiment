<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Invoices\Models\Invoice;
use Modules\Quotes\Models\Quote;

/**
 * @property int                  $invoice_group_id
 * @property int                  $company_id
 * @property string|null          $invoice_group_name
 * @property string               $invoice_group_identifier_format
 * @property int                  $invoice_group_next_id
 * @property int                  $invoice_group_left_pad
 * @property Company              $company
 * @property Collection|Invoice[] $invoices
 * @property Collection|Quote[]   $quotes
 */
class InvoiceGroup extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'invoice_groups';

    protected $primaryKey = 'invoice_group_id';

    protected $casts = [
        'company_id'             => 'int',
        'invoice_group_next_id'  => 'int',
        'invoice_group_left_pad' => 'int',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }
}

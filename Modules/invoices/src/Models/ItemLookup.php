<?php

namespace Modules\Invoices\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\Company;

/**
 * @property int         $item_lookup_id
 * @property int         $company_id
 * @property string|null $item_name
 * @property string|null $item_description
 * @property float|null  $item_price
 * @property Company     $company
 */
class ItemLookup extends Model
{
    public $timestamps = false;

    protected $table = 'item_lookups';

    protected $primaryKey = 'item_lookup_id';

    protected $casts = [
        'company_id' => 'int',
        'item_price' => 'float',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}

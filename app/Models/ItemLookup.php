<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemLookup.
 *
 * @property int     $item_lookup_id
 * @property int     $company_id
 * @property string  $item_name
 * @property string  $item_description
 * @property float   $item_price
 * @property Company $company
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

    protected $fillable = [
        'company_id',
        'item_name',
        'item_description',
        'item_price',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}

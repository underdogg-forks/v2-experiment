<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Family.
 *
 * @property int                  $family_id
 * @property string|null          $family_name
 * @property Collection|Product[] $products
 */
class Family extends Model
{
    public $timestamps = false;

    protected $table = 'families';

    protected $primaryKey = 'family_id';

    protected $fillable = [
        'family_name',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }
}

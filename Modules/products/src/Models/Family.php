<?php

namespace Modules\Products\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Core\Models\Company;

/**
 * @property int                  $family_id
 * @property string|null          $family_name
 * @property Collection|Product[] $products
 */
class Family extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'families';

    protected $primaryKey = 'family_id';

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    protected static function newFactory(): Factory
    {
        return \Modules\Products\Database\Factories\FamilyFactory::new();
    }
}

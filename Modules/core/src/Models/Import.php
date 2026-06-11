<?php

namespace Modules\Core\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int                       $id
 * @property int                       $company_id
 * @property string|null               $import_type
 * @property Carbon                    $imported_at
 * @property Company                   $company
 * @property Collection|ImportDetail[] $import_details
 */
class Import extends Model
{
    public $timestamps = false;

    protected $table = 'imports';

    protected $casts = [
        'company_id'  => 'int',
        'imported_at' => 'datetime',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function import_details(): HasMany
    {
        return $this->hasMany(ImportDetail::class);
    }
}

<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int         $id
 * @property int         $import_id
 * @property string|null $detail_key
 * @property string|null $detail_value
 * @property Import      $import
 */
class ImportDetail extends Model
{
    public $timestamps = false;

    protected $table = 'import_details';

    protected $casts = [
        'import_id' => 'int',
    ];

    protected $guarded = [];

    public function import(): BelongsTo
    {
        return $this->belongsTo(Import::class);
    }
}

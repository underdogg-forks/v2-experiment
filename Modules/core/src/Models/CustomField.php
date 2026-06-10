<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int         $custom_field_id
 * @property int         $company_id
 * @property string|null $custom_field_table
 * @property string|null $custom_field_label
 * @property string|null $custom_field_type
 * @property Company     $company
 */
class CustomField extends Model
{
    public $timestamps = false;

    protected $table = 'custom_fields';

    protected $primaryKey = 'custom_field_id';

    protected $casts = [
        'company_id' => 'int',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}

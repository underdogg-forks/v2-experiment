<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int         $custom_value_id
 * @property int         $company_id
 * @property int         $custom_field_id
 * @property string|null $custom_value
 * @property Company     $company
 * @property CustomField $custom_field
 */
class CustomValue extends Model
{
    public $timestamps = false;

    protected $table = 'custom_values';

    protected $primaryKey = 'custom_value_id';

    protected $casts = [
        'company_id'      => 'int',
        'custom_field_id' => 'int',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function custom_field(): BelongsTo
    {
        return $this->belongsTo(CustomField::class);
    }
}

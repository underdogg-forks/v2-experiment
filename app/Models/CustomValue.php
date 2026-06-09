<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CustomValue.
 *
 * @property int     $custom_values_id
 * @property int     $company_id
 * @property int     $custom_values_field
 * @property string  $custom_values_value
 * @property Company $company
 */
class CustomValue extends Model
{
    public $timestamps = false;

    protected $table = 'custom_values';

    protected $primaryKey = 'custom_values_id';

    protected $casts = [
        'company_id'          => 'int',
        'custom_values_field' => 'int',
    ];

    protected $fillable = [
        'company_id',
        'custom_values_field',
        'custom_values_value',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}

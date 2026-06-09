<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CustomField.
 *
 * @property int         $custom_field_id
 * @property int         $company_id
 * @property string|null $custom_field_table
 * @property string|null $custom_field_label
 * @property string      $custom_field_type
 * @property int|null    $custom_field_location
 * @property int|null    $custom_field_order
 * @property Company     $company
 */
class CustomField extends Model
{
    public $timestamps = false;

    protected $table = 'custom_fields';

    protected $primaryKey = 'custom_field_id';

    protected $casts = [
        'company_id'            => 'int',
        'custom_field_location' => 'int',
        'custom_field_order'    => 'int',
    ];

    protected $fillable = [
        'company_id',
        'custom_field_table',
        'custom_field_label',
        'custom_field_type',
        'custom_field_location',
        'custom_field_order',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}

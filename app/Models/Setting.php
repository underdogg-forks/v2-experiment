<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting.
 *
 * @property int     $setting_id
 * @property int     $company_id
 * @property string  $setting_key
 * @property string  $setting_value
 * @property Company $company
 */
class Setting extends Model
{
    public $timestamps = false;

    protected $table = 'settings';

    protected $primaryKey = 'setting_id';

    protected $casts = [
        'company_id' => 'int',
    ];

    protected $fillable = [
        'company_id',
        'setting_key',
        'setting_value',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}

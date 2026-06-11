<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int     $setting_id
 * @property int     $company_id
 * @property string  $setting_key
 * @property string  $setting_value
 * @property Company $company
 */
class Setting extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'settings';

    protected $primaryKey = 'setting_id';

    protected $casts = [
        'company_id' => 'int',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}

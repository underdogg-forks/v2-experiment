<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int         $user_custom_id
 * @property int         $user_id
 * @property int         $user_custom_fieldid
 * @property string|null $user_custom_fieldvalue
 * @property User        $user
 */
class UserCustom extends Model
{
    public $timestamps = false;

    protected $table = 'user_custom';

    protected $primaryKey = 'user_custom_id';

    protected $casts = [
        'user_id'             => 'int',
        'user_custom_fieldid' => 'int',
    ];

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

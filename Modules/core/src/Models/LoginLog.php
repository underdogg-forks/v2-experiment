<?php

namespace Modules\Core\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int         $id
 * @property int         $user_id
 * @property string|null $ip_address
 * @property Carbon      $logged_at
 * @property User        $user
 */
class LoginLog extends Model
{
    public $timestamps = false;

    protected $table = 'login_log';

    protected $casts = [
        'user_id'   => 'int',
        'logged_at' => 'datetime',
    ];

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

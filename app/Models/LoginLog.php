<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LoginLog.
 *
 * @property string      $login_name
 * @property int|null    $log_count
 * @property Carbon|null $log_create_timestamp
 */
class LoginLog extends Model
{
    public $incrementing = false;

    public $timestamps = false;

    protected $table = 'login_log';

    protected $primaryKey = 'login_name';

    protected $casts = [
        'log_count'            => 'int',
        'log_create_timestamp' => 'datetime',
    ];

    protected $fillable = [
        'log_count',
        'log_create_timestamp',
    ];
}

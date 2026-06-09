<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserCustom.
 *
 * @property int         $user_custom_id
 * @property int         $company_id
 * @property int         $user_id
 * @property int         $user_custom_fieldid
 * @property string|null $user_custom_fieldvalue
 * @property Company     $company
 * @property User        $user
 */
class UserCustom extends Model
{
    public $timestamps = false;

    protected $table = 'user_custom';

    protected $primaryKey = 'user_custom_id';

    protected $casts = [
        'company_id'          => 'int',
        'user_id'             => 'int',
        'user_custom_fieldid' => 'int',
    ];

    protected $fillable = [
        'company_id',
        'user_id',
        'user_custom_fieldid',
        'user_custom_fieldvalue',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

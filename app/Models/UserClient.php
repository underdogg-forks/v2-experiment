<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserClient.
 *
 * @property int     $user_client_id
 * @property int     $company_id
 * @property int     $client_id
 * @property int     $user_id
 * @property Client  $client
 * @property Company $company
 * @property User    $user
 */
class UserClient extends Model
{
    public $timestamps = false;

    protected $table = 'user_clients';

    protected $primaryKey = 'user_client_id';

    protected $casts = [
        'company_id' => 'int',
        'client_id'  => 'int',
        'user_id'    => 'int',
    ];

    protected $fillable = [
        'company_id',
        'client_id',
        'user_id',
    ];

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

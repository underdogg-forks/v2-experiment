<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Clients\Models\Client;

/**
 * @property int     $user_client_id
 * @property int     $company_id
 * @property int     $user_id
 * @property int     $client_id
 * @property Company $company
 * @property User    $user
 * @property Client  $client
 */
class UserClient extends Model
{
    public $timestamps = false;

    protected $table = 'user_clients';

    protected $primaryKey = 'user_client_id';

    protected $casts = [
        'company_id' => 'int',
        'user_id'    => 'int',
        'client_id'  => 'int',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}

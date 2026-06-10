<?php

namespace Modules\Payments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Clients\Models\Client;
use Modules\Core\Models\Company;

/**
 * @property int    $id
 * @property string $driver
 * @property int    $client_id
 * @property string $merchant_key
 * @property string $merchant_value
 */
class MerchantClient extends Model
{
    public $timestamps = false;

    protected $table = 'merchant_clients';

    protected $casts = [
        'client_id' => 'int',
    ];

    protected $guarded = [];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}

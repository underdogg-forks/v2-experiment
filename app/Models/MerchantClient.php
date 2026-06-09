<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MerchantClient.
 *
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

    protected $fillable = [
        'driver',
        'client_id',
        'merchant_key',
        'merchant_value',
    ];

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}

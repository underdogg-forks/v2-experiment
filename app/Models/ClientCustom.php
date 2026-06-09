<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientCustom.
 *
 * @property int         $client_custom_id
 * @property int         $company_id
 * @property int         $client_id
 * @property int         $client_custom_fieldid
 * @property string|null $client_custom_fieldvalue
 * @property Client      $client
 * @property Company     $company
 */
class ClientCustom extends Model
{
    public $timestamps = false;

    protected $table = 'client_custom';

    protected $primaryKey = 'client_custom_id';

    protected $casts = [
        'company_id'            => 'int',
        'client_id'             => 'int',
        'client_custom_fieldid' => 'int',
    ];

    protected $fillable = [
        'company_id',
        'client_id',
        'client_custom_fieldid',
        'client_custom_fieldvalue',
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

<?php

namespace Modules\Clients\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\Company;

/**
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
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'company_id'            => 'int',
        'client_id'             => 'int',
        'client_custom_fieldid' => 'int',
    ];

    protected $guarded = [];

    #region Static Methods
    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    #endregion
    #region Relationships
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
    #endregion
    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    #endregion
    #region Mutators
    /*
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------
    */

    #endregion
    #region Scopes
    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    #endregion
    #region Factory
    /*
    |--------------------------------------------------------------------------
    | Factory
    |--------------------------------------------------------------------------
    */
    /*protected static function newFactory(): Factory
    {
    }*/
    #endregion
}

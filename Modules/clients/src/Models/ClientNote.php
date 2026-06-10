<?php

namespace Modules\Clients\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\Models\Company;

/**
 * @property int     $client_note_id
 * @property int     $company_id
 * @property int     $client_id
 * @property Carbon  $client_note_date
 * @property string  $client_note
 * @property Client  $client
 * @property Company $company
 */
class ClientNote extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'company_id'       => 'int',
        'client_id'        => 'int',
        'client_note_date' => 'datetime',
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
    #endregion
}

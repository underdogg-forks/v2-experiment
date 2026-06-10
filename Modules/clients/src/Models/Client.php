<?php

namespace Modules\Clients\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Models\Company;
use Modules\Core\Models\User;
use Modules\Core\Traits\TenantAware;
use Modules\Expenses\Models\Expense;
use Modules\Invoices\Models\Invoice;
use Modules\Projects\Models\Project;
use Modules\Quotes\Models\Quote;

/**
 * @property int                       $client_id
 * @property int                       $company_id
 * @property string|null               $client_name
 * @property string|null               $client_company
 * @property string|null               $client_address_1
 * @property string|null               $client_address_2
 * @property string|null               $client_city
 * @property string|null               $client_state
 * @property string|null               $client_zip
 * @property string|null               $client_country
 * @property string|null               $client_phone
 * @property string|null               $client_fax
 * @property string|null               $client_mobile
 * @property string|null               $client_email
 * @property string|null               $client_web
 * @property string|null               $client_vat_id
 * @property string|null               $client_tax_code
 * @property string|null               $client_language
 * @property bool                      $client_active
 * @property string|null               $client_surname
 * @property string|null               $client_invoicing_contact
 * @property string|null               $client_title
 * @property bool                      $client_einvoicing_active
 * @property string|null               $client_einvoicing_version
 * @property string|null               $client_avs
 * @property string|null               $client_insurednumber
 * @property string|null               $client_veka
 * @property Carbon|null               $client_birthdate
 * @property int|null                  $client_gender
 * @property Carbon                    $client_date_created
 * @property Carbon                    $client_date_modified
 * @property Company                   $company
 * @property Collection|ClientCustom[] $client_customs
 * @property Collection|Expense[]      $expenses
 * @property Collection|Invoice[]      $invoices
 * @property Collection|Project[]      $projects
 * @property Collection|Quote[]        $quotes
 * @property Collection|User[]         $users
 */
class Client extends Model
{
    use HasFactory, TenantAware;

    public $timestamps = false;

    protected $table = 'clients';

    protected $primaryKey = 'client_id';

    protected $casts = [
        'company_id'               => 'int',
        'client_active'            => 'bool',
        'client_einvoicing_active' => 'bool',
        'client_birthdate'         => 'datetime',
        'client_gender'            => 'int',
        'client_date_created'      => 'datetime',
        'client_date_modified'     => 'datetime',
    ];

    protected $guarded = [];

    #region Static Methods
    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */
    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->client_date_created)) {
                $model->client_date_created = \Carbon\Carbon::now();
            }
            if (empty($model->client_date_modified)) {
                $model->client_date_modified = \Carbon\Carbon::now();
            }
        });

        static::updating(function ($model) {
            $model->client_date_modified = \Carbon\Carbon::now();
        });
    }
    #endregion
    #region Relationships
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function client_customs(): HasMany
    {
        return $this->hasMany(ClientCustom::class);
    }

    public function client_notes(): HasMany
    {
        return $this->hasMany(ClientNote::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'vendor_id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_clients')
            ->withPivot('user_client_id', 'company_id');
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
    protected static function newFactory(): Factory
    {
        return \Modules\Clients\Database\Factories\ClientFactory::new();
    }
    #endregion
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Client.
 *
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
 * @property Collection|Upload[]       $uploads
 * @property Collection|User[]         $users
 */
class Client extends Model
{
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

    protected $fillable = [
        'company_id',
        'client_name',
        'client_company',
        'client_address_1',
        'client_address_2',
        'client_city',
        'client_state',
        'client_zip',
        'client_country',
        'client_phone',
        'client_fax',
        'client_mobile',
        'client_email',
        'client_web',
        'client_vat_id',
        'client_tax_code',
        'client_language',
        'client_active',
        'client_surname',
        'client_invoicing_contact',
        'client_title',
        'client_einvoicing_active',
        'client_einvoicing_version',
        'client_avs',
        'client_insurednumber',
        'client_veka',
        'client_birthdate',
        'client_gender',
        'client_date_created',
        'client_date_modified',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function expenses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Expense::class, 'vendor_id');
    }

    public function invoices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function quotes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Quote::class);
    }

    public function uploads(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Upload::class);
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_clients')
            ->withPivot('user_client_id', 'company_id');
    }
}

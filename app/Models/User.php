<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User.
 *
 * @property int                     $user_id
 * @property int                     $user_type
 * @property bool|null               $user_active
 * @property Carbon                  $user_date_created
 * @property Carbon                  $user_date_modified
 * @property string|null             $user_language
 * @property string|null             $user_name
 * @property string|null             $user_company
 * @property string|null             $user_address_1
 * @property string|null             $user_address_2
 * @property string|null             $user_city
 * @property string|null             $user_state
 * @property string|null             $user_zip
 * @property string|null             $user_country
 * @property string|null             $user_invoicing_contact
 * @property string|null             $user_phone
 * @property string|null             $user_fax
 * @property string|null             $user_mobile
 * @property string|null             $user_email
 * @property string                  $user_password
 * @property string|null             $user_web
 * @property string|null             $user_vat_id
 * @property string|null             $user_tax_code
 * @property string|null             $user_psalt
 * @property bool                    $user_all_clients
 * @property string|null             $user_passwordreset_token
 * @property string|null             $user_subscribernumber
 * @property string|null             $user_bank
 * @property string|null             $user_iban
 * @property string|null             $user_bic
 * @property string|null             $user_remittance_text
 * @property int|null                $user_gln
 * @property string|null             $user_rcc
 * @property Collection|Expense[]    $expenses
 * @property Collection|Invoice[]    $invoices
 * @property Collection|Quote[]      $quotes
 * @property Collection|Client[]     $clients
 * @property Collection|UserCustom[] $user_customs
 */
class User extends Model
{
    public $timestamps = false;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $casts = [
        'user_type'          => 'int',
        'user_active'        => 'bool',
        'user_date_created'  => 'datetime',
        'user_date_modified' => 'datetime',
        'user_all_clients'   => 'bool',
        'user_gln'           => 'int',
    ];

    protected $hidden = [
        'user_password',
        'user_passwordreset_token',
    ];

    protected $fillable = [
        'user_type',
        'user_active',
        'user_date_created',
        'user_date_modified',
        'user_language',
        'user_name',
        'user_company',
        'user_address_1',
        'user_address_2',
        'user_city',
        'user_state',
        'user_zip',
        'user_country',
        'user_invoicing_contact',
        'user_phone',
        'user_fax',
        'user_mobile',
        'user_email',
        'user_password',
        'user_web',
        'user_vat_id',
        'user_tax_code',
        'user_psalt',
        'user_all_clients',
        'user_passwordreset_token',
        'user_subscribernumber',
        'user_bank',
        'user_iban',
        'user_bic',
        'user_remittance_text',
        'user_gln',
        'user_rcc',
    ];

    public function expenses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function invoices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function quotes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Quote::class);
    }

    public function clients(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'user_clients')
            ->withPivot('user_client_id', 'company_id');
    }

    public function user_customs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserCustom::class);
    }
}

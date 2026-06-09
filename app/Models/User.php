<?php

namespace App\Models;

use App\Enums\UserRole;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasDefaultTenant;
use Filament\Models\Contracts\HasName;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
class User extends Authenticatable implements FilamentUser, HasAvatar, HasName, HasTenants, HasDefaultTenant
{
    public $timestamps = false;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $casts = [
        'user_type'        => 'int',
        'user_active'      => 'boolean',
        'user_all_clients' => 'boolean',
        'user_gln'         => 'int',
    ];

    protected $hidden = [
        'password',
        'user_password_confirmation',
        'remember_token',
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

    protected $guarded = [];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(
            Company::class,
            'company_user',
            'user_id',
            'company_id',
        )
            ->using(CompanyUser::class);
    }

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

    public function getCurrentCompanyId(): ?int
    {
        $companyId = session('current_company_id');

        if ( ! $companyId) {
            $companyId = $this->companies()->first()?->id;
        }

        return $companyId;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // SuperAdmin, Admin, Assistance can access any panel
        if (
            $this->hasRole(UserRole::SUPER_ADMIN->value)
            || $this->hasRole(UserRole::ADMIN->value)
            || $this->hasRole(UserRole::ASSIST->value)
        ) {
            return true;
        }

        // UserAdmin and User can only access the 'company' panel
        if ($panel->getId() === 'company') {
            return $this->hasRole(UserRole::CUSTOMER_ADMIN->value)
                || $this->hasRole(UserRole::CUSTOMER->value);
        }

        // All other roles or panels not explicitly allowed
        return false;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return null;
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole(UserRole::SUPER_ADMIN->value);
    }

    /**
     * Filament tenancy: return the user's default tenant (first company).
     */
    public function getDefaultTenant(Panel $panel): ?Model
    {
        return $this->companies()->first();
    }

    public function getFilamentName(): string
    {
        return $this->getAttributeValue('user_name');
    }

    public function canAccessTenant(Model $tenant): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return $this->companies()->whereKey($tenant->getKey())->exists();
    }

    public function getTenants(Panel $panel): array|Collection
    {
        return $this->companies;
    }

    /*
    |--------------------------------------------------------------------------
    | Factory
    |--------------------------------------------------------------------------
    */
    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }
}

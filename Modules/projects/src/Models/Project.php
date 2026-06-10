<?php

namespace Modules\Projects\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Clients\Models\Client;
use Modules\Core\Models\Company;
use Modules\Core\Traits\TenantAware;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @property int               $project_id
 * @property int               $company_id
 * @property int               $client_id
 * @property string|null       $project_name
 * @property Client            $client
 * @property Company           $company
 * @property Collection|Task[] $tasks
 */
class Project extends Model
{
    use HasFactory;
    use TenantAware;

    public $timestamps = false;

    protected $table = 'projects';

    protected $primaryKey = 'project_id';

    protected $casts = [
        'company_id' => 'int',
        'client_id'  => 'int',
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

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    protected static function newFactory(): Factory
    {
        return \Modules\Projects\Database\Factories\ProjectFactory::new();
    }
}

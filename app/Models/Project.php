<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Project.
 *
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
    public $timestamps = false;

    protected $table = 'projects';

    protected $primaryKey = 'project_id';

    protected $casts = [
        'company_id' => 'int',
        'client_id'  => 'int',
    ];

    protected $fillable = [
        'company_id',
        'client_id',
        'project_name',
    ];

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function tasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Task::class);
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Import.
 *
 * @property int                       $import_id
 * @property Carbon                    $import_date
 * @property Collection|ImportDetail[] $import_details
 */
class Import extends Model
{
    public $timestamps = false;

    protected $table = 'imports';

    protected $primaryKey = 'import_id';

    protected $casts = [
        'import_date' => 'datetime',
    ];

    protected $fillable = [
        'import_date',
    ];
}

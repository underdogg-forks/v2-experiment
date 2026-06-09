<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientNote.
 *
 * @property int    $client_note_id
 * @property int    $company_id
 * @property int    $client_id
 * @property Carbon $client_note_date
 * @property string $client_note
 */
class ClientNote extends Model
{
    public $timestamps = false;

    protected $table = 'client_notes';

    protected $primaryKey = 'client_note_id';

    protected $casts = [
        'company_id'       => 'int',
        'client_id'        => 'int',
        'client_note_date' => 'datetime',
    ];

    protected $fillable = [
        'company_id',
        'client_id',
        'client_note_date',
        'client_note',
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

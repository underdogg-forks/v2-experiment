<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Upload.
 *
 * @property int     $upload_id
 * @property int     $company_id
 * @property int     $client_id
 * @property string  $url_key
 * @property string  $file_name_original
 * @property string  $file_name_new
 * @property Carbon  $uploaded_date
 * @property Client  $client
 * @property Company $company
 */
class Upload extends Model
{
    public $timestamps = false;

    protected $table = 'uploads';

    protected $primaryKey = 'upload_id';

    protected $casts = [
        'company_id'    => 'int',
        'client_id'     => 'int',
        'uploaded_date' => 'datetime',
    ];

    protected $fillable = [
        'company_id',
        'client_id',
        'url_key',
        'file_name_original',
        'file_name_new',
        'uploaded_date',
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

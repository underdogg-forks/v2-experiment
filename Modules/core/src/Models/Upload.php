<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int         $upload_id
 * @property int         $company_id
 * @property int|null    $client_id
 * @property int|null    $invoice_id
 * @property int|null    $quote_id
 * @property string|null $upload_filename
 * @property string|null $upload_path
 * @property Company     $company
 */
class Upload extends Model
{
    public $timestamps = false;

    protected $table = 'uploads';

    protected $primaryKey = 'upload_id';

    protected $casts = [
        'company_id' => 'int',
        'client_id'  => 'int',
        'invoice_id' => 'int',
        'quote_id'   => 'int',
    ];

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}

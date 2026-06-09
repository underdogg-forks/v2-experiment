<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImportDetail.
 *
 * @property int    $import_detail_id
 * @property int    $import_id
 * @property string $import_lang_key
 * @property string $import_table_name
 * @property int    $import_record_id
 * @property Import $import
 */
class ImportDetail extends Model
{
    public $timestamps = false;

    protected $table = 'import_details';

    protected $primaryKey = 'import_detail_id';

    protected $casts = [
        'import_id'        => 'int',
        'import_record_id' => 'int',
    ];

    protected $fillable = [
        'import_id',
        'import_lang_key',
        'import_table_name',
        'import_record_id',
    ];

    public function import(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Import::class);
    }
}

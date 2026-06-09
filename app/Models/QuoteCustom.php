<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class QuoteCustom.
 *
 * @property int         $quote_custom_id
 * @property int         $company_id
 * @property int         $quote_id
 * @property int         $quote_custom_fieldid
 * @property string|null $quote_custom_fieldvalue
 * @property Company     $company
 * @property Quote       $quote
 */
class QuoteCustom extends Model
{
    public $timestamps = false;

    protected $table = 'quote_custom';

    protected $primaryKey = 'quote_custom_id';

    protected $casts = [
        'company_id'           => 'int',
        'quote_id'             => 'int',
        'quote_custom_fieldid' => 'int',
    ];

    protected $fillable = [
        'company_id',
        'quote_id',
        'quote_custom_fieldid',
        'quote_custom_fieldvalue',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function quote(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }
}

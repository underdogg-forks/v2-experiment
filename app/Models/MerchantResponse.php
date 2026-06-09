<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MerchantResponse.
 *
 * @property int       $merchant_response_id
 * @property int       $company_id
 * @property int       $invoice_id
 * @property bool|null $merchant_response_successful
 * @property Carbon    $merchant_response_date
 * @property string    $merchant_response_driver
 * @property string    $merchant_response
 * @property string    $merchant_response_reference
 * @property Company   $company
 * @property Invoice   $invoice
 */
class MerchantResponse extends Model
{
    public $timestamps = false;

    protected $table = 'merchant_responses';

    protected $primaryKey = 'merchant_response_id';

    protected $casts = [
        'company_id'                   => 'int',
        'invoice_id'                   => 'int',
        'merchant_response_successful' => 'bool',
        'merchant_response_date'       => 'datetime',
    ];

    protected $fillable = [
        'company_id',
        'invoice_id',
        'merchant_response_successful',
        'merchant_response_date',
        'merchant_response_driver',
        'merchant_response',
        'merchant_response_reference',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function invoice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}

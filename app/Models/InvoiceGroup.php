<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InvoiceGroup.
 *
 * @property int                  $invoice_group_id
 * @property int                  $company_id
 * @property string|null          $invoice_group_name
 * @property string               $invoice_group_identifier_format
 * @property int                  $invoice_group_next_id
 * @property int                  $invoice_group_left_pad
 * @property Company              $company
 * @property Collection|Invoice[] $invoices
 * @property Collection|Quote[]   $quotes
 */
class InvoiceGroup extends Model
{
    public $timestamps = false;

    protected $table = 'invoice_groups';

    protected $primaryKey = 'invoice_group_id';

    protected $casts = [
        'company_id'             => 'int',
        'invoice_group_next_id'  => 'int',
        'invoice_group_left_pad' => 'int',
    ];

    protected $fillable = [
        'company_id',
        'invoice_group_name',
        'invoice_group_identifier_format',
        'invoice_group_next_id',
        'invoice_group_left_pad',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}

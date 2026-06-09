<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Task.
 *
 * @property int                      $task_id
 * @property int                      $company_id
 * @property int                      $project_id
 * @property string|null              $task_name
 * @property string                   $task_description
 * @property float|null               $task_price
 * @property Carbon                   $task_finish_date
 * @property bool                     $task_status
 * @property int                      $tax_rate_id
 * @property Company                  $company
 * @property Project                  $project
 * @property TaxRate                  $tax_rate
 * @property Collection|InvoiceItem[] $invoice_items
 */
class Task extends Model
{
    public $timestamps = false;

    protected $table = 'tasks';

    protected $primaryKey = 'task_id';

    protected $casts = [
        'company_id'       => 'int',
        'project_id'       => 'int',
        'task_price'       => 'float',
        'task_finish_date' => 'datetime',
        'task_status'      => 'bool',
        'tax_rate_id'      => 'int',
    ];

    protected $fillable = [
        'company_id',
        'project_id',
        'task_name',
        'task_description',
        'task_price',
        'task_finish_date',
        'task_status',
        'tax_rate_id',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function tax_rate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TaxRate::class);
    }

    public function invoice_items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InvoiceItem::class, 'item_task_id');
    }
}

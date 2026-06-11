<?php

namespace Modules\Projects\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Core\Models\TaxRate;
use Modules\Invoices\Models\InvoiceItem;

/**
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
    use HasFactory;

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

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function tax_rate(): BelongsTo
    {
        return $this->belongsTo(TaxRate::class);
    }

    public function invoice_items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class, 'item_task_id');
    }

    protected static function newFactory(): Factory
    {
        return \Modules\Projects\Database\Factories\TaskFactory::new();
    }
}

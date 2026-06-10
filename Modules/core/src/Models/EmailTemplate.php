<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int         $email_template_id
 * @property string|null $email_template_title
 * @property string|null $email_template_type
 * @property string      $email_template_body
 * @property string|null $email_template_subject
 * @property string|null $email_template_from_name
 * @property string|null $email_template_from_email
 * @property string|null $email_template_cc
 * @property string|null $email_template_bcc
 * @property string|null $email_template_pdf_template
 */
class EmailTemplate extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'email_templates';

    protected $primaryKey = 'email_template_id';

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}

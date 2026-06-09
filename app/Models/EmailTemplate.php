<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailTemplate.
 *
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
    public $timestamps = false;

    protected $table = 'email_templates';

    protected $primaryKey = 'email_template_id';

    protected $fillable = [
        'email_template_title',
        'email_template_type',
        'email_template_body',
        'email_template_subject',
        'email_template_from_name',
        'email_template_from_email',
        'email_template_cc',
        'email_template_bcc',
        'email_template_pdf_template',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}

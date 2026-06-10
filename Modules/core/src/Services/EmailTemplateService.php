<?php

namespace Modules\Core\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Core\Models\EmailTemplate;

class EmailTemplateService
{
    public function createEmailTemplate(array $data): EmailTemplate
    {
        return EmailTemplate::query()->create($data);
    }

    public function updateEmailTemplate(EmailTemplate $emailTemplate, array $data): EmailTemplate
    {
        $emailTemplate->update($data);

        return $emailTemplate->fresh();
    }

    public function deleteEmailTemplate(EmailTemplate $emailTemplate): bool
    {
        return (bool) $emailTemplate->delete();
    }

    public function listByType(string $type): Collection
    {
        return EmailTemplate::query()
            ->where('email_template_type', $type)
            ->orderBy('email_template_title')
            ->get();
    }
}

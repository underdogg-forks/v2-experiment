<?php

namespace Modules\Core\Traits;

use Filament\Facades\Filament;

trait TenantAware
{
    public static function bootTenantAware(): void
    {
        static::creating(function ($model) {
            if (empty($model->company_id)) {
                $tenant = Filament::getTenant();
                if ($tenant) {
                    $model->company_id = $tenant->id;
                }
            }
        });
    }
}

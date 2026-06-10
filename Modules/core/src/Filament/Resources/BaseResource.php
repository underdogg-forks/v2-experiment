<?php

namespace Modules\Core\Filament\Resources;

use Filament\Facades\Filament;
use Filament\Resources\Resource;

abstract class BaseResource extends Resource
{
    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $tenant = Filament::getTenant();

        if ($tenant) {
            $data['company_id'] = $tenant->id;
        }

        return $data;
    }
}

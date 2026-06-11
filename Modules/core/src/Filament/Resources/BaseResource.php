<?php

namespace Modules\Core\Filament\Resources;

use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseResource extends Resource
{
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $tenant = Filament::getTenant();

        if ($tenant) {
            $query->where('company_id', $tenant->id);
        }

        return $query;
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $tenant = Filament::getTenant();

        if ($tenant) {
            $data['company_id'] = $tenant->id;
        }

        return $data;
    }
}

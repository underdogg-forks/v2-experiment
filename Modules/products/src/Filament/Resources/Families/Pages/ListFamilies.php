<?php

namespace Modules\Products\Filament\Resources\Families\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Products\Filament\Resources\Families\FamilyResource;

class ListFamilies extends ListRecords
{
    protected static string $resource = FamilyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
